<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    {!! $styles ?? '' !!}
    <title>{{ $title . ' | ' . config('app.name', 'Laravel') }}</title>

</head>

<body>

    <main class="row">
        <div class="offset-md-4 col-md-4 col-12" style="z-index: 5555">
            @if ($navbarTop == true)
                <x-navbar-top></x-navbar-top>
            @endif

            {{ $slot }}

            @if ($navbarBottom == true)
                <x-navbar-bottom></x-navbar-bottom>
            @endif
        </div>
    </main>

    {{-- pooperJs and jQuery --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>

    {!! $scripts ?? '' !!}
</body>

</html>
