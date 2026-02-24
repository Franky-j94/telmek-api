<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudesRequest extends FormRequest
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
            //'user_id' => 'required',
            'nombre_solicitante' => 'required',
            'paterno_solicitante' => 'required',
            'materno_solicitante' => 'required',
            'activo' => 'required',
            //'fecha_solicitud' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            //'user_id.required' => 'El usuario es requerido',
            'nombre_solicitante.required' => 'El nombre del solicitante es requerido',
            'paterno_solicitante.required' => 'El apellido paterno del solicitante es requerido',
            'materno_solicitante.required' => 'El apellido materno del solicitante es requerido',
            'activo.required' => 'El campo activo es requerido',
            //'fecha_solicitud.required' => 'La fecha de solicitud es requerida'
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
