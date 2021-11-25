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
                    <h5>Muhammad Arfan</h5>
                    <h5>0888 XXXX XXXX</h5>
                </div>
                <div class="">
                    <a href="" class="float-end badge bg-primary text-decoration-none text-white fs-6 mt-1">+ TOP UP</a>
                    <p class="m-0 fs-5">Saldo</p>
                    <small class="align-top d-inline">Rp</small>
                    <p class="d-inline align-baseline">{{ toCurrency($authWallet->balance) }}</p>

                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
