<?php

namespace App\Http\Requests;

use App\Http\Resources\ApiResponseResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAppointmentRequest extends FormRequest
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
            'price' => 'sometimes|numeric',
            'user_id' => 'sometimes|integer|min:1|exists:users,id|exists:vehicles,user_id',
            'service_id' => 'sometimes|integer|min:1|exists:services,id',
            'vehicle_id' => 'sometimes|integer|min:1|exists:vehicles,id',
            'date' => 'required',
            'hour' => 'required',
        ];
    }
}
