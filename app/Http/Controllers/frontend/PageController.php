<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use App\Helpers\EncryptDecrypt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\UpdatePasswordRequest;

class PageController extends Controller
{
    public function index(){
        $user = auth()->guard('web')->user();
        return view('frontend.home', compact('user'));
    }

    public function profile(){
        $user = Auth::guard('web')->user();
        return view('frontend.profile', compact('user'));
    }

    public function update_password(){
        return view('frontend.update_pass');
    }

    public function store_password(UpdatePasswordRequest $request){
        $old_password = $request->old_pass;
        $new_password = $request->new_pass;
        $user = auth()->guard('web')->user();
        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->update();
            return redirect('/profile')->with('create', "Successfully updated");
        }
        return back()->withErrors(['old_pass'=>'The old password is not corret!']);
    }

    public function wallet(){
        $user = auth()->guard('web')->user();
        return view('frontend.wallet', compact('user'));
    }

    public function transfer(){
        $user = auth()->guard('web')->user();
        return view('frontend.transfer', compact('user'));
    }

    public function confirm_transfer(TransferRequest $request){
        date_default_timezone_set("Asia/Yangon");
        $user = auth()->guard('web')->user();
        $to = $request->to;
        $amount = $request->amount;
        $note = $request->note;
        $current_time = date("Y-m-d H:i:s");

        $str = $to.$amount.$note;
        $hash_value2 = hash_hmac('sha256', $str, 'digitalpayment');
        if($hash_value2 !== $request->hash_value){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }

        $to_user = User::where('phone', $to)->first();
        $hash_value = $request->hash_value;
        if($amount < 1000){
            return back()->withErrors(['amount' => 'The amount mush be at least 1000 MMK'])->withInput();
        }

        if($user->phone == $to){
            return back()->withErrors(['to' => 'You cannot transfer money to yourself!'])->withInput();
        }
        
        if($to_user == null){
            return back()->withErrors(['to' => 'Phone number is invalid!'])->withInput();
        }

        if(!$user->wallet || !$to_user->wallet){
            return back()->withErrors(['fail' => 'Something wrongs!'])->withInput();
        }

        if($user->wallet->amount < $amount){
            return back()->withErrors(['amount' => 'The amount is not enough to transfer!'])->withInput();
        }

        return view('frontend.confirm_transfer', compact('to_user', 'hash_value', 'amount', 'note', 'user', 'current_time'));
    }

    public  function toVerifyAccount(Request $request){
        $authUser = auth()->guard('web')->user();
        $user = User::where('phone', $request->phone)->first();
        if($authUser->phone != $request->phone){
            if($user){
                return response()->json([
                    'status' => 'success',
                    'message' => 'success',
                    'data' => $user,
                ]);         
            }
        }
        
        return response()->json([
            'status' => 'fail',
            'message' => 'Invalid data!'
        ]);
        
    }

    public function complete_transfer(TransferRequest $request){
        $user = auth()->guard('web')->user();
        $to = $request->to;
        $amount = $request->amount;
        $note = $request->note;
        $to_user = User::where('phone', $to)->first();

        $str = $to.$amount.$note;
        $hash_value2 = hash_hmac('sha256', $str, 'digitalpayment');
        if($hash_value2 !== $request->hash_value){
            return back()->withErrors(['fail' => 'The given data is invalid'])->withInput();
        }

        if($amount < 1000){
            return back()->withErrors(['fail' => 'The amount mush be at least 1000 MMK'])->withInput();
        }

        if($user->phone == $to){
            return back()->withErrors(['fail' => 'You cannot transfer money to yourself!'])->withInput();
        }
        
        if($to_user == null){
            return back()->withErrors(['fail' => 'Phone number is invalid!'])->withInput();
        }

        if(!$user->wallet || !$to_user->wallet){
            return back()->withErrors(['fail' => 'Something wrongs!'])->withInput();
        }

        if($user->wallet->amount < $amount){
            return back()->withErrors(['fail' => 'The amount is not enough to transfer!'])->withInput();
        }

        DB::beginTransaction();
        try {
            $from_account_wallet = $user->wallet;
            $from_account_wallet->decrement('amount', $amount);
            $from_account_wallet->update();

            $to_account_wallet = $to_user->wallet;
            $to_account_wallet->increment('amount', $amount);
            $to_account_wallet->update();

            $ref_num = UUIDGenerate::refNum();

            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_num;
            $from_account_transaction->trx_id = UUIDGenerate::trxId();
            $from_account_transaction->user_id = $user->id;
            $from_account_transaction->type = 2;
            $from_account_transaction->amount = $amount;
            $from_account_transaction->source_id = $to_user->id;
            $from_account_transaction->description = $note;
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_num;
            $to_account_transaction->trx_id = UUIDGenerate::trxId();
            $to_account_transaction->user_id = $to_user->id;
            $to_account_transaction->type = 1;
            $to_account_transaction->amount = $amount;
            $to_account_transaction->source_id = $user->id;
            $to_account_transaction->description = $note;
            $to_account_transaction->save();

            DB::commit();
            return redirect('/transaction/detail?trx_id='.$from_account_transaction->trx_id)->with('transfer_success', 'Transfered success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['fail' => 'Something wrongs!'. $e->getMessage()] )->withInput();
        }
    }

    public function transaction(Request $request){
        $authUser = auth()->guard('web')->user();
        $transactions = Transaction::orderBy('created_at', 'DESC')->where('user_id', $authUser->id);

        if($request->type){
          $transactions = $transactions->where('type', $request->type);
        }

        if($request->date){
            $transactions = $transactions->whereDate('created_at', $request->date);
        }

        $transactions = $transactions->paginate(4)->withQueryString();

        return view('frontend.transaction', compact('transactions', 'authUser'));
    }

    public function transactionDetail(Request $request){
        $authUser = auth()->guard('web')->user();
        $trxDetail = Transaction::where('user_id', $authUser->id)->where('trx_id', $request->trx_id)->first();
        return view('frontend.transactionDetail', compact('trxDetail', 'authUser'));
    }

    public function password_check(Request $request){
        $authUser = auth()->guard('web')->user();
        if(empty($request->password)){
            return response()->json([
                'status' => 'fail',
                'message' => 'Please fill your password!'
            ]);
        }

        if (Hash::check($request->password, $authUser->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password is correct!'
            ]); 
        }

        return response()->json([
            'status' => 'fail',
            'message' => 'Password is incorrect!'
        ]);
        
    }

    public function transfer_hash(Request $request){
        $str = $request->to.$request->amount.$request->note;
        $hash_value = hash_hmac('sha256', $str, 'digitalpayment');

        return response()->json([
            'status' => 'success',
            'data' => $hash_value
        ]);
    }

    public function receiveQr(){
        $authUser = auth()->guard('web')->user();
        return view('frontend.receive_qr', compact('authUser'));
    }

    public function scanPay(){
        return view('frontend.scan_pay');
    }
}
