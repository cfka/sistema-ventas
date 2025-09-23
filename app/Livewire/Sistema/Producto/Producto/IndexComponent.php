<?php

namespace App\Livewire\Sistema\Producto\Producto;

use App\Models\Sistema\Producto\Producto;
use App\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class IndexComponent extends Component
{
    use WithPagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $paginate = '0';

    public function mount()
    {
        $this->sort = 'id';
        $this->direction = 'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPaginate()
    {
        $this->resetPage();
    }

    public function render()
    {
        // return view('livewire.productos.index');
        return view('livewire.sistema.producto.producto.index-component', [
            'headers' => [
                ['name' => 'Imagen', 'classes' => 'text-center', 'sort' => 'imagen'],
                ['name' => 'Producto', 'classes' => 'text-center', 'sort' => 'nombre'],
                ['name' => 'Descripcion', 'classes' => 'text-center', 'sort' => 'descripcion'],
                ['name' => 'Categoria', 'classes' => 'text-center', 'sort' => 'categoria'],
                ['name' => 'Proveedor', 'classes' => 'text-center', 'sort' => 'proveedor'],
                ['name' => 'Precio', 'classes' => 'text-center', 'sort' => 'precio_costo'],
                // ['name' => 'Precio Proveedor', 'classes' => 'text-center', 'sort' => 'precio_proveedor'],
                // ['name' => 'Precio Envio', 'classes' => 'text-center', 'sort' => 'precio_envio'],
                // ['name' => 'Precio Costo', 'classes' => 'text-center', 'sort' => 'precio_costo'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            'productos' => Producto::select()
                ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(descripcion) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(categoria_id) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(proveedor_id) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(precio_costo) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(precio_proveedor) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orwhereRaw('LOWER(precio_envio) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate),
        ]
        );
    }
}
