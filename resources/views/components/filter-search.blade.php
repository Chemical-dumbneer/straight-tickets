@props([
    'label' => null,
    'placeholder' => '',
])

<div class="flex flex-col">
    @if($label)
        <label class="text-xs text-gray-300 mb-1">{{ $label }}</label>
    @endif

    <input
        type="text"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'bg-gray-800 text-white rounded px-3 py-1 border border-gray-700 w-64 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent',
        ]) }}
    >
</div>
