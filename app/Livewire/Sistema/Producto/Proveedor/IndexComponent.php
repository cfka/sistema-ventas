<?php

namespace App\Livewire\Sistema\Producto\Proveedor;

use App\Models\Sistema\Producto\Proveedor ;
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
        // return view('livewire.proveedores.index');

        return view('livewire.sistema.producto.proveedor.index-component', [
            'headers' => [
                ['name' => 'Proveedor', 'classes' => 'text-center', 'sort' => 'nombre'],
                ['name' => 'Email', 'classes' => 'text-center', 'sort' => 'email'],
                ['name' => 'Telefono', 'classes' => 'text-center', 'sort' => 'telefono'],
                ['name' => 'Direccion', 'classes' => 'text-center', 'sort' => 'direccion'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            'proveedores' => Proveedor::select()
                ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orWhereRaw('LOWER(telefono) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orWhereRaw('LOWER(direccion) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate),
        ]
        );
    }
}
