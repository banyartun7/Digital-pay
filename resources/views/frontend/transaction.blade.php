<x-layout>
    <x-slot name="title">
        <title>Transaction</title>
    </x-slot>
    @section('header', 'Transaction')

    <div class="card mt-2">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="input-group">
                        <label class="input-group-text">Type</label>
                        <select class="form-select type">
                            <option value="">All...</option>
                            <option value="1" @if (request()->type == 1) selected @endif>Income</option>
                            <option value="2" @if (request()->type == 2) selected @endif>Expense</option>
                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option value="">Choose...</option>
                            <option value="1" @if (request()->type == 1) selected @endif>Income</option>
                            <option value="2" @if (request()->type == 2) selected @endif>Expense</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    @section('script')
        <script>
            $(document).ready(function() {
                $(".type").change(function() {
                    var type = $('.type').val();
                    history.pushState(null, '', `?type=${type}`);
                    window.location.reload();
                });
            });
        </script>
    @endsection
</x-layout>
