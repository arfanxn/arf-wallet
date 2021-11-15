<x-mail-layout>
    <p>Kode verifikasi Email kamu adalah</p>
    <h4 class="fw-bold mb-3">{{ $verificationCode }}</h4>
    <p class="">Atau verifikasi dengan :</p>
    <a href="{{ $signedUrl }}" class="btn btn-primary ">Verifikasi</a>
    <p class="mt-5">Jika tombol tidak bisa, salin url di bawah dan buka di browser</p>
    <p class="text-primary text-break text-decoration-underline">{{ $signedUrl }}</p>
    <p>Salam, {{ config('app.name') }}</p>
</x-mail-layout>
