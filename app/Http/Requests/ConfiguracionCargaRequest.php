<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionCargaRequest extends FormRequest
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
            'proporcion' => 'required|integer',
            'diferencia' => 'required|integer',
            'anio' => 'required|integer',
            'activo' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'proporcion.required' => 'El campo proporcion es obligatorio.',
            'proporcion.integer' => 'El campo proporcion debe ser un número entero.',

            'diferencia.required' => 'El campo diferencia es obligatorio.',
            'diferencia.integer' => 'El campo diferencia debe ser un número entero.',

            'anio.required' => 'El campo año es obligatorio.',
            'anio.integer' => 'El campo año debe ser un número entero.',

            'activo.required' => 'El campo activo es obligatorio.',
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422, [], JSON_UNESCAPED_UNICODE)
        );
    }
}
