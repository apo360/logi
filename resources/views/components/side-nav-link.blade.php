@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-3 px-4 rounded border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none border-indigo-700 transition duration-150 ease-in-out'
            : 'block py-3 px-4 rounded hover border-b-2 hover:border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>