<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
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
        $check_to = User::where('phone', $to)->first();

        if($amount < 1000){
            return back()->withErrors(['amount' => 'The amount mush be at least 1000 MMK'])->withInput();
        }
        
        if($check_to == null){
            return back()->withErrors(['to' => 'Phone number is invalid!'])->withInput();
        }

        return view('frontend.confirm_transfer', compact('to','amount', 'note', 'user', 'current_time'));
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
}
