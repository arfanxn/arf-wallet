<x-app-layout title="Login" :navbar-top="false" :navbar-bottom="false">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
    </x-slot>

    <x-brand-header />

    <main class="bg-primary w-100  pt-5" style="height: 100vh">
        <div class="text-center">
            <p class="text-white ">Masukan <span class="fw-bold">Email</span> Kamu untuk lanjut</p>
            <form method="POST" class="mt-4 text-center position-relative w-100"
                action="{{ route('login.handleEmail') }}" id="form-email"> @csrf
                <div class="input-group px-5">
                    <span class="input-group-text bg-white py-0 px-1">
                        {{-- <img class="" src="{{ asset('icon/indonesia-flag.png') }}"> --}}
                        <small class="my-auto d-inline fw-bold text-dark px-1">Email</small>
                    </span>
                    <input name="email" value="{{ $email ?? old('email') }}" type="text"
                        class="form-control bg-white text-dark @error('email') is-invalid @enderror"
                        placeholder="email_kamu@example.com">
                </div>
                <x-auth.input-error-alert error="email" />
            </form>



            <p class="text-white text-center mx-auto px-4 text-break mt-4" style="width: 90%">
                Dengan melanjutkan, kamu setuju dengan <span class="fw-bold">Syarat & Ketentuan</span> dan
                <span class="fw-bold">Kebijakan Privasi</span> kami
            </p>

            <a onclick="submitForm()"
                class="cursor-pointer text-decoration-none  font-monospace cursor-pointer text-white fw-bold  m-5">LANJUT
                ></a>
        </div>
    </main>

</x-app-layout>
