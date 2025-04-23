<?php

namespace App\Http\Controllers\backend;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function index(){
        $wallets = Wallet::latest()->get();
        return view('backend.wallet.index', compact('wallets'));
    }
}
