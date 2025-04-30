<x-layout>
    <x-slot name="title">
        <title>Wallet</title>
    </x-slot>

    @section('header', 'Wallet')
    <div class="profile">
        <img
            src="https://ui-avatars.com/api/?background=5842e3&color=fff&name={{ auth()->guard('web')->user()->name }}" />
        <p class="mt-2">{{ $user->name }}</p>
        <span>{{ number_format($user->wallet ? $user->wallet->amount : 0) }} MMK</span>
    </div>
    <div class="transfer-group">
        <x-card-wrapper class="home-icon">
            <div class="home-group">
                <img src="{{ asset('images/scan.png') }}" />
                <span>Scan and Pay</span>
            </div>
        </x-card-wrapper>

        <x-card-wrapper class="home-icon">
            <div class="home-group">
                <img src="{{ asset('images/receive.png') }}" />
                <span>Receive QR</span>
            </div>
        </x-card-wrapper>
    </div>
    <div class="bot-home">
        <x-card-wrapper>
            <a href="{{ route('transfer') }}" class="d-flex text-select justify-content-between">
                <div>
                    <img src="{{ asset('images/money-transfer.png') }}" />
                    <span class="update">Transfer</span>
                </div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <hr />
            <a href="{{ route('wallet') }}" class="d-flex text-select justify-content-between">
                <div>
                    <img src="{{ asset('images/wallet.png') }}" />
                    <span class="update">Wallet</span>
                </div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <hr />
            <a href="{{ route('update_pass') }}" class="d-flex text-select justify-content-between">
                <div>
                    <img src="{{ asset('images/transaction.png') }}" />
                    <span class="update">Transaction</span>
                </div>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </x-card-wrapper>
    </div>
</x-layout>
