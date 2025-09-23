<select id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} @readonly($readonly)>
    {{ $slot }}
</select>
