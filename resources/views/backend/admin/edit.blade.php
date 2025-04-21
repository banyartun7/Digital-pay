<x-admin_layouts>
    <x-slot name="title">
        <title>Edit Admin</title>
    </x-slot>
    <x-slot name="header">Edit Admin</x-slot>
    <x-card-wrapper>
        <form action="{{ route('admin.admin-user.update', $adminUser->id) }}" method="POST" id="edit">
            @csrf
            @method('PUT')
            <x-form.input name="name" :value="$adminUser->name" />
            <x-form.input name="email" type="email" :value="$adminUser->email" />
            <x-form.input name="phone" :value="$adminUser->phone" />
            <x-form.input name="password" type="password" />

            <div class="d-flex justify-content-center">
                <button style="margin-right:10px" class="btn btn-secondary btn-back">Cancel</button>
                <button type="submit" class="btn btn-warning text-white">Update</button>
            </div>

        </form>
    </x-card-wrapper>
    @section('datatable')
        {!! JsValidator::formRequest('App\Http\Requests\AdminUserUpdateRequest', '#edit') !!}
    @endsection
</x-admin_layouts>
