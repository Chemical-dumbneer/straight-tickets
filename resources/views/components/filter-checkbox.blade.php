@props(['label' => ''])

<label class="inline-flex items-center gap-2 text-xs text-gray-300">
    <input
        type="checkbox"
        {{ $attributes->merge([
            'class' => 'rounded bg-gray-900 border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent',
        ]) }}
    >
    <span>{{ $label }}</span>
</label>
