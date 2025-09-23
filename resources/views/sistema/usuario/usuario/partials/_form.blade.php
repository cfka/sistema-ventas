
<x-card>
    <x-slot name="header">
        <h3 class="card-title text-bold">Usuarios</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row col-12" x-data>
            <x-field class="col-4">
                <x-label for="name">Nombre del Usuario: </x-label>
                <x-input id="name" name="name" value="{{ old('name', $usuario?->name) }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('name') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-4">
                <x-label for="email">Email del Usuario:</x-label>
                <x-input id="email" name="email" value="{{ old('email', $usuario?->email) }} " class=" {{ $errors->has('email') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('email') {{ $message }} @enderror
                </div>
            </x-field>
            <x-field class="col-4">
                <x-label for="password">Password del Usuario:</x-label>
                <x-input id="password" name="password"  value="{{ $type != 'update' ? old('password') : '' }}" class=" {{ $errors->has('password') ? 'is-invalid' : '' }}"/>
                <div class="invalid-feedback">
                    @error('password') {{ $message }} @enderror
                </div>
            </x-field>
        </div>

        <div class="row col-12">
            <x-field class="col-6">
                <label for="rol">Rol del usuario</label>
                <x-select id="rol" name="rol" x-model="rol" class="form-control" x-on:change="cambioRol" readonly="{{ $type == 'show' ? true : false }}" style="{{ $type=='show' ? 'pointer-events:none': '' }}">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" 
                        @selected(old('rol', $usuario->roles->first()->name ?? '') == $rol->name)>
                        {{ $rol->name }}
                    </option>
                    @endforeach
                </x-select>
            </x-field>

            <x-field class="col-6">
                <label for="employeer">Tienda del usuario</label>
                <x-select id="employeer" 
                            name="employeer" 
                            class="form-contemployeer" 
                            readonly="{{ $type == 'show' ? true : false }}" 
                            style="{{ $type=='show' ? 'pointer-events:none': '' }}"
                            x-model="employeer"
                            x-bind:disabled="rol?.toLowerCase() != 'vendedor' ? true : false"
                >
                    <option value="">Seleccione una Tienda</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" 
                        @selected(old('employeer', $usuario->employeer ?? '') == $user->id)>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </x-select>  
            </x-field>
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
            rol : @json(old("rol", $usuario->roles->first()->name ?? '')),
            employeer : @json(old("employeer", $usuario->employeer ?? '')),
            prueba: false,
            init(){
                if (this.type != 'show') {
                    this.cambioRol();
                }
            },
            cambioRol(){
                console.log("cambio de rol");
                if (this.rol?.toLowerCase() != 'vendedor') {
                    this.employeer = null;
                }
            }
        }
    }
</script>
@endpush