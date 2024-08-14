<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveAppointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\DateResource;
use App\Models\Appointment;
use App\Models\Date;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getAllDates()
    {
        $dates = Date::all();
        return response()->json($dates);
    }

    public function listDatesWithAppointments()
    {
        $dates = Date::with('appointments')->get();
        $formattedDates = DateResource::collection($dates);
        return response()->json($formattedDates, 200);
        $appointments = Appointment::with('service', 'user', 'vehicle', 'dates')->get();
        $formattedAppointments = AppointmentResource::collection($appointments);
    
        return response()->json($formattedAppointments, 200);
    }

    public function adminStore(StoreAppointmentRequest $request)
    {
        $date = Date::where('date', $request->date)->first();

        $newAppointment = new Appointment();

        $newAppointment->user_id = $request->user_id;
        $newAppointment->vehicle_id = $request->vehicle_id;
        $newAppointment->service_id = $request->service_id;
        $newAppointment->price = $request->price;
        $newAppointment->hour = $request->hour;
        $newAppointment->state = $request->state ?? 'Disponible';

        if($date) {
            $newAppointment->date_id = $date->id;
        } else {
            $newDate = Date::create([
                'date' => $request->date
            ]);
            $newAppointment->date_id = $newDate->id;
        }

        $newAppointment->save();

        $formattedAppointment = new AppointmentResource($newAppointment);

        return response()->json($formattedAppointment, 201);
    }

    public function getAppointmentsByDateId($id)
    {
        $appointments = Appointment::where('date_id', $id)->get();

        return response()->json($appointments);
    }
    public function reserve(ReserveAppointment $request)
    {
        $appointments = Appointment::find($request->id);
        $userVehicles = Vehicle::where('user_id', $request->user_id)->get();

        $userHasRequestVehicle = $userVehicles->has($request->vehicle_id);
        $isAppointmentReserved = $appointments->state === 'Reservado';


        if(!$userHasRequestVehicle){
            return response()->json(['error' => 'El usuario no tiene ese vehiculo'], 400);
        }
        
        if($isAppointmentReserved) {
            return response()->json(['error' => 'El turno ya se reservo'], 400);
        }
        
        $appointments->user_id = $request->user_id;
        $appointments->vehicle_id = $request->vehicle_id;
        $appointments->service_id = $request->service_id;
        $appointments->state = 'Reservado';

        $appointments->save();

        return response()->json(['message' => 'Turno reservado con exito'], 200);
    }
}