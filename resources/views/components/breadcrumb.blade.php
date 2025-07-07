@props(['breadcrumbs' => []])

<nav {{ $attributes->merge(['class' => 'max-w-7xl py-4']) }} aria-label="Breadcrumb">
    <ol class="flex items-center space-x-1 sm:space-x-2 text-xs sm:text-sm md:text-base text-gray-700">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="flex items-center">
                @if (!$loop->first)
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                        <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                @endif
                @if ($loop->first)
                    @if ($loop->last)
                        <span class="font-medium text-gray-900 flex items-center" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            {{ $breadcrumb['label'] }}
                        </span>
                    @else
                        <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-teal-600 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            {{ $breadcrumb['label'] }}
                        </a>
                    @endif
                @else
                    @if ($loop->last)
                        <span class="font-medium text-gray-900" aria-current="page">{{ $breadcrumb['label'] }}</span>
                    @else
                        <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-teal-600">{{ $breadcrumb['label'] }}</a>
                    @endif
                @endif
            </li>
        @endforeach
    </ol>
</nav>
