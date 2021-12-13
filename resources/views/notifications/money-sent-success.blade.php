<x-mail-layout>
    <h2>Hai <span class="fw-bold">{{ ucwords($fromWallet->owner->name) }}</span>, Transaksi
        Berhasil!</h2>
    <br>

    <div>
        <p>Kirim Uang senilai <span class="fw-bold">{{ toIDR($transaction->amount) }}</span>
            pada <span class="fw-bold">
                {{ $transaction->created_at->format('j F Y H:i T') }} (WIB)</span>
        </p>
        <p>Dari Wallet <span class="fw-bold">{{ stringCensor($fromWallet->address) }}</span> atas nama <span
                class="fw-bold">{{ ucwords($fromWallet->owner->name) }}</span></p>
        <p>Wallet tujuan <span class="fw-bold">{{ stringCensor($toWallet->address) }}</span> atas nama <span
                class="fw-bold">{{ ucwords($toWallet->owner->name) }}</span></p>
    </div>

    <br><br>
    <div>
        <p>Klik dibawah untuk Detail Transaksi (Invoice)</p>
        <a class="btn btn-info" href="{{ route('transaction.detail', $transaction->tx_hash) }}"> Invoice</a>
        <br><br>
        <small style="color: red">Pastikan anda sudah login untuk mengakses Detail Transaksi (Invoice)</small>
    </div>



</x-mail-layout>
