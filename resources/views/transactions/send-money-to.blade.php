<x-app-layout title="Kirim Ke {{ $toWallet->owner->name }}" :navbar-top="false" :navbar-bottom="false">

    <x-transaction-header class="h-25" route="{{ route('transaction.send-money') }}">Kirim ke
        {{ $toWallet->owner->name }}
    </x-transaction-header>

    <div class="position-absolute col-4 mt-5" style="z-index: 99999">
        <div class="bg-white mx-auto rounded px-2 py-2" style="width: 95%;">
            <div class="d-flex border-bottom border-secondary pt-1 pb-3 text-decoration-none text-dark align-middle">

                <x-profile-picture class="mx-1" width="50" height="50" />

                <div class="my-auto ms-2">
                    <h6 class="fw-bold m-0 p-0">{{ $toWallet->owner->name }}</h6>
                    <small class="">{{ stringCensor($toWallet->address) }}</small>
                </div>

            </div>

            <div class="pt-2">
                <label for="input-amount" class="fw-bold text-secondary mb-2">Jumlah Kirim</label>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon1">Rp</span>
                    <input type="number" class="form-control bg-white border-0 border-end border-bottom border-top"
                        placeholder="0" id="input-amount">
                </div>

                <div>
                    <textarea class="form-control bg-white"
                        placeholder="Catatan transaksi : &#8220Untuk makan malam!&#148" rows="
                        3"></textarea>
                </div>

            </div>

            @isset($lastTransactionTo)
                <div class="w-100 py-2 alert-secondary px-3 mt-3">
                    <span>Transaksi Terakhir : {{ $lastTransactionTo->created_at->format('j F Y') }}</span>
                </div>
            @endisset

            <footer
                class="fixed-bottom offset-md-4 col-12 col-md-4 d-flex justify-content-between  rounded-top bg-light border-top border-dark pt-1 px-2">
                <div class="d-flex">
                    <x-icon.wallet class="me-2"></x-icon.wallet>
                    <div class="">
                        <small class="fw-bold">Saldo</small>
                        <h6>{{ toIDR($authWallet->balance) }}</h6>
                    </div>
                </div>
                <div class="my-auto"><button class="btn btn-secondary px-4">Kirim</button></div>
            </footer>



        </div>
    </div>
</x-app-layout>
