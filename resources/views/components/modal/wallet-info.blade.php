<!-- Button trigger modal -->
<button id="triggerModalWalletInfo" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
    data-bs-target="#modalWalletInfo">
</button>

<!-- Wallet Info Modal -->
<div class="modal fade" id="modalWalletInfo" tabindex="-1" aria-labelledby="modalWalletInfoLabel" aria-hidden="true">
    <div class="modal-dialog " style="z-index: 9999999999">
        <div class="modal-content bg-light">
            <div class="modal-body">
                <div class="">
                    <x-icon.wallet></x-icon.wallet>
                    <p class="d-inline fw-bold fs-5">ARF-WALLET</p>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <div class="">
                        <h5 id="modalTextWalletOwnerName" class="censor-uncensor d-inline me-2"
                            data-censored="{{ stringCensor(Auth::user()->name) }}"
                            data-uncensored="{{ Auth::user()->name }}">
                            {{ stringCensor(ucwords(Auth::user()->name)) }}
                        </h5>
                        <img id="btnCensorUncensor" src="{{ asset('icon/hidden.png') }}" alt="Hide">
                    </div>
                    <h5 class="censor-uncensor" data-censored="{{ stringCensor($authWallet->address) }}"
                        data-uncensored="{{ $authWallet->address }}">
                        {{ stringCensor($authWallet->address) }}</h5>
                </div>
                <div class="">
                    <a href="{{ route('wallet-topup.create') }}"
                        class="float-end badge bg-primary text-decoration-none text-white fs-6 mt-1">+ TOP UP</a>
                    <p class="m-0 fs-5">Saldo</p>
                    <small class="align-top d-inline">Rp</small>
                    <p class="censor-uncensor d-inline align-baseline" id="modalTextWalletBalance"
                        data-censored="{{ stringCensor(toCurrency($authWallet->balance), true) }}"
                        data-uncensored="{{ toCurrency($authWallet->balance) }}">
                        {{ stringCensor(toCurrency($authWallet->balance), true) }}</p>

                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
