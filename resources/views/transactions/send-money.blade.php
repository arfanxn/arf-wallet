<x-app-layout title="Kirim Uang" :navbar-top="false" :navbar-bottom="false">
    <x-transaction-header class="h-25" route="{{ route('home') }}">Kirim Uang</x-transaction-header>

    <div class="position-absolute col-4 mt-5" style="z-index: 99999">
        <div class="bg-white mx-auto rounded px-2 py-2" style="width: 95%;">
            <h6 class="fw-bold">Kirim Cepat</h6>

        </div>
    </div>
</x-app-layout>
