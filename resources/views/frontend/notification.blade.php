<x-layout>
    <x-slot name="title">
        <title>Notifications</title>
    </x-slot>
    @section('header', 'Notifications')

    @foreach ($notifications as $notification)
        <a href="{{ route('noti_detail', $notification->id) }}">
            <x-card-wrapper class="transaction_card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 style="font-weight: bold">{{ Str::limit($notification->data['title'], 25) }}</h6>
                    <i class="fa-solid fa-bell noti-bell @if (is_null($notification->read_at)) text-danger @endif"></i>
                </div>
                <p class="mb-1">{{ Str::limit($notification->data['message'], 50) }}</p>
                <small
                    class="text-muted">{{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A') }}</small>
            </x-card-wrapper>
        </a>
    @endforeach
    {{ $notifications->links() }}

</x-layout>
