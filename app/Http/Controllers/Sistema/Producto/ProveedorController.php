<?php

namespace App\Http\Controllers\Sistema\Producto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\Producto\ProveedorRequest;
use App\Models\Sistema\Producto\Proveedor;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('sistema.producto.proveedor.index');
    }


    public function create()
    {
        $proveedor = new Proveedor();
        return view('sistema.producto.proveedor.create', compact('proveedor'));
    }

    public function store(ProveedorRequest $request)
    {
        try {
            Proveedor::create($request->validated());
            alert()->success('Éxito', 'Registro Guardado Exitosamente');
            return redirect()->route('proveedores.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Proveedor $proveedor)
    {
        return view('sistema.producto.proveedor.edit', compact('proveedor'));
    }

    public function update(ProveedorRequest $request, Proveedor $proveedor)
    {
        try {
            $proveedor->update([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
            ]);
            alert()->success('Éxito', 'Registro Actualizado Exitosamente');
            return redirect()->route('proveedores.index');
        } catch (\Exception $e) {
            alert()->error('Error', 'Transacci&oacute;n Fallida');
            return redirect()->back()->withInput();
        }
    }
}
