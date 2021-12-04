@props([
    'withBrand' => false,
    'brandClass' => '',
])

<div {{ $attributes->merge(['class' => 'p-1 d-inline ']) }}>
    <img class="" src="{{ asset('icon/wallet.png') }}" alt="">
    @if ($withBrand)
        <h5 class="ms-1 fw-bold d-inline align-middle {{ $brandClass }}">{{ config('app.name') }}</h5>
    @endif
</div>
