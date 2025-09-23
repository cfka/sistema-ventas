<?php

namespace App\Http\Controllers\Sistema\Producto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\Producto\ProductoRequest;
use App\Models\Sistema\Producto\Categoria;
use App\Models\Sistema\Producto\Producto;
use App\Models\Sistema\Producto\Proveedor;

class ProductoController extends Controller
{
    public function index()
    {
        return view('sistema.producto.producto.index');
    }


    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('sistema.producto.producto.create', compact('producto', 'categorias', 'proveedores'));
    }

    public function store(ProductoRequest $request)
    {
        try {
            Producto::create($request->validated());
            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('sistema.producto.producto.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        try {
            $producto->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'imagen_dir' => $request->imagen_dir,
                'categoria_id' => $request->categoria_id,
                'proveedor_id' => $request->proveedor_id,
                'precio_proveedor' => $request->precio_proveedor,
                'precio_envio' => $request->precio_envio,
                'precio_costo' => $request->precio_costo,
            ]);
            alert()->success('Éxito', 'Registro Actualizado Exitosamente');
            return redirect()->route('productos.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }
}
