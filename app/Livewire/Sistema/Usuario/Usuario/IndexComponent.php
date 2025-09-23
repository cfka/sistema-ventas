<?php

namespace App\Livewire\Sistema\Usuario\Usuario;

use App\Models\User;
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
        return view('livewire.sistema.usuario.usuario.index-component', [
            'headers' => [
                ['name' => 'Nombre', 'classes' => 'text-center', 'sort' => 'name'],
                ['name' => 'Email', 'classes' => 'text-center', 'sort' => 'email'],
                // ['name' => 'Rol', 'classes' => 'text-center', 'sort' => 'rol'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            'usuarios' => User::select()
                ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->search) . '%'])
                // ->orWhereRaw('LOWER(rol) LIKE ?', ['%' . strtolower($this->search) . '%'])
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate),
        ]
        );
    }
}