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

            <div class="pt-3">
                <h6 class="fw-bold text-secondary mb-3">Jumlah Kirim</h6>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white" id="basic-addon1">Rp</span>
                    <input type="number" class="form-control bg-white border-0 border-end border-bottom border-top"
                        placeholder="0" aria-describedby="basic-addon1">
                </div>

                <div class="mb-3">
                    <textarea class="form-control bg-white"
                        placeholder="Catatan transaksi : &#8220Untuk makan siang!&#148" rows="
                        3"></textarea>
                </div>

            </div>


        </div>
    </div>
</x-app-layout>
