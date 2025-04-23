<x-admin_layouts>
    <x-slot name="title">
        <title>Wallets</title>
    </x-slot>
    <x-slot name="header">Wallet</x-slot>
    @section('wallet-active', 'mm-active')
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
                    <th class="no-sort">Account Number</th>
                    <th>Account Person</th>
                    <th class="no-sort">Amount (MMK)</th>
                    <th class="no-sort">Created_at</th>
                    <th class="no-sort">Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wallets as $wallet)
                    <tr>
                        <td>{{ $wallet->account_number }}</td>
                        <td>
                            <p>Name: <i>{{ $wallet->user->name }}</i></p>
                            <p>Email: <i>{{ $wallet->user->email }}</i></p>
                            <p>Phone: <i>{{ $wallet->user->phone }}</i></p>
                        </td>
                        <td>{{ number_format($wallet->amount, 2) }}</td>

                        <td>{{ date('Y-m-d H:i:s', strtotime($wallet->created_at)) }}</td>
                        <td>{{ date('Y-m-d H:i:s', strtotime($wallet->updated_at)) }}</td>
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
