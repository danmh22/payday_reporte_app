@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-emerald-700 focus:ring-emerald-500 rounded-md shadow-sm !bg-white']) !!}>
