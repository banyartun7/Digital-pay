<x-layout>
    <x-slot name="title">
        <title>Profile</title>
    </x-slot>
    @section('header', 'Profile')
    <div class="profile">
        <img
            src="https://ui-avatars.com/api/?background=5842e3&color=fff&name={{auth()->guard('web')->user()->name}}"
        />
    </div>
    <x-card-wrapper>
        <div class="d-flex justify-content-between">
            <span>Username</span>
            <span>{{$user->name}}</span>
        </div>
        <hr />
        <div class="d-flex justify-content-between">
            <span>Email</span>
            <span>{{$user->email}}</span>
        </div>
        <hr />
        <div class="d-flex justify-content-between">
            <span>Phone</span>
            <span>{{$user->phone}}</span>
        </div>
    </x-card-wrapper>

    <x-card-wrapper>
        <a
            href="{{ route('update_pass') }}"
            class="d-flex text-select justify-content-between"
        >
            <span class="update">Update Password</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
        <hr />
        <div class="d-flex text-select justify-content-between logout">
            <span class="update">Logout</span>
            <i class="fa-solid logout fa-arrow-right"></i>
        </div>
    </x-card-wrapper>
    @section('script')
    <script>
        $(document).ready(function () {
            $(".logout").on("click", function (e) {
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
                            url: "{{route('logout')}}",
                            type: "POST",
                            success: function (res) {
                                window.location.replace("{{route('profile')}}");
                            },
                        });
                    }
                });
            });
        });
    </script>
    @endsection
</x-layout>
