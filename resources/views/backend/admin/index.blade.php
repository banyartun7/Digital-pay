<x-admin_layouts>
    <x-slot name="title">
        <title>Admin User</title>
    </x-slot>
    <x-slot name="header">Admin User</x-slot>
    @section('active', 'mm-active')
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td class="d-flex align-items-center justify-content-center">
                            <a href="{{ route('admin.admin-user.edit', $admin->id) }}" style="margin-right:15px"
                                class="icon text-warning">
                                <i style="font-size:23px" class="fa-solid fa-user-pen"></i></a> |
                            <form action="{{ route('admin.admin-user.destroy', $admin->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button style="margin-left:25px"
                                    class="text-danger
                                border-0" type="submit">
                                    <i style="font-size:23px" class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
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
