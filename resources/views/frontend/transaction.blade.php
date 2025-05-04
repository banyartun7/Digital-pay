<x-layout>
    <x-slot name="title">
        <title>Transaction</title>
    </x-slot>
    @section('header', 'Transaction')
    @foreach ($transactions as $transaction)
        <a href="/transaction/detail?trx_id={{ $transaction->trx_id }}">
            <x-card-wrapper class="transaction_card">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="header-font">Transaction No. {{ $transaction->trx_id }}</p>
                    <p class="{{ $transaction->type == 2 ? 'text-danger' : 'text-success' }}">
                        {{ number_format($transaction->amount) }} MMK</p>
                </div>
                <p class="text-muted">
                    @if ($transaction->type == 2)
                        To:
                    @elseif ($transaction->type == 1)
                        From:
                    @endif
                    {{ $transaction->source ? $transaction->source->name : '' }}
                </p>
                <span class="text-muted">{{ $transaction->created_at }}</span>
            </x-card-wrapper>
        </a>
    @endforeach
    {{ $transactions->links() }}
</x-layout>
