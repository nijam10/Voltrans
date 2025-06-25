<x-mail::message>
{{-- Logo --}}
<div style="text-align:center; margin-bottom: 24px;">
    <img src="{{ asset('images/voltrans-logo.png') }}" alt="Voltrans Logo" style="height:60px; border-radius:12px;">
</div>

{{-- Greeting --}}
@if (! empty($greeting))
# <span style="color:#059669;">{{ $greeting }}</span>
@else
@if ($level === 'error')
# <span style="color:#dc2626;">@lang('Whoops!')</span>
@else
# <span style="color:#059669;">@lang('Hello!')</span>
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
<x-mail::button :url="$actionUrl" color="{{ $color }}" style="border-radius: 8px; font-weight:600; font-size:16px; padding:14px 32px;">
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
@lang('Regards,')<br>
<span style="color:#059669; font-weight:bold;">{{ config('app.name') }}</span>
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
<span style="color:#64748b;">
@lang(
    "If you're having trouble clicking the \" :actionText \" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
)
</span>
<br>
<span class="break-all" style="color:#0ea5e9;">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
