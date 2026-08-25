<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtrosEquipoRequest extends FormRequest
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
			// 'tipo_equipo_id' => 'required',
			// 'cargo' => 'string',
			// 'cod_gamea' => 'string',
			// 'cod_registro' => 'string',
			// 'marca' => 'string',
			// 'modelo' => 'string',
			// 'falla' => 'string',
			// 'otro' => 'string',
			// 'observaciones' => 'string',
			// 'boton_oculto' => 'required',
			// 'funcionario_activo' => 'required',
        ];
    }
}
