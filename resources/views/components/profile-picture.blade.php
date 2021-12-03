@props(['src' => asset('accounts/profile_picture/arfan.jpg'), 'width' => 55, 'height' => 55])

<img {{ $attributes->merge(['class' => ' rounded-circle border border-white border-2']) }} src="{{ $src }}"
    width="{{ $width }}" height="{{ $height }}">
