<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => '
        inline-flex 
        items-center 
        px-4 py-2 
        bg-green-500 
        border 
        border-transparent 
        rounded-md 
        font-semibold 
        text-xs 
        text-gray-900 
        uppercase 
        tracking-widest 
        hover:bg-green-400
        focus:bg-green-500 
        active:bg-green-400 
        focus:outline-none 
        focus:ring-2 
        focus:ring-green-500 
        focus:ring-offset-2 
        transition-colors 
        ease-in-out 
        duration-200'
    ]) }}>
    {{ $slot }}
</button>
