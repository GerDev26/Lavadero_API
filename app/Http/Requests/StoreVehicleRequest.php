<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreVehicleRequest extends FormRequest
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
        $userRole = Auth::user()->role->description;

        $generalValidations = [
            'vehicleDomain' => 'required|string|min:7|max:7',
            'vehicleType' => 'required|integer|min:1|exists:type_of_vehicles,id',
        ];
        
        switch ($userRole) {
            case 'administrador':
                return array_merge($generalValidations, [
                    'user_id' => 'required|integer|min:1|exists:users,id',
                ]);
            
            case 'empleado':
                return $generalValidations;

            case 'cliente':
                return $generalValidations;

            default:
                throw new HttpResponseException(response()->json([
                    'error' => 'Rol inexistente',
                ], 403));
        }
    }
}
