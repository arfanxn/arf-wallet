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

<body class=" overflow-hidden" style="background-color: #000">

    <main class="row m-auto">
        <div class="offset-md-4 col-md-4 col-12 p-0 bg-light overflow-auto scrollbar-none"
            style="z-index: 5555; height : 1000px;">
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
    <script src="{{ asset('js/helpers.js') }}"></script>


    {!! $scripts ?? '' !!}
</body>

</html>
