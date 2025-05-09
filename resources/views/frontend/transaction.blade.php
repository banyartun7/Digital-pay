<x-layout>
    <x-slot name="title">
        <title>Transaction</title>
    </x-slot>
    @section('header', 'Transaction')

    <div class="card mt-2">

        <div class="card-body">
            <div class="d-flex">
                <i class="fas fa-filter"></i>
                <h6>Filter</h6>
            </div>
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
                        <label class="input-group-text">Date</label>
                        <input type="text" class="form-control date"
                            value="{{ request()->date ?? date('Y-m-d') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="mt-3">Transactions</h5>
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
                    var date = $('.date').val();
                    history.pushState(null, '', `?date=${date}&type=${type}`);
                    window.location.reload();
                });

                $('.date').daterangepicker({
                    "singleDatePicker": true,
                    "autoApply": true,
                    "locale": {
                        "format": "YYYY-MM-DD"
                    }
                });

                $('.date').on('apply.daterangepicker', function(ev, picker) {
                    var type = $('.type').val();
                    var date = $('.date').val();
                    history.pushState(null, '', `?date=${date}&type=${type}`);
                    window.location.reload();
                });
            });
        </script>
    @endsection
</x-layout>
