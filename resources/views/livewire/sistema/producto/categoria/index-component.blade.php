
<x-datatable :list="$categorias">
    @if(count($categorias))
    <div class="table-responsive">
        <x-table-headers class="py-2" :sortby="$sort" :order="$direction" :headers="$headers">
            @foreach ($categorias as $categoria)
            
            <tr>
                <x-td width="20%" class="text-center">
                    {{ $categoria?->nombre }}
                </x-td>
                <x-td width="30%"  class="text-center">
                    {{ $categoria?->descripcion }}
                </x-td>
                {{-- <x-td width="30%" class=" text-{{ $categoria->estado->color() }}" class="text-center">">
                    {{ $categoria?->estado == 'AC' ? 'ACTIVO' : 'INACTIVO'}}
                </x-td> --}}
                <x-td width="20%"  class="text-center">
                    <a href="{{ route('categorias.edit', $categoria) }}" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Editar">
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
