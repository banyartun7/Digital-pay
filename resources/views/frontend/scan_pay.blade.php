<x-layout>
    <x-slot name="title">
        <title>Scan Pay</title>
    </x-slot>
    @section('header', 'Scan & Pay')
    <x-card-wrapper>
        <div class="text-center scanPhoto">
            <img src="{{ asset('images/qrscan.png') }}">
        </div>
        <p class="text-center click_scan mb-4">Click "Scan" button, put QR code in the frame and pay</p>
        <div class="text-center">
            <button type="button" class="btn scan-btn btn-primary" data-toggle="modal" data-target="#myModal">
                <i class="bi bi-upc-scan"></i> Scan</button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Scan & Pay</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <video id="scanner"></video>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-card-wrapper>
    @section('script')
        <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                let videoElem = document.getElementById('scanner');

                const qrScanner = new QrScanner(
                    videoElem,
                    function(result) {
                        console.log(result);
                    }, {
                        returnDetailedScanResult: true
                    });

                $(".modal").on('shown.bs.modal', function(event) {
                    qrScanner.start();
                });

            })
        </script>
    @endsection
</x-layout>
