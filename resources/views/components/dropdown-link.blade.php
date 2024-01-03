<a {{ $attributes->merge([
    'class' => '
    block 
    w-full 
    px-4 py-2 
    text-start 
    text-sm 
    leading-5 
    text-gray-100 
    hover:bg-gray-100 
    hover:text-gray-900
    focus:outline-none 
    focus:bg-gray-100 
    transition 
    duration-200 
    ease-in-out
    ']) }}
    >{{ $slot }}</a>
