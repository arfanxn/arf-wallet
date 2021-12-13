<x-app-layout title="Kirim Uang" :navbar-top="false" :navbar-bottom="false">
    <x-transaction-header class="h-25" route="{{ route('home') }}">Kirim Uang</x-transaction-header>

    <div class="position-absolute col-md-4 col-12 mt-5  " style="z-index: 99999">
        <div class="bg-white mx-auto rounded px-2 py-2 " style="width: 95%;">
            <label class="fw-bold d-block fs-6 my-0 py-0" for="inputSearchWallet">
                Cari Alamat Wallet
            </label>
            <div class="input-group mb-3 mt-2">
                <span class="input-group-text bg-white py-1 px-2" id="basic-addon1">
                    <img class="w-100 p-0 m-0" src="{{ asset('icon/search.png') }}" alt="">
                </span>
                <input type="text" class="form-control border-0 border-top border-bottom border-end bg-white"
                    value="{{ old('search-wallet') }}" id="inputSearchWallet" name="search-wallet"
                    placeholder="Alamat Wallet, contoh : FXZY7...16" aria-describedby="basic-addon1">
            </div>
            <div id="search-wallet-results-wrapper" class=""></div>
            <h6 class="fw-bold mb-0">Tranksaksi terbaru</h6>
            @foreach ($recentWallets as $wallet)
                <a href="{{ route('transaction.send-money.create', Crypt::encryptString($wallet->address)) }}"
                    class="d-flex justify-content-between py-3 border-bottom border-secondary  text-decoration-none text-dark align-middle">
                    <div>
                        <x-profile-picture class="mx-1" width="50" height="50" />
                        <span class="my-auto ">{{ $wallet->owner->name }}</span>
                    </div>

                    <span class="my-auto me-1">{{ stringCensor($wallet->address) }}</span>

                </a>
            @endforeach
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/Wallets/SearchWallet.js') }}"></script>
    </x-slot>

</x-app-layout>
