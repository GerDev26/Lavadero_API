<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function getAll()
    {
        $appointments = Appointment::with('service', 'user', 'vehicle')->get();
        $formattedAppointments = AppointmentResource::collection($appointments);
        
        $response = new ApiResponseResource([
            'data' => $formattedAppointments,
            'success' => true,
            'message' => 'Showing all appointments',
        ]);
    
        return response()->json($response, 200);
    }

    public function store(StoreAppointmentRequest $request)
    {   
        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'vehicle_id' => $request->vehicle_id,
            'price' => $request->price
        ]);

        $formattedAppointment = new AppointmentResource($appointment);
        return response()->json($formattedAppointment, 201);
    }
}