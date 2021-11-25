<x-app-layout title="Akun" :navbar-top="false">

    <header class="py-2  bg-primary text-center w-100 ">
        <h4 class="fs-4 text-white ">Akun Saya</h4>
    </header>

    <header class="d-flex justify-content-start bg-primary text-white pb-2 ">
        <div class="px-3">
            <img class=" rounded-circle border border-white border-2"
                src="{{ asset('accounts/profile_picture/arfan.jpg') }}" width="55" height="55">
        </div>
        <div class="">
            <h6 class="my-1 fw-bold">{{ strtoupper(auth()->user()->name) }}</h6>
            <small class="align-top">{{ auth()->user()->phone_number }}
                <span
                    class="text-decoration-underline fst-italic font-monospace  fw-bold ms-1">{{ auth()->user()->email_verified_at ? 'PREMIUM' : '' }}</span></small>
        </div>
    </header>

    <main>
        <div class="d-flex border-top border-bottom border-secondary py-1">
            <div class="w-50  border-end border-secondary d-flex ">
                <div class="ps-1 py-1">
                    <x-icon.up-arrow-green />
                </div>
                <div class="ms-2">
                    <small class="d-block">Penghasilan</small>
                    <span class="">Rp200000</span>
                </div>
            </div>
            <div class="w-50  border-end border-secondary d-flex ">
                <div class="ps-1 py-1">
                    <x-icon.down-arrow-orange />
                </div>
                <div class="ms-2">
                    <small class="d-block">Pengeluaran</small>
                    <span class="">Rp200000</span>
                </div>
            </div>
        </div>

        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="">
                <x-icon.wallet /> <span class="ms-1">Saldo</span>
            </div>
            <div class="align-middle pe-1">
                <span>{{ toIDR($wallet->balance) }}</span>
                <a href="" class="text-decoration-none text-dark">
                    &#10095;</a>
            </div>
        </div>
        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="">
                <span class="ms-1">Pengaturan</span>
            </div>
            <div class="align-middle pe-1">
                <a href="" class="text-decoration-none text-dark">
                    &#10095;</a>
            </div>
        </div>
        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="">
                <span class="ms-1">Versi Aplikasi</span>
            </div>
            <div class="align-middle pe-1">
                <span>2.13</span>
            </div>
        </div>
        <div class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex">
            <a href="" class="text-decoration-none text-dark ms-1">Keluar</a>
        </div>

    </main>



</x-app-layout>
