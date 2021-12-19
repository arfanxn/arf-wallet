{{-- <x-app-layout title="Verifikasi Email" :navbar-top="false" :navbar-bottom="false">
    <main class=""></main>
</x-app-layout> --}}


<x-app-layout title="Verifikasi Email" :navbar-top="false" :navbar-bottom="false">

    <x-navbar-withBackBtn route="{{ route('account.logout') }}">
        Verifikasi Email atau Logout
    </x-navbar-withBackBtn>

    <main id="main" class="mt-5 pt-3">
        <form method="POST" action="{{ route('email-verification.verify') }}">
            @csrf
            <div class="px-4 px-md-5 ">
                <div class="input-group">
                    <label class="d-block w-100 text-center mb-3 fw-bold" for="inputChangePIN">Masukan Kode Verifikasi
                        Email kamu</label>
                    <input name="auth-user-email" type="hidden" class="d-none"
                        value="{{ Auth::user()->email }}">
                    <input type="text" class="form-control rounded-start" placeholder="Kode Verifikasi Email"
                        name="verification_code" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button id="btnSendVerificationCode" class="btn btn-outline-primary" type="button"
                        id="button-addon2">Kirim Kode</button>
                </div>
                <div id="inputErrorVerificationCodeWrapper">
                    @error('verification_code')
                        <div class="alert alert-warning  alert-dismissible fade show py-0 mt-2">
                            <span>{{ $message }}</span>
                            <button type="button" class="btn-close p-1" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                </div>


            </div>
            <div class="d-flex justify-content-end mx-5 mt-4">
                <button type="submit"
                    class="cursor-pointer text-decoration-none font-monospace cursor-pointer text-white fw-bold  btn btn-primary">
                    Lanjut</button>
            </div>
        </form>
    </main>

    <x-slot name="scripts">
        <script src="{{ asset('js/Accounts/SendVerificationCodeByEmail.js') }}"></script>
    </x-slot>

</x-app-layout>
