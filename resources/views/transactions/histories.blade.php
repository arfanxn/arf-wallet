<x-app-layout title="Riwayat Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-transaction-header route="{{ route('home') }}">
        Riwayat Transaksi
    </x-transaction-header>

    <div class="w-100 py-5">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="transactions-sorting" id="radioNewest" checked
                value="newest">
            <label class="form-check-label" for="radioNewest">Terbaru</label>

        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="transactions-sorting" id="radioOldest" value="oldest">
            <label class="form-check-label" for="radioOldest">Terlama</label>
        </div>
    </div>

    <main id="transactionListsWrapper" class="bg-light  overflow-auto">
        @foreach ($transactions as $transaction)
            <a href="{{ route('transaction.detail', $transaction->tx_hash) }}" data-transaction="{{ $transaction }}"
                data-authWallet="{{ $authWallet }}"
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

    <div class="py-5 my-5 w-100" style="height: 600px"></div>
    <footer
        class="bg-white fixed-bottom  offset-md-4 col-12 col-md-4 text-center py-1 px-2 d-flex justify-content-around">
        <div class="cursor-pointer" onclick="triggerElements('#triggerModalTransactionSorting')">
            <h6 class="align-middle">
                <x-icon.sorting-order /> Urutkan
            </h6>
        </div>
        <div>
            <h6 class="align-middle">
                <x-icon.filter /> Filter
            </h6>
        </div>

    </footer>

    <x-modal.transaction-sorting />
    <x-slot name="scripts">
        <script src="{{ asset('js/transactions/sorting.js') }}"></script>
        <script src="{{ asset('js/Controllers/TransactionHistoryController.js') }}"></script>
    </x-slot>

</x-app-layout>
