<x-layout>
    <x-slot name="title">
        <title>ReceiveQR</title>
    </x-slot>
    @section('header', 'Receive QR')
    <x-card-wrapper>
        <p class="text-center">Scan to pay me</p>
        <div class="text-center mb-3">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(130)->generate($authUser->phone)) !!} ">
        </div>
        <p class="text-center mb-0">{{ $authUser->name }}</p>
        <p class="text-center">{{ $authUser->phone }}</p>
    </x-card-wrapper>
</x-layout>
