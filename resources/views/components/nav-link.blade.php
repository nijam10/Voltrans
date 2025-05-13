@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-3 border-green-900 text-sm font-medium leading-5 text-gray-900 focus:outline-hidden focus:border-green-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-3 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-green-500 hover:border-gray-300 focus:outline-hidden focus:text-green-700 focus:border-green-900 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
