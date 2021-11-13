<x-mail-layout>

    @if (!empty($greeting))
        <h1 class="text-center">{{ $greeting }}</h1>
    @else
        @if ($level === 'error')
            <h1 class="text-center">@lang('Whoops!')</h1>
        @else
            <h1 class="text-center">@lang('Hello!')</h1>
        @endif
    @endif

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        {{ $line }}

    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
        <?php
        switch ($level) {
            case 'success':
                $color = $level;
            case 'error':
                $color = 'danger';
                break;
            default:
                $color = 'primary';
        }
        ?>
        @component('mail::button', ['url' => $actionUrl, 'color' => $color])
            {{ $actionText }}
        @endcomponent
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        {{ $line }}

    @endforeach

    {{-- Salutation --}}
    @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('Salam'),<br>
        {{ config('app.name') }}
    @endif

    {{-- Subcopy --}}
    @isset($actionText)
        @slot('subcopy')
            @lang(
            "Jika tombol bermasalah \":actionText\" , salin URL di bawah dan\n".
            'buka di web browser mu:',
            [
            'actionText' => $actionText,
            ]
            ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        @endslot
    @endisset
</x-mail-layout>
