
<x-datatable :list="$productos">
    @if(count($productos))
    <div class="table-responsive">
        <x-table-headers class="py-2" :sortby="$sort" :order="$direction" :headers="$headers">
            @foreach ($productos as $producto)
            
            <tr>
                <x-td width="10%" class="text-center">
                    {{ $producto?->imagen_dir }}
                </x-td>
                <x-td width="20%" class="text-center">
                    {{ $producto?->nombre }}
                </x-td>
                <x-td width="20%"  class="text-center">
                    {{ $producto?->descripcion }}
                </x-td>
                <x-td width="10%"  class="text-center">
                    {{ $producto?->categoria?->nombre }}
                </x-td>
                <x-td width="10%"  class="text-center">
                    {{ $producto?->proveedor?->nombre }}
                </x-td>
                <x-td width="20%" class="text-center">
                    <div><small>Proveedor: ${{ number_format($producto->precio_proveedor, 2) }}</small></div>
                    <div><small>Envío: ${{ number_format($producto->precio_envio, 2) }}</small></div>
                    <div><strong>Total: ${{ number_format($producto->precio_costo, 2) }}</strong></div>
                </x-td>

                {{-- <x-td width="30%" class=" text-{{ $producto->estado->color() }}" class="text-center">
                    {{ $producto?->estado == 'AC' ? 'ACTIVO' : 'INACTIVO'}}
                </x-td> --}}
                <x-td width="10%"  class="text-center">
                    <a href="{{ route('productos.edit', $producto) }}" type="button" class="btn btn-primary btn-sm" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Editar">
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
