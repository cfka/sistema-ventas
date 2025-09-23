<label for="{{ $for }}" {{ $attributes->merge(['class' => 'font-weight-bold']) }}>
    {{ $value ?? $slot }}
</label>
