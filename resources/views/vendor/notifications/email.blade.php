<x-mail::message>
{{-- Logo --}}
<div style="text-align:center; margin-bottom: 24px;">
    <img src="https://voltransbucket.s3.ap-southeast-1.amazonaws.com/icons/voltrans-logo.png" alt="Voltrans Logo" style="height:200px; border-radius:12px;">
</div>

{{-- Greeting --}}
@if (! empty($greeting))
# <span style="color:#059669;">{{ $greeting }}</span>
@else
@if ($level === 'error')
# <span style="color:#dc2626;">@lang('Whoops!')</span>
@else
# <span style="color:#059669;">@lang('Halo!')</span>
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
<span style="color:#334155; font-size:16px; display:block; margin-bottom:8px;">{{ $line }}</span>
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success' => 'emerald',
        'error' => 'red',
        default => 'emerald',
    };
?>
<x-mail::button :url="$actionUrl" color="{{ $color }}" style="background-color:#059669 border-radius: 8px; font-weight:600; font-size:16px; padding:14px 32px;">
    {{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
<span style="color:#334155; font-size:16px; display:block; margin-bottom:8px;">{{ $line }}</span>
@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Salam Hormat,')<br>
    <span style="color:#059669; font-weight:bold;">Voltrans Rent Company</span>
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
    <span style="color:#64748b;">
@lang(
    "Jika anda mengalami masalah pada tombol \" :actionText \" , salin dan tempel URL dibawah\n".
    'pada browser anda:',
    [
        'actionText' => $actionText,
    ]
)
</span>
<br>
<span class="break-all" style="color:#0ea5e9;">{{ $displayableActionUrl }}</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
