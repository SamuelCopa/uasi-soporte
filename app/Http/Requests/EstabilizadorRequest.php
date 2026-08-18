<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstabilizadorRequest extends FormRequest
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
			// 'ci' => 'required|string',
			//'cargo' => 'required|string',
			// 'celular' => 'required|string',
			// 'cod_gamea' => 'required|string',
			// 'tecnico' => 'required|string',
			// 'cod_registro' => 'required|string',
			'fecha' => 'required',
			//'fecha_inicio' => 'required',
			'marca' => 'required|string',
			'modelo' => 'required|string',
			'falla' => 'required|string',
			// 'observaciones' => 'required|string',
			// 'dependencia_id' => 'required',
			// 'estado_id' => 'required',
        ];
    }
}
