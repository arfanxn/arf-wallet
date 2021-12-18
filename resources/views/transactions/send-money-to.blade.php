<x-app-layout title="Kirim Ke {{ $toWallet->owner->name }}" :navbar-top="false" :navbar-bottom="false">

    <x-navbar-withBackBtn class="h-25" route="{{ route('transaction.send-money') }}">Kirim ke
        {{ $toWallet->owner->name }}
    </x-navbar-withBackBtn>

    <div class="position-absolute col-12 col-md-4 mt-5" style="z-index: 99999">
        <div class="bg-white mx-auto rounded px-2 py-2" style="width: 95%;">
            <div
                class="d-flex border-bottom border-secondary pt-1 pb-3 mb-2 text-decoration-none text-dark align-middle">

                <x-profile-picture class="mx-1" width="50" height="50" />

                <div class="my-auto ms-2">
                    <h6 class="fw-bold m-0 p-0">{{ $toWallet->owner->name }}</h6>
                    <small class="">{{ stringCensor($toWallet->address) }}</small>
                </div>
            </div>

            <div id="serverErrorWrapper">
                {{-- This DIV used for wrapping error alert that will be printed if server error 
                    (Printed By Javascript DOM) --}}
            </div>


            <form>
                @csrf
                <label for="input-amount" class="fw-bold text-secondary mb-2">Jumlah Kirim</label>
                <div class="input-group ">
                    <span class="input-group-text bg-white">Rp</span>
                    <input type="number" name="amount" autofocus value="{{ old('amount') }}"
                        class="form-control bg-white border-0 border-end border-bottom border-top 
                        @error('amount') is-invalid @enderror"
                        placeholder="0" id="input-amount">
                </div>
                <div id="inputErrorAmountWrapper">
                    {{-- Loaded By JS --}}
                </div>

                <div class="mt-3">
                    <textarea class="form-control bg-white" name="description"
                        placeholder="Catatan transaksi : &#8220Untuk makan malam!&#148" rows="
                        3"></textarea>
                    <div id="inputErrorDescriptionWrapper">
                        {{-- Loaded By JS --}}
                    </div>
                </div>
            </form>

            @if ($lastTransactionTo)
                <div class="w-100 py-2 alert-secondary px-3 mt-3">
                    <span>Transaksi Terakhir : {{ $lastTransactionTo->created_at->format('j F Y') }}</span>
                </div>
            @endif

            <footer
                class="fixed-bottom offset-md-4 col-12 col-md-4 d-flex justify-content-between  rounded-top bg-light border-top border-dark pt-1 px-2">
                <div class="d-flex">

                    <x-icon.wallet class="me-2"></x-icon.wallet>
                    <div class="">
                        <small class="fw-bold">Saldo</small>
                        <h6>{{ toIDR($authWallet->balance) }}</h6>
                    </div>
                </div>
                <div class="my-auto">
                    <button class="btn btn-secondary px-4" id="btnProcessTransfer">Kirim</button>
                </div>
            </footer>
        </div>
    </div>

    <x-modal.pin-confirmation />

    <x-slot name="scripts">
        <script src="{{ asset('js/Modals/PinConfirmationModal.js') }}"></script>
        <script src="{{ asset('js/Transactions/SendMoneyTo.js') }}"></script>
    </x-slot>
</x-app-layout>
