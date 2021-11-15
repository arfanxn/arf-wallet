<x-app-layout title="Email Verificaton" :navbar-top="false" :navbar-bottom="false">

    <x-header />
    <main class="bg-primary w-100 h-100 text-center pt-5 text-white ">
        <div class="mb-5">
            <h2>Selamat !</h2>
            <h4>Email anda telah terverifikasi.</h4>
        </div>
        <div class="d-flex justify-content-center px-4">
            {{-- <a onclick="window.close()" class="text-white fst-italic fs-5">Kembali</a> --}}
            <a href="{{ route('home') }}" class="text-white fst-italic fs-5">Lanjut ></a>
        </div>
    </main>

</x-app-layout>
