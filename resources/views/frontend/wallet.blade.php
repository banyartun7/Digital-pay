<x-layout>
    <x-slot name="title">
        <title>Wallet</title>
    </x-slot>
    @section('header', 'Wallet')
    <x-card-wrapper class="wallet-card">
        <div class="mb-4">
            <span>Balance</span>
            <h4>{{ number_format($user->wallet ? $user->wallet->amount : 0) }} <span class="mmk">MMK</span></h4>
        </div>
        <div class="mb-4">
            <span>Account Number</span>
            <h5>{{ $user->wallet ? $user->wallet->account_number : '-' }}</h5>
        </div>
        <div class="mb-4">
            <p>{{ $user->name }}</p>
        </div>
    </x-card-wrapper>


    @section('script')
        <script>
            $(document).ready(function() {
                $(".logout").on("click", function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Are you sure, you want to logout?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6C757D",
                        confirmButtonText: "Confirm!",
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('logout') }}",
                                type: "POST",
                                success: function(res) {
                                    window.location.replace("{{ route('profile') }}");
                                },
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-layout>
