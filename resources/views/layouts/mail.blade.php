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

        p,
        ul,
        ol,
        blockquote {
            line-height: 1.4;
        }

        h1 {
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
            margin-top: 0;
        }

        h3 {
            font-size: 14px;
            font-weight: bold;
            margin-top: 0;
        }

        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
        }

    </style>

    {!! $styles ?? '' !!}
    {{-- <title>{{ $title . ' | ' . config('app.name', 'Laravel') }}</title> --}}
    <title>HTML TITLE</title>

</head>

<body class="overflow-hidden text-center ">

    <header class="py-2 w-100  bg-primary">
        <a class="text-decoration-none text-dark fs-4 badge px-sm-3 px-md-5" href="{{ route('home') }}"
            style="background-color: white ;">
            <x-icon.wallet /><span class="align-middle">{{ config('app.name') }}</span>
        </a>
    </header>

    <main class="text-center w-100 mt-3">
        {{ $slot }}
    </main>

    {!! $scripts ?? '' !!}
</body>

</html>
