@extends('layouts.admin')

@section('content')

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-bold">
                            <a href="{{ route('proveedores.index') }}">
                                Proveedores
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-bold">Editar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-form method="put" action="{{ route('proveedores.update', $proveedor) }}">
                        @include('sistema.producto.proveedor.partials._form', [
                            'submit_text' => 'Actualizar',
                            'type' => 'update'
                        ])
                    </x-form>
                </div>
            </div>
        </div>
    </section>

@endsection
