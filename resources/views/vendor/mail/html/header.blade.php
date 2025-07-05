@props(['url'])
<tr>
    <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
    @if (trim($slot) === 'Voltrans')
    <img src="https://voltransbucket.s3.ap-southeast-1.amazonaws.com/icons/voltrans-logo.png" class="logo" alt="Voltrans Logo">
    <p style="color:#64748b;">Voltrans Rental App</p>
    @else
    {{ $slot }}
    @endif
    </a>
    </td>
</tr>
