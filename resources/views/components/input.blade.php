@props([
    'type' => null,
    'value' => null,
    'id' => null,
    'name' => null,
    'placeholder' => null,
    'readonly' => false
])

<input     
    @if($value) value="{{ $value }}" @endif
    @if($type) type="{{ $type }}" @endif
    {{ $attributes->merge(['class' => $type == 'submit' ? 'btn btn-primary btn-sm text-bold float-sm-right' : 'form-control']) }} 
    @if($name) name="{{ $name }}" @endif
    @if($id) id="{{ $id }}" @endif
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    {{ $readonly ? 'readonly' : '' }}
>
