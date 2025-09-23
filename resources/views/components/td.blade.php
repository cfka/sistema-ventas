@props([
    'align' => 'center', // valor por defecto
])

@php
    $textAlignClass = $align;
@endphp

<td {{ $attributes->merge(['class' => $textAlignClass]) }}>
    {{ $slot }}
</td>