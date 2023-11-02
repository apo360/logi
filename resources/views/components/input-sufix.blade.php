@props(['disabled' => false])

<div class="input-group">
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    <div class="input-group-append">
        <span class="input-group-text">kz</span>
    </div>
</div>