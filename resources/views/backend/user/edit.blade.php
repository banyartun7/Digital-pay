<x-admin_layouts>
    <x-slot name="title">
        <title>Edit User</title>
    </x-slot>
    @section('user-active', 'mm-active')
    <x-slot name="header">Edit User</x-slot>
    <x-card-wrapper>
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" id="edit">
            @csrf
            @method('PUT')
            <x-form.input name="name" :value="$user->name" />
            <x-form.input name="email" type="email" :value="$user->email" />
            <x-form.input name="phone" :value="$user->phone" />
            <x-form.input name="password" type="password" />

            <div class="d-flex justify-content-center">
                <button style="margin-right:10px" class="btn btn-secondary btn-back">Cancel</button>
                <button type="submit" class="btn btn-warning text-white">Update</button>
            </div>

        </form>
    </x-card-wrapper>
    @section('datatable')
        {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest', '#edit') !!}
    @endsection
</x-admin_layouts>
