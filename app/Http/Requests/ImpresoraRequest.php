<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpresoraRequest extends FormRequest
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
			'nombre' => '',
			'ci' => '',
			'cargo' => '',
			'celular' => '',
			'cod_gamea' => '',
			'tecnico' => '',
			'cod_registro' => '',
			'fecha' => '',
			'fecha_inicio' => '',
			'marca' => '',
			'modelo' => '',
			'falla' => '',
			'observaciones' => '',
			'dependencia_id' => '',
			'estado_id' => '',
        ];
    }

}
