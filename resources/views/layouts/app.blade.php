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
        <div class="offset-md-4 col-md-4 col-12">
            {{ $slot }}
        </div>
    </main>

    {{-- pooperJs and jQuery --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- pooperJs and jQuery --}}
    {!! $scripts ?? '' !!}
</body>

</html>
