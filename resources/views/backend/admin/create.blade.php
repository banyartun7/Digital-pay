<x-admin_layouts>
    <x-slot name="title">
        <title>Create Admin</title>
    </x-slot>
    <x-slot name="header">Create Admin</x-slot>
    <x-card-wrapper>
        <form action="{{ route('admin.admin-user.store') }}" method="POST" id="create">
            @csrf
            <x-form.input name="name" />
            <x-form.input name="email" type="email" />
            <x-form.input name="phone" />
            <x-form.input name="password" type="password" />

            <div class="d-flex justify-content-center">
                <button style="margin-right:10px" class="btn btn-secondary btn-back">Cancel</button>
                <button type="submit" class="btn btn-success">Enter</button>
            </div>

        </form>
    </x-card-wrapper>
    @section('datatable')
        {!! JsValidator::formRequest('App\Http\Requests\AdminUserRequest', '#create') !!}
    @endsection
</x-admin_layouts>
