<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AudifonoRequest extends FormRequest
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
			// 'nombre' => 'required|string',
'ci' => 'required',
			// 'cargo' => 'required|string',
			// 'celular' => 'required|string',
			// 'cod_gamea' => 'required|string',
			// 'tecnico' => '',
			// 'cod_registro' => '',
			'fecha' => 'required',
			// 'fecha_inicio' => '',
			// 'marca' => 'required|string',
			// 'modelo' => '',
			// 'falla' => 'required|string',
			// 'observaciones' => '',
			// 'dependencia_id' => 'required|select',
			// 'estado_id' => 'required|string',

        ];
    }

}
