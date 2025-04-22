<x-admin_layouts>
    <x-slot name="title">
        <title>User Form</title>
    </x-slot>
    <x-slot name="header">User Form</x-slot>
    @section('user-active', 'mm-active')
    <div>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i style="margin-right:7px" class="fa-solid fa-user-plus"></i>
            Create User
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
                    <th class="no-sort">Login_at</th>
                    <th class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->ip }}</td>
                        <td>
                            @if ($user->user_agent)
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Device</th>
                                        <td>
                                            <?php $agent->setUserAgent($user->user_agent);
                                            echo $agent->device();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Platform</th>
                                        <td>
                                            <?php $agent->setUserAgent($user->user_agent);
                                            echo $agent->platform();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Browser</th>
                                        <td>
                                            <?php $agent->setUserAgent($user->user_agent);
                                            echo $agent->browser();
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('admin.user.edit', $user->id) }}" style="margin-right:15px"
                                    class="icon text-warning">
                                    <i style="font-size:20px" class="fa-solid fa-user-pen"></i></a> |
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
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
