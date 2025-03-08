<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        inline-flex items-center justify-center
        px-6 py-3
        text-base font-medium
        text-white
        bg-amber-600
        border border-transparent
        rounded-lg
        shadow-sm
        transform transition duration-200
        hover:bg-amber-700
        hover:shadow-md
        hover:-translate-y-0.5
        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500
        active:bg-amber-800 active:translate-y-0
        disabled:opacity-50 disabled:cursor-not-allowed
    '
]) }}>
    {{ $slot }}
</button>
