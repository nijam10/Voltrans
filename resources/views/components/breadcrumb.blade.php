@props(['breadcrumbs' => []])

<nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
    <ol role="list" class="flex items-center space-x-2 text-sm text-gray-700">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="flex items-center">
                @if (!$loop->first)
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300 mx-2">
                        <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                @endif
                @if ($loop->last)
                    <span class="text-gray-500" aria-current="page">{{ $breadcrumb['label'] }}</span>
                @else
                    <a href="{{ $breadcrumb['url'] }}" class="font-medium text-gray-900 hover:text-teal-300">{{ $breadcrumb['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
