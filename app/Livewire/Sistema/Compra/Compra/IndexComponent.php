<?php

namespace App\Livewire\Sistema\Compra\Compra;

use App\Models\Sistema\Compra\Compra;
use Livewire\Component;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class IndexComponent extends Component
{

    use WithPagination, WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $paginate = '0';

    public function mount()
    {
        $this->sort = 'numero_compra';
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
        // return view('livewire.sistema.compra.compra.index-component', [
        //     'headers' => [
        //         ['name' => 'Numero de Compra', 'classes' => 'text-center', 'sort' => 'numero_compra'],
        //         ['name' => 'Fecha de Compra', 'classes' => 'text-center', 'sort' => 'fecha_compra'],
        //         ['name' => 'Fecha Estimada Llegada', 'classes' => 'text-center', 'sort' => 'fecha_estimada_llegada'],
        //         ['name' => 'Estado', 'classes' => 'text-center', 'sort' => 'estado'],
        //         ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
        //     ],
        //     'compras' => Compra::query()
        //         ->select('numero_compra','fecha_compra','fecha_estimada_llegada', 'estado')
        //         ->distinct('numero_compra','fecha_compra','fecha_estimada_llegada', 'estado')
        //         ->whereRaw('numero_compra LIKE ?', ['%' . $this->search . '%'])
        //         ->orwhereRaw('fecha_compra LIKE ?', ['%' . $this->search . '%'])
        //         ->orwhereRaw('fecha_estimada_llegada LIKE ?', ['%' . $this->search . '%'])
        //         ->orwhereRaw('LOWER(estado) LIKE ?', ['%' . strtolower($this->search) . '%'])
        //         ->orderBy($this->sort, $this->direction)
        //         ->paginate($this->paginate),
        // ]
        // );
        return view('livewire.sistema.compra.compra.index-component', [
            'headers' => [
                ['name' => 'Numero de Compra', 'classes' => 'text-center', 'sort' => 'numero_compra'],
                ['name' => 'Fecha de Compra', 'classes' => 'text-center', 'sort' => 'fecha_compra'],
                ['name' => 'Fecha Estimada Llegada', 'classes' => 'text-center', 'sort' => 'fecha_estimada_llegada'],
                ['name' => 'Estado', 'classes' => 'text-center', 'sort' => 'estado'],
                ['name' => 'Action', 'classes' => 'text-center', 'sort' => 'action'],
            ],
            // 'compras' => Compra::query()
            //     ->select('numero_compra','fecha_compra','fecha_estimada_llegada', 'estado')
            //     ->when($this->search, function ($query) {
            //         $s = strtolower($this->search);
            //         $query->where(function ($q) use ($s) {
            //             $q->whereRaw('CAST(numero_compra AS CHAR) LIKE ?', ["%{$s}%"])
            //             ->orWhereRaw('fecha_compra LIKE ?', ["%{$s}%"])
            //             ->orWhereRaw('fecha_estimada_llegada LIKE ?', ["%{$s}%"])
            //             ->orWhereRaw('LOWER(estado) LIKE ?', ["%{$s}%"]);
            //         });
            //     })
            //     ->groupBy('numero_compra','fecha_compra','fecha_estimada_llegada','estado') // si necesitas filas únicas
            //     ->orderBy($this->sort, $this->direction)
            //     ->paginate($this->paginate),
            'compras' => Compra::query()
                        ->selectRaw('numero_compra, MIN(fecha_compra) as fecha_compra, MIN(fecha_estimada_llegada) as fecha_estimada_llegada, MIN(estado) as estado')
                        ->when($this->search, function ($query) {
                            $s = strtolower($this->search);
                            $query->where(function ($q) use ($s) {
                                $q->whereRaw('CAST(numero_compra AS CHAR) LIKE ?', ["%{$s}%"])
                                ->orWhereRaw('fecha_compra LIKE ?', ["%{$s}%"])
                                ->orWhereRaw('fecha_estimada_llegada LIKE ?', ["%{$s}%"])
                                ->orWhereRaw('LOWER(estado) LIKE ?', ["%{$s}%"]);
                            });
                        })
                        ->groupBy('numero_compra')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->paginate),
        ]);
    }
}
