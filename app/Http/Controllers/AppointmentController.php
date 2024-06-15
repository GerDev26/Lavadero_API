<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function getAll()
    {
        $appointments = Appointment::with('service', 'user', 'vehicle')->get();
        $formattedAppointments = AppointmentResource::collection($appointments);
        
        $response = new ApiResponseResource([
            'success' => true,
            'message' => 'Showing all appointments',
            'data' => $formattedAppointments,
        ]);
    
        return response()->json($response, 200);
    }

    public function store(StoreAppointmentRequest $request)
    {   
        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'vehicle_id' => $request->vehicle_id,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
        ]);
        $formattedAppointment = new AppointmentResource($appointment);

        $response =  new ApiResponseResource([
            'success' => true,
            'message' => 'Ok',
            'data' => $formattedAppointment
        ]);

        return response()->json($response, 201);
    }
}