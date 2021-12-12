<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <x-mail-styles />
    <style>
        * {
            font-family: sans-serif !important;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background: #3490dc !important;
        }

        .text-primary {
            color: #3490dc !important;
        }

    </style>

    {!! $styles ?? '' !!}

</head>

<body class="overflow-hidden text-center">

    <header class="py-2 w-100  bg-primary">
        <a class="text-decoration-none text-dark fs-4 badge px-sm-3 px-md-5" href="{{ route('home') }}"
            style="background-color: white ;">
            <x-icon.wallet /><span class="align-middle">{{ config('app.name') }}</span>
        </a>
    </header>

    <main class="text-center w-100 mt-3 px-md-5 px-3 pt-2 text-break ">
        {{ $slot }}

        <br><br><br>
        <p class="">Salam, <span class="fw-bold">{{ config('app.name') }}</span></p>
    </main>

    {!! $scripts ?? '' !!}
</body>

</html>
