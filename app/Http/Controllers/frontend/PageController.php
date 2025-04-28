<?php

namespace App\Http\Controllers\frontend;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class PageController extends Controller
{
    public function index(){
        return view('frontend.home');
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
}
