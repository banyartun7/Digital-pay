<x-layout>
    <x-slot name="title">
        <title>Confirm</title>
    </x-slot>
    @section('header', 'Transfer Confirmation')
    <x-card-wrapper>
        <div class="from">
            <p>Transfer From</p>
            <span class="text-muted">{{ $user->name }}</span>
            <span class="text-muted">{{ $user->phone }}</span>
        </div>
        <div class="from">
            <span>To</span>
            <span class="text-muted">{{ $to }}</span>
        </div>
        <div class="from">
            <span>Transaction Time</span>
            <span class="text-muted">{{ $current_time }}</span>
        </div>
        <div class="from">
            <span>Transaction No.</span>
            <span class="text-muted">{{ $user->wallet ? $user->wallet->account_number : '-' }}</span>
        </div>
        <div class="from">
            <span>Amount (MMK)</span>
            <span class="text-muted">{{ number_format($amount) }} Ks</span>
        </div>
        <div class="from">
            <span>Desception</span>
            <p class="text-muted">{{ $note }}</p>
        </div>
        <button class="btn btn-primary mt-4 form-control">Confirm</button>
    </x-card-wrapper>
</x-layout>
