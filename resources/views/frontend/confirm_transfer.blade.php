<x-layout>
    <x-slot name="title">
        <title>Confirm</title>
    </x-slot>
    @section('header', 'Transfer Confirmation')
    <x-flash name="fail" />
    <x-card-wrapper>
        <form action="{{ route('complete') }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="to" value="{{ $to_user->phone }}" />
            <input type="hidden" name="amount" value="{{ $amount }}" />
            <input type="hidden" name="note" value="{{ $note }}" />
            <div class="from">
                <p>Transfer From</p>
                <span class="text-muted">{{ $user->name }}</span>
                <span class="text-muted">{{ $user->phone }}</span>
            </div>
            <div class="from">
                <span>To</span>
                <span class="text-muted">{{ $to_user->name }}</span>
                <span class="text-muted">{{ $to_user->phone }}</span>
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
            <button class="btn btn-primary mt-2 btn-pass form-control">Confirm</button>
        </form>
    </x-card-wrapper>
    @section('script')
        <script>
            $(document).ready(function() {
                $(".btn-pass").on("click", function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Please fill your password",
                        icon: "info",
                        html: `<input class="form-control check_pass text-center" type="password" name="pass"/>`,
                        showCancelButton: true,
                        confirmButtonText: "Confirm",
                        cancelButtonText: "Cancel",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var password = $('.check_pass').val();
                            $.ajax({
                                url: '/transfer/confirm/password-check?password=' + password,
                                type: "GET",
                                success: function(res) {
                                    if (res.status == 'success') {
                                        $('#form').submit();
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: res.message,
                                        });
                                    }
                                },
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-layout>
