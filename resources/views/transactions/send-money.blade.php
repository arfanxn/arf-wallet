<x-app-layout title="Kirim Uang" :navbar-top="false" :navbar-bottom="false">
    <x-transaction-header class="h-25" route="{{ route('home') }}">Kirim Uang</x-transaction-header>

    <div class="position-absolute col-4 mt-5" style="z-index: 99999">
        <div class="bg-white mx-auto rounded px-2 py-2" style="width: 95%;">
            <h6 class="fw-bold d-block">Kirim Cepat</h6>
            <div class="input-group mb-3 mt-3">
                <span class="input-group-text bg-white py-1 px-2" id="basic-addon1">
                    <img class="w-100 p-0 m-0" src="{{ asset('icon/search.png') }}" alt="">
                </span>
                <input type="text" class="form-control border-0 border-top border-bottom border-end bg-white "
                    placeholder="Alamat Wallet atau Alias" aria-describedby="basic-addon1">
            </div>
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
</x-app-layout>
