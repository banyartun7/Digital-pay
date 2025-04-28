<x-layout>
    <x-slot name="title">
        <title>Wallet</title>
    </x-slot>

    @section('header', 'Wallet')
    <div class="profile">
        <img
            src="https://ui-avatars.com/api/?background=5842e3&color=fff&name={{ auth()->guard('web')->user()->name }}" />
        <p class="mt-2">Mg Mg</p>
        <span>10000 MMK</span>
    </div>
    <div class="transfer-group">
        <x-card-wrapper>

        </x-card-wrapper>

        <x-card-wrapper>

        </x-card-wrapper>
    </div>
</x-layout>
