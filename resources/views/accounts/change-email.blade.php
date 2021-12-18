<x-app-layout title="Ubah Email" :navbar-top="false" :navbar-bottom="false">

    <x-navbar-withBackBtn route="{{ route('account.settings.index') }}">
        Ubah Email
    </x-navbar-withBackBtn>

    <main id="main" class="mt-5 pt-3">

        <div class="px-4 px-md-5 ">
            <div class="input-group">
                <label class="d-block w-100 text-center mb-3 fw-bold" for="inputChangePIN">Masukan Email baru </label>
                <span class="input-group-text rounded-start" id="inputGroup-sizing-default">Email</span>
                <input type="text" class="form-control" name="email" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="Email kamu">
            </div>
            <div id="inputErrorEmailWrapper"></div>

            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Kode Verifikasi ubah email"
                    name="verification_code" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button id="btnSendVerificationCode" class="btn btn-outline-primary" type="button"
                    id="button-addon2">Kirim Kode</button>
            </div>
            <div id="inputErrorVerificationCodeWrapper"></div>

        </div>
        <div class="d-flex justify-content-center mx-5 mt-4">
            <a id="btnSaveChangeEmail"
                class="cursor-pointer text-decoration-none font-monospace cursor-pointer text-white fw-bold  btn btn-primary">
                SIMPAN</a>
        </div>
    </main>

    <x-modal.pin-confirmation></x-modal.pin-confirmation>


    <x-slot name="scripts">
        <script src="{{ asset('js/Modals/PinConfirmationModal.js') }}"></script>
        <script src="{{ asset('js/Accounts/ChangeEmail.js') }}"></script>
    </x-slot>
</x-app-layout>
