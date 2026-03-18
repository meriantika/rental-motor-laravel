@if ($paginator->hasPages())

<div class="mt-12 flex justify-center">

<nav class="flex items-center gap-2 text-sm font-semibold">

{{-- Previous --}}
@if ($paginator->onFirstPage())

<span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl">
Previous
</span>

@else

<a href="{{ $paginator->previousPageUrl() }}"
class="px-4 py-2 bg-white border rounded-xl hover:bg-blue-50 hover:border-blue-300 transition">
Previous
</a>

@endif


{{-- Page Numbers --}}
@foreach ($elements as $element)

@if (is_string($element))

<span class="px-3 py-2 text-gray-400">
{{ $element }}
</span>

@endif


@if (is_array($element))

@foreach ($element as $page => $url)

@if ($page == $paginator->currentPage())

<span class="px-4 py-2 text-white bg-blue-600 rounded-xl shadow">
{{ $page }}
</span>

@else

<a href="{{ $url }}"
class="px-4 py-2 bg-white border rounded-xl hover:bg-blue-50 hover:border-blue-300 transition">
{{ $page }}
</a>

@endif

@endforeach

@endif

@endforeach


{{-- Next --}}
@if ($paginator->hasMorePages())

<a href="{{ $paginator->nextPageUrl() }}"
class="px-4 py-2 bg-white border rounded-xl hover:bg-blue-50 hover:border-blue-300 transition">
Next
</a>

@else

<span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl">
Next
</span>

@endif

</nav>

</div>

@endif