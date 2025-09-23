<x-card>

    <x-slot name="header">
        <x-datatable-header :dataheader="$list" />
    </x-slot>

    <x-slot name="body">
        {{ $slot }}
    </x-slot>

    <x-slot name="footer">
        <x-datatable-footer :datafooter="$list" />
    </x-slot>

</x-card>
