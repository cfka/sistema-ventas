<x-card>
    <x-slot name="header">
        <h3 class="card-title text-bold">Compra</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row col-12">
            <x-field class="col-4">
                <x-label for="numero_compra">Numero de Compra: </x-label>
                <x-input 
                    name="numero_compra" 
                    value="{{ old('numero_compra', ($type=='store' ? $compra?->numero_compra : $compra[0]?->numero_compra)) }}" 
                    class="{{ $errors->has('numero_compra') ? 'is-invalid' : '' }}"
                    readonly=true
                    />
                <div class="invalid-feedback">
                    @error('numero_compra') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-4">
                <x-label for="fecha_compra">Fecha de Compra: </x-label>
                <x-input 
                    type="date"
                    name="fecha_compra" 
                    value="{{ old('fecha_compra', ($type!=='store' ? $compra[0]?->fecha_compra : $compra[0]?->fecha_compra ?? now()->toDateString() ) ) }}" 
                    class="{{ $errors->has('fecha_compra') ? 'is-invalid' : '' }}"
                    readonly="{{ $type == 'show' || $type == 'edit' ? true : false }}"
                    style="{{ $type == 'show' ? 'pointer-events: none' : '' }}"
                    />
                <div class="invalid-feedback">
                    @error('fecha_compra') {{ $message }} @enderror
                </div>
            </x-field>

            <x-field class="col-4">
                <x-label for="fecha_estimada_llegada">Fecha Estimada de Llegada: </x-label>
                <x-input 
                    type="date"
                    name="fecha_estimada_llegada"  
                    value="{{ old('fecha_estimada_llegada', ($type!=='store' ? $compra[0]?->fecha_estimada_llegada :  $compra[0]?->fecha_estimada_llegada ?? now()->toDateString() ) ) }}" 
                    class="{{ $errors->has('fecha_estimada_llegada') ? 'is-invalid' : '' }}"
                    readonly="{{ $type == 'show' || $type == 'edit' ? true : false }}"
                    style="{{ $type == 'show' ? 'pointer-events: none' : '' }}"
                    />
                <div class="invalid-feedback">
                    @error('fecha_estimada_llegada') {{ $message }} @enderror
                </div>
            </x-field>
        </div>

        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @if($type!='show') <a class="btn btn-primary rounded float-right" x-on:click.prevent="agregarproductoCompra"><i class="fa fa-plus"></i></a> @endif
                    <table class="table table-sm text-center table-hover">
                        <thead class="bg-lightblue">
                            <tr align="center" scope="col">
                                <th>Producto</th>
                                <th>Precio Proveedor</th>
                                <th>Precio Envio</th>
                                <th>Precio Costo</th>
                                <th>Cantidad</th>
                                {{-- <th>Precio</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody x-data>
                            <template x-for="(producto, key) in productoCompra" :key="key">
                                <tr align="center" x-on:mouseover="producto.mouseover = true" x-on:mouseout="producto.mouseover = false">
                                    //Producto
                                    <td >
                                        <x-field>
                                            <x-input 
                                                list="productos"
                                                x-bind:readonly="type === 'show'"
                                                value="old('productoCompra.' + key)"
                                                x-bind:class="errors['productoCompra.'+key+'.nombre_producto'] ? 'is-invalid' : ''"
                                                x-model="producto.nombre_producto"
                                                x-bind:name="`productoCompra[${key}][nombre_producto]`"
                                                class="form-control-sm"
                                                x-on:change="informacionProducto(key)"
                                            />
                                            <datalist id="productos">
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->nombre }}"></option>
                                                @endforeach
                                            </datalist>
                                            <template x-if="errors['productoCompra.'+key+'.nombre_producto']">
                                                <div class="invalid-feedback" x-text="errors['productoCompra.'+key+'.nombre_producto']"></div>
                                            </template>
                                        </x-field>
                                    </td>
                                    //Precio Proveedor
                                    <td>
                                        <x-field>
                                            <x-input 
                                                x-mask:dynamic="$money($input)"
                                                x-bind:readonly="type === 'show'" 
                                                value="old('precio_proveedor.' + key)"
                                                x-bind:class="errors['productoCompra.'+key+'.precio_proveedor'] ? 'is-invalid' : ''"
                                                x-model="producto.precio_proveedor"
                                                x-bind:name="`productoCompra[${key}][precio_proveedor]`"
                                                class="form-control-sm"
                                            />
                                            <template x-if="errors['productoCompra.'+key+'.precio_proveedor']">
                                                <div class="invalid-feedback" x-text="errors['productoCompra.'+key+'.precio_proveedor']">
                                                </div>
                                            </template>
                                        </x-field>
                                    </td>
                                    //Precio Envio
                                    <td>
                                        <x-field>
                                            <x-input 
                                                x-mask:dynamic="$money($input)"  
                                                x-bind:readonly="type === 'show'" 
                                                value="old('precio_envio.' + key)"
                                                x-bind:class="errors['productoCompra.'+key+'.precio_envio'] ? 'is-invalid' : ''"
                                                x-model="producto.precio_envio"
                                                x-bind:name="`productoCompra[${key}][precio_envio]`"
                                                class="form-control-sm"
                                            />
                                            <template x-if="errors['productoCompra.'+key+'.precio_envio']">
                                                <div class="invalid-feedback" x-text="errors['productoCompra.'+key+'.precio_envio']">
                                                </div>
                                            </template>
                                        </x-field>
                                    </td>
                                    //Precio Costo
                                    <td>
                                        <x-field>
                                            <x-input 
                                                x-mask:dynamic="$money($input)" 
                                                x-bind:readonly="type === 'show'" 
                                                value="old('precio_costo.' + key)"
                                                x-bind:class="errors['productoCompra.'+key+'.precio_costo'] ? 'is-invalid' : ''"
                                                x-model="producto.precio_costo"
                                                x-bind:name="`productoCompra[${key}][precio_costo]`"
                                                class="form-control-sm"
                                            />
                                            <template x-if="errors['productoCompra.'+key+'.precio_costo']">
                                                <div class="invalid-feedback" x-text="errors['productoCompra.'+key+'.precio_costo']">
                                                </div>
                                            </template>
                                        </x-field>
                                    </td>
                                    //Cantidad
                                    <td>
                                        <x-field>
                                            <x-input 
                                                x-mask="9999999"
                                                x-bind:readonly="type === 'show'"
                                                value="old('cantidad.' + key)"
                                                x-bind:class="errors['productoCompra.'+key+'.cantidad'] ? 'is-invalid' : ''"
                                                x-model="producto.cantidad"
                                                x-bind:name="`productoCompra[${key}][cantidad]`"
                                                class="form-control-sm"
                                            />
                                            <template x-if="errors['productoCompra.'+key+'.cantidad']">
                                                <div class="invalid-feedback" x-text="errors['productoCompra.'+key+'.cantidad']">
                                                </div>
                                            </template>
                                        </x-field>
                                    </td>
                                    //BOTON
                                    <td x-show="type !== 'show'"  style="width: 5px;">
                                        <x-field>
                                            <a href="#" type="button" class="text-danger" x-on:click.prevent="eliminarRecibirProducto(key)" aria-label="Left Align" data-toggle="tooltip" data-placement="left" title="Eliminar">
                                                <span class="fas fa-trash" aria-hidden="true"></span>
                                            </a>
                                        </x-field>
                                    </td>
                                </tr>
                            </template>
                            <tr align="center" x-show="productoCompra.length === 0">
                                <td colspan="8">No existen grupo de producto</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </x-slot>
    @if( $type !='show')
    <x-slot:footer>
        <x-input type="submit" value='{{ $submit_text }}' />
    </x-slot>
    @endif

</x-card>
@push('js')
<script>
    function data(){
        return {
            errors: JSON.parse('{{ $errors->toJson() }}'.replace(/&quot;/g,'"')),
            type : '{{ $type }}',
            productos:@json(old('productos', $productos ?? [])),
            productoCompra:@json(old('productoCompra', ($type=='store' ? [] : $compra ?? []))),
            init(){
            },
            agregarproductoCompra(){
                this.productoCompra.push({ nombre_producto: '', precio_proveedor: '', precio_envio: '', precio_costo:'', cantidad:'' })
            },
            eliminarRecibirProducto(key){
                if(this.type!=='store'){
                    Swal.fire({
                            title: 'Eliminar Producto',
                            text: "¿Quieres Eliminar el Producto de la Compra?",
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Eliminar',
                            cancelButtonText: 'No, Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Swal.fire(
                                //     'Eliminado!',
                                //     'El producto se puede eliminar.',
                                //     'success'
                                // )
                                this.productoCompra.splice(key, 1)
                            }
                        })
                }
                else{
                    this.productoCompra.splice(key, 1)
                }
            },
            informacionProducto(key){
                let existeProducto = false;

                let productoDuplicado = false;
                for (let i = 0; i < this.productoCompra.length; i++) {
                    if (i !== key && this.productoCompra[i].nombre_producto === this.productoCompra[key].nombre_producto) {
                        productoDuplicado = true;
                        existeProducto = true;
                        break;
                    }
                }
                if (productoDuplicado) {
                    Swal.fire('Error', 'Este producto ya fue seleccionado', 'error');
                    this.productoCompra[key].nombre_producto = '';
                    // this.productoCompra[key].precio_proveedor = '';
                    // this.productoCompra[key].precio_envio = '';
                    // this.productoCompra[key].precio_costo = '';
                    // this.productoCompra[key].cantidad = '';
                }
                if (!existeProducto) {
                    for (let i = 0; i < this.productos.length; i++) {
                        if (this.productos[i].nombre === this.productoCompra[key].nombre_producto) {
                            this.productoCompra[key].precio_proveedor = this.productos[i].precio_proveedor;
                            this.productoCompra[key].precio_envio = this.productos[i].precio_envio;
                            this.productoCompra[key].precio_costo = this.productos[i].precio_costo;
                            this.productoCompra[key].cantidad = 1;
                            existeProducto = true;
                            break;
                        }
                    }
                }
                if (!existeProducto) {
                    Swal.fire({
                        title: 'Crear Producto',
                        text: "¿Quieres Crear un Nuevo Producto?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Crear',
                        cancelButtonText: 'No, Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Swal.fire(
                            //     'Creado!',
                            //     'El producto se puede crear.',
                            //     'success'
                            // )
                        }else{
                            this.productoCompra[key].nombre_producto = '';
                            this.productoCompra[key].precio_proveedor = '';
                            this.productoCompra[key].precio_envio = '';
                            this.productoCompra[key].precio_costo = '';
                            this.productoCompra[key].cantidad = '';
                        }
                    })
                }
            }
        }
    }
</script>
@endpush