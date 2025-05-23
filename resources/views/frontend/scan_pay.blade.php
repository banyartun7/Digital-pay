<x-layout>
    <x-slot name="title">
        <title>Scan Pay</title>
    </x-slot>
    @section('header', 'Scan & Pay')
    <x-card-wrapper>
        <x-flash name="fail" />
        <div class="text-center scanPhoto">
            <img src="{{ asset('images/qrscan.png') }}">
        </div>

        <p class="text-center click_scan mb-4">Click "Scan" button, put QR code in the frame and pay</p>
        <div class="text-center">
            <button type="button" id="test-btn" class="btn scan-btn btn-primary" data-toggle="modal"
                data-target="#myModal">
                <i class="bi bi-upc-scan"></i> Scan</button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Scan & Pay</h4>
                            <button type="button" id="scan-close" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <video class="video-style" id="videoElem"></video>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" id="scanClose" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card-wrapper>
    @section('script')
        <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
        <script src="{{ asset('js/qr-scanner.legacy.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                const videoElem = document.getElementById('videoElem');

                const qrScanner = new QrScanner(
                    videoElem,
                    function(result) {
                        if (result) {
                            qrScanner.stop();
                            $('#myModal').modal('hide');
                            var to_phone = result['data'];
                            window.location.replace(`scan-pay-form?to_phone=${to_phone}`);
                        }

                    }, {
                        returnDetailedScanResult: true
                    });

                const test = document.getElementById('test-btn');
                test.addEventListener('click', () => {
                    qrScanner.start();
                });

                document.getElementById('scan-close').addEventListener('click', () => {
                    qrScanner.stop();
                });

                document.getElementById('scanClose').addEventListener('click', () => {
                    qrScanner.stop();
                });

            })
        </script>
    @endsection
</x-layout>
