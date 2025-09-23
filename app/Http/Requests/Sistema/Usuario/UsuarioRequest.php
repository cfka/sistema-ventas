<?php

namespace App\Http\Requests\Sistema\Usuario;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'email' => $this->isMethod('post') ? 'required|min:6' : 'nullable|min:6',
            'password' => $this->isMethod('post') ? 'required|min:6' : 'nullable|min:6',
            'rol' => 'required|exists:roles,name', 
        ];
    }
}
