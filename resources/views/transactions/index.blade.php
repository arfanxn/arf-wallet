<x-app-layout title="Riwayat Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-transaction-header route="{{ route('home') }}">
        Riwayat Transaksi
    </x-transaction-header>

    <main class="bg-light mt-3 pt-3">
        @foreach ($transactions as $transaction)
            <a href="{{ route('transaction.detail', $transaction->tx_hash) }}"
                class="d-flex justify-content-between py-3 border-bottom border-secondary mx-3 text-decoration-none text-dark">
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

    <footer
        class="bg-white fixed-bottom  offset-md-4 col-12 col-md-4 text-center py-1 px-2 d-flex justify-content-around">
        <div>
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


</x-app-layout>
