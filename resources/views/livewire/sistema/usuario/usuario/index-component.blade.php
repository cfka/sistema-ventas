
<x-datatable :list="$usuarios">
    @if(count($usuarios))
    <div class="table-responsive">
        <x-table-headers class="py-2" :sortby="$sort" :order="$direction" :headers="$headers">
            @foreach ($usuarios as $usuario)
            
            <tr>
                <x-td width="20%" class="text-center">
                    {{ $usuario?->name }}
                </x-td>
                <x-td width="20%"  class="text-center">
                    {{ $usuario?->email }}
                </x-td>
                {{-- <x-td width="30%" class=" text-{{ $usuarios->estado->color() }}" class="text-center">
                    {{ $usuarios?->estado == 'AC' ? 'ACTIVO' : 'INACTIVO'}}
                </x-td> --}}
                <x-td width="20%"  class="text-center">
                    <a href="{{ route('usuarios.edit', $usuario) }}" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Editar">
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
