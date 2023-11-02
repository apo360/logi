@props(['disabled' => false])

<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text">kz</span>
    </div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
</div>