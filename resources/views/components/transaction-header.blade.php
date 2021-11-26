@props(['route' => '/'])

<header
    {{ $attributes->merge(['class' => 'bg-primary fixed-top  offset-md-4 col-12 col-md-4 text-white  py-1 px-2']) }}>
    <h5 class="mt-1">
        <a href="{{ $route }}" class="me-2 text-decoration-none text-white ">&#10094;</a>
        {{ $slot }}
    </h5>
</header>
