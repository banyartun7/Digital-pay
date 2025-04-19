<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminUserController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::ADMINPANEL;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin_user')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin_user');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }
}
