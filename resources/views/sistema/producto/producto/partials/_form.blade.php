<x-card>
    <x-slot name="header">
        <h3 class="card-title text-bold">Productos</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row col-12" x-data>
            <x-field class="col-6">
                <x-label for="nombre">Nombre del Producto: </x-label>
                <x-input name="nombre" value="{{ old('nombre', $producto?->nombre) }}" class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('nombre') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-6">
                <x-label for="descripcion">Descripcion del Producto:</x-label>
                <x-input name="descripcion" value="{{ old('descripcion', $producto?->descripcion) }} " class=" {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('descripcion') {{ $message }} @enderror
                </div>
            </x-field>
        </div>

        <div class="row col-12" x-data>
            <x-field class="col-6">
                <label for="categoria_id">Categoria</label>
                <x-select id="categoria_id" name="categoria_id" class="form-control" readonly="{{ $type == 'show' ? true : false }}" style="{{ $type=='show' ? 'pointer-events:none': '' }}">
                    <option value="" selected>--Categorias--</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected(intval(old('categoria_id', $producto->categoria_id)) == $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </x-select>
            </x-field>
            <x-field class="col-6">
                <label for="proveedor_id">Proveedor</label>
                <x-select id="proveedor_id" name="proveedor_id" class="form-control" readonly="{{ $type == 'show' ? true : false }}" style="{{ $type=='show' ? 'pointer-events:none': '' }}">
                    <option value="" selected>--Proveedores--</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" @selected(intval(old('proveedor_id', $producto->proveedor_id)) == $proveedor->id)>
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </x-select>
            </x-field>
        </div>

        <div class="row col-12" x-data>
            <x-field class="col-4">
                <x-label for="precio_proveedor">Precio Proveedor: </x-label>
                <x-input name="precio_proveedor" value="{{ old('precio_proveedor', $producto?->precio_proveedor) }}" class="{{ $errors->has('precio_proveedor') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('precio_proveedor') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-4">
                <x-label for="precio_envio">Precio Envio:</x-label>
                <x-input name="precio_envio" value="{{ old('precio_envio', $producto?->precio_envio) }} " class=" {{ $errors->has('precio_envio') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('precio_envio') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-4">
                <x-label for="precio_costo">Precio Costo:</x-label>
                <x-input name="precio_costo" value="{{ old('precio_costo', $producto?->precio_costo) }} " class=" {{ $errors->has('precio_costo') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('precio_costo') {{ $message }} @enderror
                </div>
            </x-field>
        </div>
    </x-slot>
    @if( $type !='show')
    <x-slot:footer>
        <x-input type="submit" value='{{ $submit_text }}' />
    </x-slot>
    @endif
</x-card>
