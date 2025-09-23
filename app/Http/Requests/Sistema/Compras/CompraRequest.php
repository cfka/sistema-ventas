<?php

namespace App\Http\Requests\Sistema\Compras;

use App\Models\Sistema\Compra\Compra;
use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
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
            'fecha_compra' => 'date',
            'fecha_estimada_llegada' => 'date',
            'productoCompra.*.nombre_producto' => 'max:255',
            'productoCompra.*.precio_proveedor' => 'min:0|numeric',
            'productoCompra.*.precio_envio' => 'min:0|numeric',
            'productoCompra.*.precio_costo' => 'min:0|numeric',
            'productoCompra.*.cantidad' => 'min:0|integer',
        ];

    }

    public function messages()
    {
        return [
            'productoCompra.*.precio_proveedor.min' => 'El precio de proveedor no puede ser negativa.',
            'productoCompra.*.precio_proveedor.required' => 'El precio de proveedor solo puede ser numeros.',
            'productoCompra.*.precio_envio.min' => 'El precio de envío no puede ser negativa.',
            'productoCompra.*.precio_envio.required' => 'El precio de envío solo puede ser numeros.',
            'productoCompra.*.precio_costo.min' => 'El precio de costo no puede ser negativa.',
            'productoCompra.*.precio_costo.required' => 'El precio de costo solo puede ser numeros.',
            'productoCompra.*.cantidad.min' => 'La cantidad no puede ser negativa.',
            'productoCompra.*.cantidad.integer' => 'La cantidad solo puede ser numero entero.',
        ];
    }

    protected function prepareForValidation()
    {
        $numero_compra = $this->input('numero_compra');
        if($this->method() == 'POST'){
            $existe = Compra::where('numero_compra', $this->numero_compra)
                ->first();
            if($existe){
                $numero_compra = Compra::max('numero_compra')+1;
            }
        }
        $this->merge([
            'numero_compra' => $numero_compra,
        ]);
    }
}
