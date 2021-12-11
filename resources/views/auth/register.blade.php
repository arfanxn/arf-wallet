<x-app-layout title="Register" :navbar-top="false" :navbar-bottom="false">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
    </x-slot>

    <x-brand-header />

    <main class="bg-primary w-100 pt-5" style="height: 100vh">

        <div class="text-center">
            <p class="text-white "><span class="fw-bold">Email</span> Kamu belum terdaftar,
                <br>Silahkan <span class="fw-bold">Daftar</span> untuk lanjut.
            </p>
            <form method="POST" class="mt-4 text-center position-relative w-100 "
                action="{{ route('register.handleCreate') }}" id="form-email"> @csrf
                <div class="input-group px-5">
                    <span class="input-group-text  ">
                        Email
                    </span>
                    <input name="email" readonly="readonly" value="{{ $email ?? old('email') }}" type="text"
                        class="form-control  text-dark @error('email') is-invalid @enderror"
                        placeholder="email_kamu@example.com">
                </div>
                <x-auth.input-error-alert error="email" />


                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white py-0 px-1">
                        <img class="" src="{{ asset('icon/indonesia-flag.png') }}">
                        <small class="my-auto d-inline fw-bold text-dark px-1">+62</small>
                    </span>
                    <input name="phone_number" type="text" value="{{ old('phone_number') }}"
                        class="form-control bg-white text-dark @error('phone_number') is-invalid @enderror"
                        placeholder="Nomor HP">
                </div>
                <x-auth.input-error-alert error="phone_number" />


                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white ">
                        Nama
                    </span>
                    <input name="fullname" type="text" value="{{ old('fullname') }}" autofocus
                        class="form-control bg-white text-dark @error('fullname') is-invalid @enderror"
                        placeholder="Muhammad Arfan">
                </div>
                <x-auth.input-error-alert error="fullname" />


                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white ">
                        PIN
                    </span>
                    <input name="pin_number" value="{{ old('pin_number') }}" type="password" autocomplete="off"
                        class="form-control bg-white text-dark @error('pin_number') is-invalid @enderror"
                        placeholder="123456">
                </div>
                <x-auth.input-error-alert error="pin_number" />


            </form>
            <p class="text-white text-center mx-auto px-5 text-break mt-5">
                Dengan melanjutkan, kamu setuju dengan <span class=" fw-bold">Syarat & Ketentuan</span> dan
                <span class="fw-bold">Kebijakan Privasi</span> kami
            </p>

            <a onclick="submitForm()"
                class="cursor-pointer text-decoration-none  font-monospace cursor-pointer text-white fw-bold  m-5">LANJUT
                ></a>
        </div>
    </main>

</x-app-layout>
