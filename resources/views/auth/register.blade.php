<x-app-layout title="Login" :navbar-top="false" :navbar-bottom="false">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('auth/css/login.css') }}">
    </x-slot>

    <main class="bg-primary  w-100 " style="height: 100vh">
        <div class="text-center mx-auto bg-white p-2 w-100 ">
            <x-icon.wallet />
            <h4 class="fs-4 d-inline align-middle fw-bold text-dark">ARF-WALLET</h4>
        </div>

        <div class="text-center mt-5">
            <p class="text-white ">Nomor <span class="fw-bold">HP</span> Kamu belum terdaftar,
                <br>Silahkan <span class="fw-bold">Daftar</span> untuk lanjut.
            </p>
            <form method="POST" class="mt-4 text-center position-relative w-100 "
                action="{{ route('register.handleCreate') }}" id="form-phone-number"> @csrf
                <div class="input-group px-5">
                    <span class="input-group-text bg-white py-0 px-1">
                        <img class="" src="{{ asset('icon/indonesia-flag.png') }}">
                        <small class="my-auto d-inline fw-bold text-dark px-1">+62</small>
                    </span>
                    <input name="phone_number" readonly="readonly" value="{{ $phone_number ?? old('phone_number') }}"
                        type="text" class="form-control bg-white text-dark @error('phone_number') is-invalid @enderror"
                        placeholder="Nomor HP">
                </div>
                @error('phone_number')
                    <p class="text-danger my-0  fw-bold badge bg-white">{{ $message }}</p>
                @enderror
                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white ">
                        Nama
                    </span>
                    <input name="fullname" type="text" value="{{ old('fullname') }}" autofocus
                        class="form-control bg-white text-dark @error('phone_number') is-invalid @enderror"
                        placeholder="Muhammad Arfan">
                </div>
                @error('fullname')
                    <p class="text-danger my-0  fw-bold badge bg-white">{{ $message }}</p>
                @enderror
                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white ">
                        Email
                    </span>
                    <input name="email" type="text" value="{{ old('email') }}"
                        class="form-control bg-white text-dark @error('phone_number') is-invalid @enderror"
                        placeholder="email@example.com">
                </div>
                @error('email')
                    <p class="text-danger my-0  fw-bold badge bg-white">{{ $message }}</p>
                @enderror
                <div class="input-group mt-3 px-5">
                    <span class="input-group-text bg-white ">
                        PIN
                    </span>
                    <input name="pin_number" value="{{ old('pin_number') }}" type="password" autocomplete="off"
                        class="form-control bg-white text-dark @error('phone_number') is-invalid @enderror"
                        placeholder="123456">
                </div>
                @error('pin_number')
                    <p class="text-danger my-0  fw-bold badge bg-white">{{ $message }}</p>
                @enderror
            </form>
            <p class="text-white text-center mx-auto px-5 text-break mt-5">
                Dengan melanjutkan, kamu setuju dengan <span class=" fw-bold">Syarat & Ketentuan</span> dan
                <span class="fw-bold">Kebijakan Privasi</span> kami
            </p>

            <a href="" id="btn-lanjut" onclick="event.preventDefault()"
                class=" text-decoration-none  font-monospace cursor-pointer text-white fw-bold  m-5">LANJUT
                ></a>
        </div>
    </main>

    <x-slot name="scripts">
        <script src="{{ asset('auth/js/auth.js') }}"></script>
    </x-slot>
</x-app-layout>
