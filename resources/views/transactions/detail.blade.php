<x-app-layout title="Detail Transaksi" :navbar-top="false" :navbar-bottom="false">

    <x-slot name="styles">
        <style>
            .invoice-bg {
                width: 95%;
            }

        </style>
    </x-slot>

    <x-transaction-header route="{{ route('transaction.history') }}" class="h-25">
        Detail Transaksi
    </x-transaction-header>

    <div class="position-absolute col-4 mt-5" style="z-index: 99999">
        <div class="invoice-bg bg-white mx-auto rounded px-0">
            <div class="px-2 pb-5">
                <div class="text-center py-3 ">
                    <x-icon.wallet withBrand="true" />
                </div>
                <div class="d-flex justify-content-between pb-1 border-bottom border-secondary">
                    <small>{{ $transaction->created_at }}</small>
                    <small>Address: {{ stringCensor($authWallet->address) }}</small>
                </div>
                <div class="mt-1 border-bottom border-secondary pb-3">
                    @if ($authWallet->id == $transaction->from_wallet_id)
                        <p class="text-break fw-bold mb-0">Kirim Uang {{ toIDR($transaction->amount) }} ke
                            {{ strtoupper($transaction->toWallet->owner->name) }} -
                            {{ stringCensor($transaction->toWallet->address) }}</p>
                        <div class="badge bg-secondary fw-light mb-3">KIRIM UANG</div>
                        <div class="badge bg-info d-flex justify-content-between text-dark  align-items-center">
                            <h6 class="align-middle fw-bold ">Total</h6>
                            <h6 class="align-middle fw-bold ">{{ toIDR($transaction->amount) }}</h6>
                        </div>
                    @else
                        <p class="text-break fw-bold mb-0">Terima Uang {{ toIDR($transaction->amount) }} dari
                            {{ strtoupper($transaction->fromWallet->owner->name) }} -
                            {{ stringCensor($transaction->fromWallet->address) }}</p>
                        <div class="badge bg-secondary fw-light mb-3">TERIMA UANG</div>
                        <div class="badge bg-info d-flex justify-content-between text-dark  align-items-center">
                            <h6 class="align-middle fw-bold ">Total</h6>
                            <h6 class="align-middle fw-bold ">{{ toIDR($transaction->amount) }}</h6>
                        </div>
                    @endif
                </div>
                @if ($transaction->description)
                    <div class="mt-3 border-bottom border-secondary ">
                        <h6 class="fw-bold">Deskripsi</h6>
                        <p>{{ $transaction->description }}</p>
                    </div>
                @endif
                <div class="mt-3 pb-5">
                    @if ($authWallet->id == $transaction->from_wallet_id)
                        <h6 class="fw-bold">Detail Penerima</h6>
                        <div class="d-flex justify-content-between">
                            <span>Nama</span> <span>{{ strtoupper($transaction->toWallet->owner->name) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Address</span> <span>{{ stringCensor($transaction->toWallet->address) }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">TX HASH</span>
                            <span class="fw-bold">{{ $transaction->tx_hash }}</span>
                        </div>
                    @else
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">TX HASH</span>
                            <span class="fw-bold">{{ $transaction->tx_hash }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f8f9fa" fill-opacity="1"
                    d="M0,224L0,96L36.9,96L36.9,224L73.8,224L73.8,64L110.8,64L110.8,96L147.7,96L147.7,96L184.6,96L184.6,128L221.5,128L221.5,192L258.5,192L258.5,128L295.4,128L295.4,0L332.3,0L332.3,96L369.2,96L369.2,224L406.2,224L406.2,128L443.1,128L443.1,288L480,288L480,128L516.9,128L516.9,288L553.8,288L553.8,0L590.8,0L590.8,224L627.7,224L627.7,224L664.6,224L664.6,64L701.5,64L701.5,160L738.5,160L738.5,160L775.4,160L775.4,128L812.3,128L812.3,192L849.2,192L849.2,96L886.2,96L886.2,224L923.1,224L923.1,0L960,0L960,192L996.9,192L996.9,320L1033.8,320L1033.8,128L1070.8,128L1070.8,160L1107.7,160L1107.7,256L1144.6,256L1144.6,224L1181.5,224L1181.5,320L1218.5,320L1218.5,224L1255.4,224L1255.4,256L1292.3,256L1292.3,0L1329.2,0L1329.2,288L1366.2,288L1366.2,64L1403.1,64L1403.1,96L1440,96L1440,320L1403.1,320L1403.1,320L1366.2,320L1366.2,320L1329.2,320L1329.2,320L1292.3,320L1292.3,320L1255.4,320L1255.4,320L1218.5,320L1218.5,320L1181.5,320L1181.5,320L1144.6,320L1144.6,320L1107.7,320L1107.7,320L1070.8,320L1070.8,320L1033.8,320L1033.8,320L996.9,320L996.9,320L960,320L960,320L923.1,320L923.1,320L886.2,320L886.2,320L849.2,320L849.2,320L812.3,320L812.3,320L775.4,320L775.4,320L738.5,320L738.5,320L701.5,320L701.5,320L664.6,320L664.6,320L627.7,320L627.7,320L590.8,320L590.8,320L553.8,320L553.8,320L516.9,320L516.9,320L480,320L480,320L443.1,320L443.1,320L406.2,320L406.2,320L369.2,320L369.2,320L332.3,320L332.3,320L295.4,320L295.4,320L258.5,320L258.5,320L221.5,320L221.5,320L184.6,320L184.6,320L147.7,320L147.7,320L110.8,320L110.8,320L73.8,320L73.8,320L36.9,320L36.9,320L0,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>



</x-app-layout>
