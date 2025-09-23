
<x-datatable :list="$proveedores">
    @if(count($proveedores))
    <div class="table-responsive">
        <x-table-headers class="py-2" :sortby="$sort" :order="$direction" :headers="$headers">
            @foreach ($proveedores as $proveedor)
            
            <tr>
                <x-td width="20%" class="text-center">
                    {{ $proveedor?->nombre }}
                </x-td>
                <x-td width="20%"  class="text-center">
                    {{ $proveedor?->email }}
                </x-td>
                <x-td width="20%"  class="text-center">
                    {{ $proveedor?->telefono }}
                </x-td>
                <x-td width="20%"  class="text-center">
                    {{ $proveedor?->direccion }}
                </x-td>
                {{-- <x-td width="30%" class=" text-{{ $proveedor->estado->color() }}" class="text-center">
                    {{ $proveedor?->estado == 'AC' ? 'ACTIVO' : 'INACTIVO'}}
                </x-td> --}}
                <x-td width="20%"  class="text-center">
                    <a href="{{ route('proveedores.edit', $proveedor) }}" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Editar">
                        <span class="fas fa-edit" aria-hidden="true"></span>
                    </a>
                </x-td>
            </tr>
            @endforeach
        </x-table-headers>
    </div>
    @else
        <div class="px-6 py-2">
                <span>No se encontraron registros.</span>
        </div>
    @endif

</x-datatable>
