<?php

namespace App\Http\Requests\Sistema\Producto;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'email' => 'max:255',
            'telefono' => 'max:255',
            'direccion' => 'max:255',
        ];
    }
}
