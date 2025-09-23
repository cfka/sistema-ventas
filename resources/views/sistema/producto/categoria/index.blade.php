@extends('layouts.admin')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
                {{-- Botones de acción --}}
                <x-button class="btn-success" href="{{ route('categorias.create') }}" title="Nuevo"><i class="fas fa-plus-circle"></i> Nuevo</x-button>
                {{-- <x-button href="{{ route('categorias.complejoPDF') }}" target="_blank" class="btn-primary" title="Generar PDF"><i class="fas fa-download"> </i> Generar PDF</x-button> --}}
            </div>
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item text-bold"><a href="{{ route('dashboard') }}">Página principal</a></li>
                    <li class="breadcrumb-item active text-bold">Categorias</li>
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
                @livewire('sistema.producto.categoria.index-component')
            </div>
        </div>
    </div>
</section>

@endsection

