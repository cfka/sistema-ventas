<div class="callout callout-info p-2 pt-4 ">
    <div class="row align-content-center d-flex justify-content-center">
        @if (!is_null($colada))
            <x-field class="col-md-2">
                <label class="col-form-label text-bold ">Colada:</label>
                <div class="row">
                    <div class="col-md-3">
                        <x-input name="nro_sala" x-model="sala" readonly x-on:change="obtenerCelda()"/>
                    </div>
                    <div class="col-md-9">
                        <x-input name="nro_colada_red" x-model="nro_colada_red" readonly/>
                    </div>
                </div>

            </x-field>
        @endif

        <x-field class="col-md-2">
            <x-label class="col-form-label text-bold ">Fecha:</x-label>
            <x-input name="fecha" type="date" x-model="fecha" x-on:change="cambioGrupo()" readonly="{{ $fechaR == 'true' ? true : false }}" class="{{ $errors->has('fecha') ? 'is-invalid' : '' }}"/>
            <div class="invalid-feedback">
                @error('fecha') {{ $message }} @enderror
            </div>
        </x-field>

        <x-field class="col-md-1">
            <x-label class="col-form-label text-bold ">Turno:</x-label>
                <x-select  name="turno" class="form-control" x-model="turno" x-on:change="cambioGrupo()" readonly="{{ $turnoR == 'true' ? true : false }}" style="{{ $turnoR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('turno') ? 'is-invalid' : '' }}">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                </x-select>
                <div class="invalid-feedback">
                    @error('turno') {{ $message }} @enderror
                </div>
        </x-field>

        <x-field class="col-md-1">
            <x-label class="col-form-label text-bold ">Grupo:</x-label>
            <x-input name="grupo" type="text" x-model="grupo" readonly class="{{ $errors->has('grupo') ? 'is-invalid' : '' }}"/>
            <div class="invalid-feedback">
                @error('grupo') {{ $message }} @enderror
            </div>
        </x-field>

        @if (!is_null($salas))
                <x-field class="col-md-2">
                    <x-label class="col-form-label text-bold ">Salas:</x-label>
                    <x-select name="sala" x-model="sala" x-on:change="cambioSalas()" readonly="{{ $salasR == 'true' ? true : false }}" style="{{ $salasR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('sala') ? 'is-invalid' : '' }}">
                        <option value="" selected> --Seleccione-- </option>
                        <template x-for="(item, key) in salas" :key="key">
                            <option  :value="item.nro_sala" x-text="item.desc_sala" :selected="item.nro_sala == sala ? true : false"></option>
                        </template>
                    </x-select>
                    <div class="invalid-feedback">
                        @error('sala') {{ $message }} @enderror
                    </div>
                </x-field>
        @endif

        @if (!is_null($gruas))
                <x-field class="col-md-2">
                    <x-label class="col-form-label text-bold ">Gruas:</x-label>
                    <x-select name="grua" x-model="grua" x-on:change="cambioGruas()" readonly="{{ $gruasR == 'true' ? true : false }}" style="{{ $gruasR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('grua') ? 'is-invalid' : '' }}" >
                        <option value="" selected> --Seleccione-- </option>
                        <template x-for="(item, key) in gruas" :key="key">
                            <option  :value="item.cod_equipo" x-text="item.descripcion" :selected="item.cod_equipo == grua ? true : false"></option>
                        </template>
                    </x-select>
                </x-field>
        @endif

        @if (!is_null($planta))
                <x-field class="col-md-2">
                    <x-label class="col-form-label text-bold ">Planta:</x-label>
                    <x-select name="planta" x-model="planta" x-on:change="cambioPlanta($event.target.value)" readonly="{{ $plantaR == 'true' ? true : false }}" style="{{ $plantaR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('planta') ? 'is-invalid' : '' }}" >
                        <option value="" selected> --Seleccione-- </option>
                        <template x-for="(item, key) in plantas" :key="key">
                            <option  :value="item.cod_planta" x-text="item.descripcion" :selected="item.cod_planta == planta ? true : false"></option>
                        </template>
                    </x-select>
                    <div class="invalid-feedback">
                        @error('planta') {{ $message }} @enderror
                    </div>
                </x-field>
        @endif

        @if ($seccion || $subSeccion)
            <x-field class="col-md-1">
                <x-label class="col-form-label text-bold">Seccion:</x-label>
                <x-select name="seccion" class="form-control" x-model="seccion" x-on:change="cambioSeccion()" readonly="{{ $seccionR == 'true' ? true : false }}" style="{{ $seccionR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('seccion') ? 'is-invalid' : '' }}">
                    <option value="1">A</option>
                    <option value="2">B</option>
                    @if ($seccion)
                        <option value="3">C</option>
                    @endif
                </x-select>
                <div class="invalid-feedback">
                    @error('seccion') {{ $message }} @enderror
                </div>
            </x-field>
        @endif
            @if (!is_null($lineas))
            <x-field class="col-md-2">
                <x-label class="col-form-label text-bold ">Lineas:</x-label>
                <x-select name="linea" x-model="linea" x-on:change="cambioLineas()" readonly="{{ $lineasR == 'true' ? true : false }}" style="{{ $lineasR == 'true' ? 'pointer-events:none': '' }}" class="{{ $errors->has('linea') ? 'is-invalid' : '' }}">
                    <option value="" selected> --Seleccione-- </option>
                    <template x-for="(item, key) in lineas" :key="key">
                        <option  :value="item.nro_linea" x-text="item.desc_linea" :selected="item.nro_linea == linea ? true : false"></option>
                    </template>
                </x-select>
                <div class="invalid-feedback">
                    @error('linea') {{ $message }} @enderror
                </div>
            </x-field>
    @endif

    </div>
    @if(!is_null($departamentos))
    <div class="row align-content-center d-flex justify-content-center">
        <x-field class="col-md-6">
            <x-label class="col-form-label text-bold ">Departamento:</x-label>
            <x-select name="deparatamento" x-model="departamento" x-on:change="cambioDepartamento()" readonly=true  style="pointer-events:none">
                <option value="" selected> --Seleccione-- </option>
                <template x-for="(item, key) in departamentos" :key="key">
                    <option  :value="item.nem_dpto" x-text="item.descripcion" :selected="item.nem_dpto == departamento ? true : false"></option>
                </template>
            </x-select>
            <div class="invalid-feedback">
                @error('deparatamento') {{ $message }} @enderror
            </div>
        </x-field>
    </div>
    @endif
</div>
