<x-layout>
    <x-slot name="title">
        <title>Transfer</title>
    </x-slot>
    @section('header', 'Transfer')
    <x-card-wrapper>
        <div class="from">
            <p>From</p>
            <span class="text-muted">{{ $user->name }}</span>
            <span class="text-muted">{{ $user->phone }}</span>
        </div>
        <form action="{{ route('confirm_transfer') }}" method="GET">
            <div class="To">
                <div class="form-group mb-3">
                    <label for="to" class="mb-2">To <span class="verify-name"></span></label>
                    <div class="input-group">
                        <input id="to" type="text"
                            class="form-control phone_to @error('to') is-invalid @enderror" name="to"
                            value="{{ old('to') }}" placeholder="Enter phone number...">
                        <span class="input-group-text btn verify-btn bg-light-subtle"><i
                                class="fas fa-check-circle"></i></span>
                    </div>
                    @error('to')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="amount" class="mb-2">Amount (MMK)</label>
                    <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror"
                        name="amount" value="{{ old('amount') }}" placeholder="Enter amount...">
                    @error('amount')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="note" class="mb-2">Notes</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note"
                        placeholder="Enter some note...">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button class="btn btn-primary mt-4 form-control">Continue</button>
            </div>
        </form>
    </x-card-wrapper>
    @section('script')
        <script>
            $(document).ready(function() {
                $('.verify-btn').on('click', function() {
                    var phone = $('.phone_to').val();
                    $.ajax({
                        url: '/verify?phone=' + phone,
                        type: 'GET',
                        success: function(res) {
                            if (res.status == 'success') {
                                $('.verify-name').text('(' + res.data['name'] + ')').toggleClass(
                                    'text-danger');
                            } else {
                                $('.verify-name').text('(' + res.message + ')').toggleClass(
                                    'text-success');
                            }
                        },
                    });
                })
            })
        </script>
    @endsection
</x-layout>
