<x-layout>
    <x-slot name="title">
        <title>Notification Detail</title>
    </x-slot>
    @section('header', 'Notification Detail')
    <x-card-wrapper class="bg-white">
        <div class="cover_noti">
            <img src="{{ asset('images/message-received-44.png') }}" />
        </div>
        <div class="mb-3 text-center">
            <h4 class="mb-2">{{ $notification->data['title'] }}</h4>
            <p class="text-muted mb-2">{{ $notification->data['message'] }}</p>
            <small
                style="color:#071e3d">{{ Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s A') }}</small>
        </div>

        <a href="{{ $notification->data['web_link'] }}" class="btn mx-auto btn-noti btn-primary">Continue</a>
    </x-card-wrapper>

</x-layout>
