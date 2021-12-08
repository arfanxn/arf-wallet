@props(['id' => ''])

<div {{ $id ? 'id="' . $id . '"' : '' }}
    class="position-absolute top-0 start-50 translate-middle-x w-100 h-100 d-flex offset-md-4 offset-0"
    style="background-color: rgba(0,0,0,.5) ;  z-index: 99999;">
    {{ $slot }}
</div>
