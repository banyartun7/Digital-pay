<x-layout>
    <x-slot name="title">
        <title>Scan & pay</title>
    </x-slot>
    @section('header', 'Scan & Pay')
    <x-card-wrapper>
        <div class="from">
            <p>From</p>
            <span class="text-muted">{{ $from_account->name }}</span>
            <span class="text-muted">{{ $from_account->phone }}</span>
        </div>
        <form action="{{ route('scan_confirm_transfer') }}" method="GET" id="transfer-form">
            <input type="hidden" class="hash_value" value="" name="hash_value">
            <div class="To">
                <div class="To_account">
                    <input type="hidden" class="phone_to" value="{{ $to_account->phone }}" name="to">
                    <span>To</span><br>
                    <span class="text-muted">{{ $to_account->name }}</span><br>
                    <span class="text-muted">{{ $to_account->phone }}</span>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="amount" class="mb-2">Amount (MMK)</label>
                    <input id="amount" type="number"
                        class="form-control amount @error('amount') is-invalid @enderror" name="amount"
                        value="{{ old('amount') }}" placeholder="Enter amount..." />
                    @error('amount')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="note" class="mb-2">Notes</label>
                    <textarea class="form-control note @error('note') is-invalid @enderror" name="note" id="note"
                        placeholder="Enter some note...">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn btn-primary mt-4 continue-btn form-control">
                    Continue
                </button>
            </div>
        </form>
    </x-card-wrapper>
    @section('script')
        <script>
            $(document).ready(function() {
                $(".continue-btn").on("click", function(e) {
                    e.preventDefault();
                    var phone_to = $(".phone_to").val();
                    var amount = $(".amount").val();
                    var note = $(".note").val();
                    $.ajax({
                        url: `/transfer/hash?to=${phone_to}&amount=${amount}&note=${note}`,
                        type: "GET",
                        success: function(res) {
                            if (res.status == "success") {
                                $(".hash_value").val(res.data);
                                $('#transfer-form').submit();
                            }
                        },
                    });
                });
            });
        </script>
    @endsection
</x-layout>
