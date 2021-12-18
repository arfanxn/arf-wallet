<?php $defaultProfilePicture = asset('accounts/profile_pictures/default.jpg'); ?>

@dump($defaultProfilePicture)

@props(['src' => $defaultProfilePicture, 'width' => 55, 'height' => 55])
<img {{ $attributes->merge(['class' => ' rounded-circle border border-white border-2']) }}
    src="{{ $src ?? $defaultProfilePicture }}" width="{{ $width }}" height="{{ $height }}">
