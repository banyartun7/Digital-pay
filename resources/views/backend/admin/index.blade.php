<x-admin_layouts>
    <x-slot name="title">
        <title>Admin User</title>
    </x-slot>
    <x-slot name="header">Admin User</x-slot>
    <div>
        <a href="{{ route('admin.admin-user.create') }}" class="btn btn-primary">
            <i style="margin-right:7px" class="fa-solid fa-user-plus"></i>
            Create Admin
        </a>
    </div>
    <x-card-wrapper>
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card-wrapper>
    @section('datatable')
        <script>
            new DataTable('#example');
        </script>
    @endsection
</x-admin_layouts>
