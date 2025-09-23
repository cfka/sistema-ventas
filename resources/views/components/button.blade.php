@if ($attributes->get('href'))
    <a href="{{ $attributes->get('href') }}" {{ $attributes->merge(['class' => 'btn btn-sm text-bold']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type ?? 'submit' }}" {{ $attributes->merge(['class' => 'btn btn-sm text-bold']) }}>
        {{ $slot }}
    </button>
@endif