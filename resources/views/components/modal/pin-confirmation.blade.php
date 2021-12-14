<div id="modalPinConfirmation" class="d-none">
    <x-modal._modal-background>

        <div class="mt-auto col-md-4 col-12 bg-white">

            <x-brand-header />

            <main class="bg-primary pt-5 px-0" style="height: 75vh">

                <div class="text-center">
                    <p class="text-white mb-4">Konfirmasi <span class="fw-bold">Nomor PIN</span> kamu untuk lanjut
                    </p>
                    <div class="mt-4 text-center position-relative w-100">
                        <div class="input-group px-5">
                            <span class="input-group-text bg-white py-0">PIN
                            </span>
                            <input name="pin_number" type="password" class="form-control bg-white text-dark"
                                placeholder="123456">
                        </div>

                        <div id="inputErrorPinNumberWrapper" class="px-5 d-block">

                        </div>

                    </div>

                    <p class="text-white text-center mx-auto px-4 text-break mt-4" style="width: 90%">
                        Pastikan bahwa ini adalah <span class="fw-bold">Anda</span>, kami
                        <span class="fw-bold"> Tidak Bertanggung Jawab </span>atas
                        <span class="fw-bold"> Kelalaian Anda.</span>
                    </p>

                    <div class="d-flex justify-content-between">
                        <a id="btnCloseModalPinConfirmation"
                            class="cursor-pointer text-decoration-none  font-monospace cursor-pointer text-white fw-bold m-5">
                            < KEMBALI</a>
                                <a id="btnNextModalPinConfirmation"
                                    class="cursor-pointer text-decoration-none  font-monospace cursor-pointer text-white fw-bold  m-5">
                                    LANJUT ></a>
                    </div>
                </div>
            </main>
        </div>
    </x-modal._modal-background>

</div>
