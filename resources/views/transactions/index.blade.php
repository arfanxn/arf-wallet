<x-app-layout title="Riwayat Transaksi" :navbar-top="false" :navbar-bottom="false">

    <header class="bg-primary fixed-top  offset-md-4 col-12 col-md-4 text-white py-1 px-2">
        <h5 class="mt-1">
            <a href="{{ route('home') }}" class="me-2 text-decoration-none text-white ">&#10094;</a> Riwayat Transaksi
        </h5>
    </header>

    <main class="bg-light mt-3 pt-3">

    </main>

    <footer
        class="bg-white fixed-bottom  offset-md-4 col-12 col-md-4 text-center py-1 px-2 d-flex justify-content-around">
        <div>
            <h6 class="align-middle">
                <x-icon.sorting-order /> Urutkan
            </h6>
        </div>
        <div>
            <h6 class="align-middle">
                <x-icon.filter /> Filter
            </h6>
        </div>

    </footer>


</x-app-layout>
