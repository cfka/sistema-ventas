<x-card>
    <x-slot name="header">
        <h3 class="card-title text-bold">Categorias</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row col-12" x-data>
            <x-field class="col-3">
                <x-label for="nombre">Nombre Categoria: </x-label>
                <x-input name="nombre" value="{{ old('nombre', $categoria?->nombre) }}" class="{{ $errors->has('nombre') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('nombre') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-9">
                <x-label for="descripcion">Descripcion Categoria:</x-label>
                <x-input name="descripcion" value="{{ old('descripcion', $categoria?->descripcion) }} " class=" {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('descripcion') {{ $message }} @enderror
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
