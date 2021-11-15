<x-mail-layout>
    <p>Kode verifikasi kamu adalah</p>
    <h4 class="fw-bold mb-3">{{ $verificationCode }}</h4>
    <p class="mt-5">Salam, {{ config('app.name') }}</p>
</x-mail-layout>
