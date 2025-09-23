<?php

namespace App\Http\Requests\Sistema\Producto;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'max:255',
            'descripcion' => 'max:255',
            'categoria_id' => 'max:255',
            'preveedor_id' => 'max:255',
            'precio_proveedor' => 'max:255',
            'precio_envio' => 'max:255',
            'precio_costo' => 'max:255',
        ];
    }
}
