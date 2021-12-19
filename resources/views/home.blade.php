<x-app-layout title="Beranda">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('home/css/home.css') }}">
    </x-slot>

    <div
        class="d-flex pt-3 px-2 mx-auto justify-content-around transaction-wrapper text-center border border-dark rounded-bottom bg-light">
        <div class="">
            <a class="text-decoration-none text-dark" href="{{ route('wallet-topup.create') }}">
                <x-icon.top-up></x-icon.top-up>
                <p>Isi Saldo</p>
            </a>
        </div>
        <div class="">
            <a class="text-decoration-none text-dark" href="{{ route('transaction.send-money') }}">
                <x-icon.send-money></x-icon.send-money>
                <p>Kirim</p>
            </a>
        </div>
        <div class="">
            <a class="text-decoration-none text-dark" href="">
                <x-icon.receive-money></x-icon.receive-money>
                <p>Minta</p>
            </a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center mx-auto mt-3" role="alert"
            style="width: 85%">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-center mt-3 ">
        <h4 class="badge bg-primary fs-4 py-3" style="width: 85%">
            <x-icon.wallet /> ARF-WALLET
        </h4>
    </div>


    <div id="carouselExampleInterval" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://source.unsplash.com/400x200/?advertising" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.Explicabo, perferendis.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="1500">
                <img src="https://source.unsplash.com/400x200/?transaction" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                        iste officia eaque consequuntur.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="1500">
                <img src="https://source.unsplash.com/400x200/?money" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="1500">
                <img src="https://source.unsplash.com/400x200/?crypto-currency" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla
                        aliquam dignissimos quasi molestias est quaerat dolorem quibusdam accusantium voluptate culpa!
                    </p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="1500">
                <img src="https://source.unsplash.com/400x200/?economy" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Labore, ut itaque! Rerum eveniet sequi optio!</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="1500">
                <img src="https://source.unsplash.com/400x200/?business" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block ">
                    <p class="text-shadow fw-bold fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Voluptatum incidunt ex, maxime aut atque expedita quasi fugit.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="d-flex justify-content-center mt-5 pt-5">
        <p class="text-white badge bg-dark p-5 fs-5">ON BUILD - COMING SOON</p>
    </div>

    <div class="m-5 p-5 w-100" style="height: 500px"></div>

    <x-slot name="scripts">
        <script src="{{ asset('js/Wallets/AuthWallet.js') }}"></script>
    </x-slot>
</x-app-layout>
