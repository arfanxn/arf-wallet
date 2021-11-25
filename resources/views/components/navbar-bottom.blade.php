<nav class="fixed-bottom bg-light offset-md-4 col-12 col-md-4 border-top border-dark pt-1  ">
    <div class="row text-center">
        <div class="col-4 ">
            <a href="{{ route('transaction.history') }}" class="text-decoration-none text-dark ">
                <x-icon.history></x-icon.history><br>Riwayat
            </a>
        </div>
        <div class="col-4 ">
            <a href="{{ route('home') }}" class="text-decoration-none text-dark ">
                <x-icon.home></x-icon.home><br>Beranda
            </a>
        </div>
        <div class="col-4 ">
            <a href="{{ route('account.index') }}" class="text-decoration-none text-dark ">
                <x-icon.user-profile></x-icon.user-profile><br>Profil
            </a>
        </div>
    </div>
</nav>
