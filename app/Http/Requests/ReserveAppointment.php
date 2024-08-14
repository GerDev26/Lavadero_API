<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveAppointment extends FormRequest
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
            'id' => 'required|integer|min:1|exists:appointments,id',
            'user_id' => 'required|integer|min:1|exists:users,id|exists:vehicles,user_id',
            'service_id' => 'required|integer|min:1|exists:services,id',
            'vehicle_id' => 'required|integer|min:1|exists:vehicles,id',
        ];
    }
}
