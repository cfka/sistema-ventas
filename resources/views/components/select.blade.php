@props([
    'id' => null,
    'name' => null,
    'readonly' => false
])

<select     
    @if($id) id="{{ $id }}" @endif
    @if($name) name="{{ $name }}" @endif
    {{ $attributes->merge(['class' => 'form-control']) }}
    {{ $readonly ? 'readonly' : '' }}
>
    {{ $slot }}
</select>
