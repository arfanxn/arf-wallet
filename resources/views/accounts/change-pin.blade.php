<x-app-layout title="Ganti PIN" :navbar-top="false" :navbar-bottom="false">

    <x-navbar-withBackBtn route="{{ route('account.settings.index') }}">
        Ganti PIN
    </x-navbar-withBackBtn>

    <main id="main" class="mt-5 pt-3">

        <div class="px-4 px-md-5 ">
            <div class="input-group">
                <label class="d-block w-100 text-center mb-3 fw-bold" for="inputChangePIN">Masukan PIN baru </label>
                <span class="input-group-text rounded-start" id="inputGroup-sizing-default">PIN</span>
                <input type="password" class="form-control" name="change_pin_number" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" id="inputChangePIN">
            </div>
            <div id="inputErrorChangePinNumberWrapper"></div>

            <div class="input-group mt-3">
                <span class="input-group-text rounded-start" id="inputGroup-sizing-default">Konfirmasi</span>
                <input type="password" class="form-control" name="change_pin_number_confirmation"
                    aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div id="inputErrorChangePinNumberConfWrapper"></div>

        </div>
        <div class="d-flex justify-content-center mx-5 mt-4">
            <a id="btnSaveChangePIN"
                class="cursor-pointer text-decoration-none font-monospace cursor-pointer text-white fw-bold  btn btn-primary">
                SIMPAN</a>
        </div>
    </main>

    <x-modal.pin-confirmation></x-modal.pin-confirmation>


    <x-slot name="scripts">
        <script src="{{ asset('js/Modals/PinConfirmationModal.js') }}"></script>
        <script src="{{ asset('js/Accounts/ChangePIN.js') }}"></script>
    </x-slot>
</x-app-layout>
