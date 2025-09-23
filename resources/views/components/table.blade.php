<table id="{{ $id }}" {{ $attributes->merge(['class' => 'table table-bordered table-striped table-hover text-nowrap ']) }}>
    {{ $slot }}
</table>
