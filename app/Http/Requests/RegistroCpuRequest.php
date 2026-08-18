<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroCpuRequest extends FormRequest
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
			// 'nombre' => 'string',
			// 'ci' => 'string',
			// 'cargo' => 'string',
			//'celular' => 'string',
			//'usuario' => 'string',
			// 'contrasena' => 'string',
			'cod_gamea' => 'string',
			// 'cod_registro' => 'string',
			// 'tecnico' => 'string',
			'falla' => 'string',
			// 'respaldo' => 'string',
			// 'observaciones' => 'string',
			// 'otro' => 'string',
        ];
    }
    
}
