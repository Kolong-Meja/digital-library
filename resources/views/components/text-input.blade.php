@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => '
        text-gray-100
        bg-gray-900
        border-gray-700 
        focus:border-green-500 
        focus:ring-green-500 
        rounded-md 
        shadow-sm
        '
    ]) !!}>
