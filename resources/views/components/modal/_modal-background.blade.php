@props(['id' => '', 'bgColor' => 'rgba(0,0,0,.5)'])

<div {{ $id ? 'id="' . $id . '"' : '' }}
    {{ $attributes->merge(['class' => 'position-absolute top-0 start-50 translate-middle-x w-100 h-100 d-flex offset-md-4 offset-0']) }}
    style="background-color: {{ $bgColor }} ;  z-index: 99999;">
    {{ $slot }}
</div>
