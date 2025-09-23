<?php

namespace App\Livewire\Sistema\Inventario\Inventario;

use Livewire\Component;
use App\Traits\WithSorting;
use Livewire\WithPagination;
use App\Models\User;

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
        return view('livewire.sistema.inventario.inventario.index-component', [
            'headers' => [
                ['name' => 'Nombre', 'classes' => 'text-center', 'sort' => 'name'],
                ['name' => 'Email', 'classes' => 'text-center', 'sort' => 'email'],
                // ['name' => 'Rol', 'classes' => 'text-center', 'sort' => 'rol'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            'usuarios' => User::select()
                // ->where('id', '!=', '1')
                ->whereNull('employeer',)
                ->WhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate),
        ]
        );
    }
}
