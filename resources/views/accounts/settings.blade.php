<x-app-layout title="Pengaturan Akun" :navbar-top="false">

    <x-navbar-withBackBtn route="{{ route('account.index') }}">
        Pengaturan Akun
    </x-navbar-withBackBtn>

    <main class="my-4 py-3 ">
        <small class="d-flex rounded-0 px-2 pt-2 badge alert-secondary">Profil</small>

        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="">
                <span class="ms-1">Account Type</span>
            </div>
            <div class="align-middle pe-1">
                <span
                    class="text-decoration-underline fst-italic font-monospace  fw-bold ms-1">{{ auth()->user()->email_verified_at ? 'PREMIUM' : 'ORDINARY' }}</span>
            </div>
        </div>
        <div class="w-100 ps-1 pe-2 border-bottom border-secondary ">
            <div class="align-middle d-flex 
                    justify-content-between py-1 m-0">
                <div class="my-auto">
                    <span class="ms-1">Foto Profil</span>
                </div>
                <div id="profilePictureWrapper" class="align-middle pe-1 ">
                    <x-profile-picture src="{{ auth()->user()->profile_picture }}" width="50" height="50">
                    </x-profile-picture>
                    <form method="post" id="formProfilePicture" class="d-none"
                        action="{{ route('account.setting.change-profile-pict') }}" enctype="multipart/form-data">
                        @csrf @method("PUT")
                        <input name="profile_picture" class="form-control d-none" type="file">
                    </form>
                </div>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success rounded  alert-dismissible fade show py-0 mt-1 mb-2" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close  p-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @error('profile_picture')
                <div class="alert alert-danger rounded  alert-dismissible fade show py-0 mt-1 mb-2" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close  p-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror

        </div>
        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="my-auto">
                <span class="ms-1">Nama Lengkap</span>
            </div>
            <div class="align-middle pe-1">
                <span class="me-2">{{ ucwords(Auth::user()->name) }}</span>
                <a href="{{ route('account.setting.change-fullname.edit') }}" class="text-decoration-none text-dark">
                    &#10095;</a>
            </div>
        </div>

        <small class="d-flex rounded-0 px-2 pt-2 badge alert-secondary">Keamanan</small>
        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="my-auto">
                <span class="ms-1">Email</span>
            </div>
            <div class="align-middle pe-1">
                <span class="me-2">{{ Auth::user()->email }}</span>
                <a href="{{ route('account.setting.change-email.edit') }}" class="text-decoration-none text-dark">
                    &#10095;</a>
            </div>
        </div>
        <div
            class="w-100 py-2 ps-1 pe-2 border-bottom border-secondary align-middle d-flex 
        justify-content-between">
            <div class="my-auto">
                <span class="ms-1">Nomor PIN</span>
            </div>
            <div class="align-middle pe-1">
                <a href="{{ route('account.setting.change-pin') }}" class="text-decoration-none text-dark">
                    &#10095;</a>
            </div>
        </div>


    </main>

    <x-slot name="scripts">
        <script src="{{ asset('js/Accounts/ChangeProfilePicture.js') }}"></script>
    </x-slot>

</x-app-layout>
