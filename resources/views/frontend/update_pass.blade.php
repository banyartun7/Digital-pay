<x-layout>
    <x-slot name="title">
        <title>Update password</title>
    </x-slot>
    @section('header', 'Update Password')
    <x-card-wrapper class="bg-white">
        <div class="cover">
            <img src="{{ asset('images/security.png') }}" />
        </div>

        @error('fail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <form action="{{ route('update-pass.store') }}" method="POST">
            @csrf
            <div class="form-group mb-4">
                <label for="old_pass" class="mb-2">Old Password</label>
                <input type="password" name="old_pass" class="form-control @error('old_pass') is-invalid @enderror"
                    id="old_pass" placeholder="Enter Old Password">
                @error('old_pass')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="password" class="mb-2">New Password</label>
                <input type="password" name="new_pass" class="form-control @error('new_pass') is-invalid @enderror"
                    id="passwod" placeholder="Enter New Password">
                @error('new_pass')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" style="width:100%" class="mt-3 btn btn-primary">Update</button>
        </form>
    </x-card-wrapper>

</x-layout>
