@props([
    'type' => 'text',
    'name' => null,
    'id' => null,
    'value' => null,
])

<input
    value="{{ $value ?? '' }}"
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id }}"
    placeholder="{{ $attributes->get('placeholder') }}"
    {{ $attributes->get('readonly') ? 'readonly' : '' }}
    {{ $attributes->merge([
        'class' => $type === 'submit'
            ? 'btn btn-primary btn-sm text-bold float-sm-right'
            : 'form-control'
    ]) }}
>
