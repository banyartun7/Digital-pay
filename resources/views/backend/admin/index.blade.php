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
                    <th class="no-sort">Name</th>
                    <th class="no-sort">Email</th>
                    <th class="no-sort">Phone</th>
                    <th class="no-sort">Ip</th>
                    <th class="no-sort">User Agent</th>
                    <th class="no-sort">Created_at</th>
                    <th class="no-sort">Updated_at</th>
                    <th class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->ip }}</td>
                        <td>
                            @if ($admin->user_agent)
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Device</th>
                                        <td>
                                            <?php $agent->setUserAgent($admin->user_agent);
                                            echo $agent->device();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Platform</th>
                                        <td>
                                            <?php $agent->setUserAgent($admin->user_agent);
                                            echo $agent->platform();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Browser</th>
                                        <td>
                                            <?php $agent->setUserAgent($admin->user_agent);
                                            echo $agent->browser();
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $admin->created_at->diffForHumans() }}</td>
                        <td>{{ $admin->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.admin-user.edit', $admin->id) }}" style="margin-right:15px"
                                    class="icon text-warning">
                                    <i style="font-size:20px" class="fa-solid fa-user-pen"></i></a> |
                                <form action="{{ route('admin.admin-user.destroy', $admin->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure to delete?')" style="margin-left:25px"
                                        class="text-danger
                                border-0" type="submit">
                                        <i style="font-size:20px" class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card-wrapper>
    @section('datatable')
        <script>
            new DataTable('#example', {
                columnDefs: [{
                    targets: "no-sort",
                    sortable: false
                }],
            });
        </script>
    @endsection
</x-admin_layouts>
