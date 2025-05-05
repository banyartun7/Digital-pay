<x-layout>
    <x-slot name="title">
        <title>Transaction Details</title>
    </x-slot>
    @section('header', 'Transaction Details')
    <x-card-wrapper>
        @if (session('transfer_success'))
            <div class="alert text-center alert-success">
                {{ session('transfer_success') }}
            </div>
        @endif
        <div class="transaction-profile mb-3">
            <img src="{{ asset('images/mobile-payment.png') }}" />
        </div>
        <p
            class="text-center @if ($trxDetail->type == 1) text-success
        @elseif ($trxDetail->type == 2)
           text-danger @endif">
            {{ number_format($trxDetail->amount) }} MMK</p>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Transaction No.</span>
            <p>{{ $trxDetail->trx_id }}</p>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Reference Number</span>
            <p>{{ $trxDetail->ref_no }}</p>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Type</span>
            @if ($trxDetail->type == 1)
                <span class="badge badge-pill badge-success">Income</span>
            @elseif ($trxDetail->type == 2)
                <span class="badge badge-pill badge-danger">Expense</span>
            @endif
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Amount</span>
            <p>{{ number_format($trxDetail->amount) }} MMK</p>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Date and Time</span>
            <p>{{ $trxDetail->created_at }}</p>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            @if ($trxDetail->type == 1)
                <span class="text-muted">From</span>
            @elseif($trxDetail->type == 2)
                <span class="text-muted">To</span>
            @endif
            <p>{{ $trxDetail->source ? $trxDetail->source->name : '-' }}</p>
        </div>
        <hr>

        <div class="d-flex justify-content-between">
            <span class="text-muted">Description</span>
            <p>{{ $trxDetail->description }}</p>
        </div>
    </x-card-wrapper>
</x-layout>
