<x-card>
    <x-slot name="header">
        <h3 class="card-title text-bold">Proveedores</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row col-12" x-data>
            <x-field class="col-6">
                <x-label for="nombre">Nombre del Proveedor: </x-label>
                <x-input name="nombre" value="{{ old('nombre', $proveedor?->nombre) }}" class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('nombre') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-6">
                <x-label for="email">Email del Proveedor:</x-label>
                <x-input name="email" value="{{ old('email', $proveedor?->email) }} " class=" {{ $errors->has('email') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('email') {{ $message }} @enderror
                </div>
            </x-field>
        </div>
                <div class="row col-12" x-data>
            <x-field class="col-6">
                <x-label for="telefono">Telefono del Proveedor: </x-label>
                <x-input name="telefono" value="{{ old('telefono', $proveedor?->telefono) }}" class="{{ $errors->has('telefono') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('telefono') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-6">
                <x-label for="direccion">Direccion del Proveedor:</x-label>
                <x-input name="direccion" value="{{ old('direccion', $proveedor?->direccion) }} " class=" {{ $errors->has('direccion') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('direccion') {{ $message }} @enderror
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
