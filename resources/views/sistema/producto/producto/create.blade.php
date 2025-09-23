@extends('layouts.admin')

@section('content')

    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item text-bold">
                            <a href="{{ route('productos.index') }}">
                                Productos
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-bold">Nuevo</li>
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
                    <x-form method="POST" action="{{ route('productos.store', $producto) }}">
                        @csrf

                        {{-- Incluye el formulario parcial --}}
                        @include('sistema.producto.producto.partials._form', [
                            'submit_text' => 'Guardar',
                            'type' => 'store'
                        ])

                    </x-form>
                </div>
            </div>
        </div>
    </section>

@endsection
