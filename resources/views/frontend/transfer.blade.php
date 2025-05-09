<x-layout>
    <x-slot name="title">
        <title>Transfer</title>
    </x-slot>
    @section('header', 'Transfer')
    <x-card-wrapper>
        <div class="from">
            <p>From</p>
            <span class="text-muted">{{ $user->name }}</span>
            <span class="text-muted">{{ $user->phone }}</span>
        </div>
        <form action="{{ route('confirm_transfer') }}" method="GET" id="transfer-form">
            <input type="hidden" class="hash_value" value="" name="hash_value">
            <div class="To">
                <div class="form-group mb-3">
                    <label for="to" class="mb-2">To <span class="verify-name"></span></label>
                    <div class="input-group">
                        <input id="to" type="text"
                            class="form-control phone_to @error('to') is-invalid @enderror" name="to"
                            value="{{ old('to') }}" placeholder="Enter phone number..." />
                        <span class="input-group-text btn verify-btn"><i class="fas fa-check-circle"></i></span>
                    </div>
                    @error('to')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
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
                $(".verify-btn").on("click", function() {
                    var phone = $(".phone_to").val();
                    $.ajax({
                        url: "/verify?phone=" + phone,
                        type: "GET",
                        success: function(res) {
                            if (res.status == "success") {
                                $(".verify-name")
                                    .text("(" + res.data["name"] + ")")
                                    .removeClass("text-danger");
                                $(".verify-name")
                                    .text("(" + res.data["name"] + ")")
                                    .addClass("text-success");
                            } else {
                                $(".verify-name")
                                    .text("(" + res.message + ")")
                                    .removeClass("text-success");
                                $(".verify-name")
                                    .text("(" + res.message + ")")
                                    .addClass("text-danger");
                            }
                        },
                    });
                });

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
