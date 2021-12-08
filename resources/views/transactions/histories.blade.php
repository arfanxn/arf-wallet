<x-app-layout title="Riwayat Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-transaction-header route="{{ route('home') }}">
        Riwayat Transaksi
    </x-transaction-header>


    <main id="transactionListsWrapper" class="bg-light mt-3 pt-3  overflow-auto"
        data-authWallet="{{ $authWallet->only('user_id')['user_id'] }}">
        @foreach ($transactions as $transaction)
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
        @endforeach
    </main>

    <div class="py-5 my-5 w-100" style="height: 400px"></div> --}}
    <footer
        class="bg-white fixed-bottom  offset-md-4 col-12 col-md-4 text-center py-1 px-2 d-flex justify-content-evenly">
        <div class="cursor-pointer">
            <x-icon.sorting-order />
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transactions-sorting" id="radioNewest" checked
                    value="newest">
                <label class="form-check-label" for="radioNewest">Terbaru</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transactions-sorting" id="radioOldest"
                    value="oldest">
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
        <script src="{{ asset('js/Controllers/TransactionHistoryController.js') }}"></script>
    </x-slot>

</x-app-layout>
