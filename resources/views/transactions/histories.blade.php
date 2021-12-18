<x-app-layout title="Riwayat Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-navbar-withBackBtn route="{{ route('home') }}">
        Riwayat Transaksi
    </x-navbar-withBackBtn>


    <main id="transaction-pagination-wrapper" class="bg-light mt-3 pt-3  overflow-auto">
        {{-- PAGINATION WILL BE PRINTED WITH JS VIA API REQUEST --}}
        {{-- @foreach ($transactions as $transaction)
            <a href="{{ route('transaction.detail', $transaction->tx_hash) }}" data-transaction="{{ $transaction }}"
                class="transaction  d-flex justify-content-between py-3 border-bottom border-secondary mx-3 text-decoration-none text-dark">
                <div class="my-auto">
                    <span class="d-block">
                        {{ $authWallet->id == $transaction->from_wallet_id ? 'Kirim Uang' : 'Terima Uang' }}</span>
                    <small>{{ $transaction->created_at }}</small>
                </div>
                <div class="my-auto">
                    <span class="align-middle">{{ toIDR($transaction->amount) }}</span>
                </div>
            </a>
        @endforeach --}}
    </main>

    <div class="d-flex justify-content-between mt-3 mx-3 align-middle">
        <div class="">
            <h6 class="my-auto badge bg-info rounded fs-6">Page : <span
                    id="totalCurrentPageTransactionPagination"></span></h6>
        </div>
        <div id="btnWrapperTransactionPagination"></div>
    </div>
    {{-- <div id="btnWrapperTransactionPagination" class="d-flex justify-content-end mt-3 me-3"></div> --}}

    <div class="py-5 my-5 w-100" style="height: 400px"></div>
    <footer
        class="bg-white fixed-bottom  offset-md-4 col-12 col-md-4 text-center py-1 px-2 d-flex justify-content-evenly">
        <div class="cursor-pointer">
            <x-icon.sorting-order />
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transactions-sorting" id="radioNewest" checked
                    @if (old('transactions-sorting') == 'newest') checked @endif value="newest">
                <label class="form-check-label" for="radioNewest">Terbaru</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transactions-sorting" id="radioOldest"
                    @if (old('transactions-sorting') == 'oldest') checked @endif value="oldest">
                <label class="form-check-label" for="radioOldest">Terlama</label>
            </div>
        </div>

        <div onclick="triggerElements(`#modalTransactionFilter` , (el) => {el.classList.remove(`d-none`)})"
            class="cursor-pointer">
            <h6 class="align-middle">
                <x-icon.filter /> Filter
            </h6>
        </div>

    </footer>

    <x-modal.transaction-filter />
    <x-slot name="scripts">
        <script src="{{ asset('js/Transactions/TransactionPaginator.js') }}"></script>
    </x-slot>

</x-app-layout>
