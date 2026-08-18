<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaptopRequest extends FormRequest
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
			// 'usuario' => 'string',
			// 'contrasena' => 'string',
			// 'cod_gamea' => 'string',
			// 'cod_registro' => 'string',
			// 'marca' => 'string',
			// 'modelo' => 'string',
			// 'falla' => 'string',
			// 'respaldo' => 'string',
			// 'observaciones' => 'string',
			// 'otro' => 'string',
			// 'boton_oculto' => 'required',
			// 'funcionario_activo' => 'required',
        ];
    }
}
