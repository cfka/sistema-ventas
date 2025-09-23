@extends('layouts.admin')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
                {{-- Botones de acción --}}
                {{-- <x-button class="btn-success" href="{{ route('inventarios.create') }}" title="Nuevo"><i class="fas fa-plus-circle"></i> Nuevo</x-button> --}}
                {{-- <x-button href="{{ route('proveedores.complejoPDF') }}" target="_blank" class="btn-primary" title="Generar PDF"><i class="fas fa-download"> </i> Generar PDF</x-button> --}}
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item text-bold"><a href="{{ route('dashboard') }}">Página principal</a></li>
                    <li class="breadcrumb-item active text-bold">Inventarios</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @livewire('sistema.inventario.inventario.index-component')
            </div>
        </div>
    </div>
</section>

@endsection

