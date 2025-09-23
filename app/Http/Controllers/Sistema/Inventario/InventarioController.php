<?php

namespace App\Http\Controllers\Sistema\Inventario;

use App\Http\Controllers\Controller;
use App\Models\Sistema\Compra\Compra;
use App\Models\Sistema\Inventario\Inventario;
use App\Models\Sistema\Producto\Producto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sistema.inventario.inventario.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sistema.inventario.inventario.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('sistema.inventario.inventario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('sistema.inventario.inventario.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {

        /// inicio de los inventarios
        // Objetivo: Unir los productos de compras(con estado recibidos que tiene el administrador
        // y los productos que tienen los usuarios en inventario)

        // 1. Obtén los productos comprados y recibidos (productos que tiene el administrador)
        $productos = Compra::with('producto')
            ->select('producto_id', DB::raw('SUM(cantidad) as stock, 1 as usuario_id, (SELECT name FROM users WHERE id=1) as usuario_nombre') )
            ->where('estado', 'recibido')
            ->groupBy('producto_id', 'usuario_id')
            ->get();
            

        // Obtén los productos que tienen los usuarios en inventario y el estado es 'activo'
        $inventarios = Inventario::with(['producto','usuario'])
                        ->where('estado', 'activo')
                        ->get();

        // 2. Establece un formato uniforme usando map()
        $productosMapped = $productos->map(function ($item) {
            return [
                'producto_id' => $item->producto_id,
                'stock' => $item->stock,
                'usuario_id' => $item->usuario_id,
                'usuario_nombre' => $item->usuario_nombre,
                'producto' => $item->producto,
            ];
        });

        $inventariosMapped = $inventarios->map(function ($item) {
            return [
                'producto_id' => $item->producto_id,
                'stock' => $item->stock,
                'usuario_id' => $item->usuario_id,
                'producto' => $item->producto,
                'usuario' => $item->usuario,
                'precio_vendedor' => $item->precio_vendedor,
                'precio_venta' => $item->precio_venta,
            ];
        });


        // 3. Une ambas colecciones
        $todo = collect($productosMapped)->concat(collect($inventariosMapped)); ///cual es mejor y porque
        // $todo = collect($productosMapped)->merge(collect($inventariosMapped));  ///cual es mejor y porque

        // 4. (Opcional) Agrupa por usuario_id
        $inventarioPorUsuarios = $todo->groupBy('usuario_id');

        /// fin de los inventarios



        /// buscar los productos que esten con stock (ya sea en compras o en inventario) y los usuarios


        $productos = Producto::whereIn('id', $todo->pluck('producto_id')->unique()->values())->get();

        $usuarios = User::whereIn('id', $todo->pluck('usuario_id')->unique()->values())->get();

        return view('sistema.inventario.inventario.edit', compact('usuario', 'inventarioPorUsuarios', 'productos', 'usuarios'));
    }

    /**
     * Update the specified resource in storage. u
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
