<?php

namespace App\Livewire\Sistema\Producto\Categoria;

use App\Models\Sistema\Producto\Categoria;
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
        // return view('livewire.categorias.index');

        return view('livewire.sistema.producto.categoria.index-component', [
            'headers' => [
                ['name' => 'Categoria', 'classes' => 'text-center', 'sort' => 'nombre'],
                ['name' => 'Descripcion', 'classes' => 'text-center', 'sort' => 'descripcion'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            'categorias' => Categoria::select()
                ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orWhereRaw('LOWER(descripcion) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate),
        ]
        );
    }
}
