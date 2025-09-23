
<x-card>
    <x-slot name="header">
    </x-slot>
    <x-slot name="body">
        <div class="col-12">
            <div class="col-12">
                <h3>Enviar o Transferir Productos
                @if($type!='show') 
                    <a class="btn btn-primary rounded float-right" 
                        x-on:click.prevent="funcionTransferirProductos">
                            <i class="fa fa-plus"></i>
                    </a> 
                    @endif
                </h3>
                <table class="table table-sm text-center table-hover">
                    <thead class="bg-lightblue">
                        <tr align="center" scope="col">
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Vendedor</th>
                            <th>Precio Venta</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody x-data>
                        <template x-for="(transferir, key) in transferirProductos" :key="key">
                            <tr align="center" x-on:mouseover="transferir.mouseover = true" x-on:mouseout="transferir.mouseover = false">
                                //Origen
                                <td >
                                    <x-field>
                                        <x-select type="text" 
                                                name="origen"
                                                x-bind:class="errors['transferirProductos.'+key+'.origen'] ? 'is-invalid' : ''"
                                                x-model="transferir.origen"
                                                x-bind:name="`transferirProductos[${key}][origen]`"
                                                class="form-control-sm"
                                                readonly="{{ ($type=='show') ? true : false }}" style="{{ $type == 'show' ? 'pointer-events:none': '' }}" 
                                                x-on:change="origen(key)"
                                        >
                                            <option value="" selected>--Origen--</option>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{ $usuario?->id ?? 1 }}">
                                                    {{ $usuario?->name ?? 'Administrador' }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        <template x-if="errors['transferirProductos.'+key+'.origen']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'.origen']">
                                            </div>
                                        </template>
                                    </x-field>
                                </td>
                                //Destino
                                <td >
                                    <x-field>
                                        <x-select type="text" 
                                                name="destino"
                                                x-bind:class="errors['transferirProductos.'+key+'.destino'] ? 'is-invalid' : ''"
                                                x-model="transferir.destino"
                                                x-bind:name="`transferirProductos[${key}][destino]`"
                                                class="form-control-sm"
                                                readonly="{{ ($type=='show') ? true : false }}" style="{{ $type == 'show' ? 'pointer-events:none': '' }}" 
                                                x-on:change="destino(key)"
                                        >
                                            <option value="" selected>--Destino--</option>
                                            @foreach ($usuarios as $usuario)
                                                <option value="{{ $usuario?->id ?? 1 }}">
                                                    {{ $usuario?->name ?? 'Administrador' }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        <template x-if="errors['transferirProductos.'+key+'.destino']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'.destino']">
                                            </div>
                                        </template>
                                    </x-field>
                                </td>
                                //Producto
                                <td >
                                    <x-field>
                                        <x-input 
                                            list="productos"
                                            x-bind:readonly="type === 'show'"
                                            value="old('transferirProductos.' + key)"
                                            x-bind:class="errors['transferirProductos.'+key+'.producto'] ? 'is-invalid' : ''"
                                            x-model="producto.producto"
                                            x-bind:name="`transferirProductos[${key}][producto]`"
                                            class="form-control-sm"
                                            x-on:change="informacionProducto(key)"
                                        />
                                        <datalist id="productos">
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->nombre }}"></option>
                                            @endforeach
                                        </datalist>
                                        <template x-if="errors['transferirProductos.'+key+'.producto']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'.producto']"></div>
                                        </template>
                                    </x-field>
                                </td>
                                //Cantidad
                                <td>
                                    <x-field>
                                        <x-input type="number"
                                                x-bind:readonly="type === 'show'"
                                                x-bind:class="errors['transferirProductos.'+key+'.cantidad'] ? 'is-invalid' : ''"
                                                x-model="transferir.cantidad"
                                                x-bind:name="`transferirProductos[${key}][cantidad]`"
                                            class="form-control-sm"
                                        />
                                        <template x-if="errors['transferirProductos.'+key+'.cantidad']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'.cantidad']">
                                            </div>
                                        </template>
                                    </x-field>
                                </td>
                                //Precio Vendedor
                                <td>
                                    <x-field>
                                        <x-input type="number"
                                                x-bind:readonly="type === 'show'"
                                                x-bind:class="errors['transferirProductos.'+key+'._vendedor'] ? 'is-invalid' : ''"
                                                x-model="transferir._vendedor"
                                                x-bind:name="`transferirProductos[${key}][_vendedor]`"
                                            class="form-control-sm"
                                        />
                                        <template x-if="errors['transferirProductos.'+key+'._vendedor']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'._vendedor']">
                                            </div>
                                        </template>
                                    </x-field>
                                </td>
                                //Precio Venta
                                <td>
                                    <x-field>
                                        <x-input type="number"
                                                x-bind:readonly="type === 'show'"
                                                x-bind:class="errors['transferirProductos.'+key+'.precio_venta'] ? 'is-invalid' : ''"
                                                x-model="transferir.precio_venta"
                                                x-bind:name="`transferirProductos[${key}][precio_venta]`"
                                            class="form-control-sm"
                                        />
                                        <template x-if="errors['transferirProductos.'+key+'.precio_venta']">
                                            <div class="invalid-feedback" x-text="errors['transferirProductos.'+key+'.precio_venta']">
                                            </div>
                                        </template>
                                    </x-field>
                                </td>
                                //BOTON
                                <td x-show="type !== 'show'"  style="width: 5px;">
                                    <x-field>
                                        <a href="#" type="button" class="text-danger" x-on:click.prevent="eliminarTransferirProducto(key)" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Eliminar">
                                            <span class="fas fa-trash" aria-hidden="true"></span>
                                        </a>
                                    </x-field>
                                </td>
                            </tr>
                        </template>
                        <tr align="center" x-show="transferirProductos.length === 0">
                            <td colspan="8">No existen grupo de transferiro</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </x-slot>
    @if( $type !='show')
    <x-slot:footer>
        {{-- <x-input type="submit" value='{{ $submit_text }}' /> --}}
    </x-slot>
    @endif
</x-card>


{{-- INVENTARIOOOOOOO --}}
<x-card>
    <x-slot name="header">
    </x-slot>
    <x-slot name="body">
        <div class="col-12">
            @foreach ($inventarioPorUsuarios as $usuario)
                <h3>Inventario de: {{  $usuario[0]['usuario_id'] == 1 ? $usuario[0]['usuario_nombre'] : $usuario[0]['usuario']?->name }} </h3>
                <table class="table table-sm text-center table-hover">
                    <thead class="bg-lightblue">
                        <tr align="center" scope="col">
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Precio Costo</th>
                            <th>Precio Vendedor</th>
                            <th>Precio Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuario as $inventario)
                            <tr>
                                <x-td width="20%"  class="text-center">
                                    {{ $inventario['producto']?->nombre}}
                                </x-td>
                                <x-td width="20%"  class="text-center">
                                    {{ $inventario['stock'] }}
                                </x-td>
                                <x-td width="20%"  class="text-center">
                                    {{ $inventario['producto']?->precio_costo }}
                                </x-td>
                                <x-td width="20%"  class="text-center">
                                    {{  $inventario['usuario_id'] == 1 ? 'N/A' : $inventario['precio_vendedor'] }}
                                </x-td>
                                <x-td width="20%"  class="text-center">
                                    {{ $inventario['usuario_id'] == 1 ? 'N/A' :  $inventario['precio_venta'] }}
                                </x-td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </x-slot>
    <x-slot:footer>
    </x-slot>
</x-card>

@push('js')
<script>
    function data(){
        return {
            errors: JSON.parse('{{ $errors->toJson() }}'.replace(/&quot;/g,'"')),
            type : '{{ $type }}',
            productos:@json(old('productos',$productos ?? [])),
            usuarios:@json(old('usuarios',$usuarios ?? [])),
            transferirProductos:@json(old('transferirProductos', $transferirProductos ?? [])),

            prueba: false,
            init(){

            },
            funcionTransferirProductos(){
                this.transferirProductos.push({ origen: '', destino: '', producto: '', cantidad:'', precio_vendedor:'', precio_venta:'' })
            },
            eliminarTransferirProducto(key){
                this.transferirProductos.splice(key, 1)
            },
            origen(key){
                if(this.transferirProductos[key].origen === this.transferirProductos[key].destino){
                    this.transferirProductos[key].origen = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El origen no puede ser igual al destino.',
                    });
                }
                // let origen = this.transferirProductos[key].origen;
                // this.transferirProductos.forEach((item, index) => {
                //     if(index !== key && item.origen === origen){
                //         this.transferirProductos[key].origen = '';
                //         Swal.fire({
                //             icon: 'error',
                //             title: 'Error',
                //             text: 'El origen ya ha sido seleccionado en otro grupo.',
                //         });
                //     }
                // });
            },
            destino(key){
                if(this.transferirProductos[key].origen === this.transferirProductos[key].destino){
                    this.transferirProductos[key].destino = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El destino no puede ser igual al origen.',
                    });
                }
                // let destino = this.transferirProductos[key].destino;
                // this.transferirProductos.forEach((item, index) => {
                //     if(index !== key && item.destino === destino){
                //         this.transferirProductos[key].destino = '';
                //         Swal.fire({
                //             icon: 'error',
                //             title: 'Error',
                //             text: 'El destino ya ha sido seleccionado en otro grupo.',
                //         });
                //     }
                // });
            },

        }
    }
</script>
@endpush