<div class="container">
    <div class="row justify-content-center">
        <div class="bot">
            <div class="bot-menu">
                <div class="home icon-menu">
                    <a href="/">
                        <i class="fa-solid font-icon fa-house pb-1"></i>
                        <span>Home</span>
                    </a>
                </div>

                <div class="transfer icon-menu">
                    <a href={{ route('transaction') }}>
                        <i class="fa-solid font-icon pb-1 fa-money-bill-transfer"></i>
                        <span>Transaction</span>
                    </a>
                </div>


                <a class="scan" href="{{ route('scan_pay') }}">
                    <div class="inside">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>

                </a>

                <div class="account icon-menu">
                    <a href="{{ route('profile') }}">
                        <i class="fa-solid font-icon fa-user pb-1"></i>
                        <span>Account</span>
                    </a>
                </div>
                <div class="wallet icon-menu">
                    <a href="{{ route('wallet') }}">
                        <i class="fa-solid font-icon fa-wallet pb-1"></i>
                        <span>Wallet</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
