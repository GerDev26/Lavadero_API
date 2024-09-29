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
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class AppointmentController extends Controller
{
    public function userAppointments(){
        $user = Auth::user();

        $appointments = Appointment::where('user_id', $user->id)->get();
        return response()->json(AppointmentResource::collection($appointments), 200);
    }

    public function getAllDates()
    {
        $appointments = Appointment::select('date')->distinct()->where('state', 'Disponible')->get();
        $dates = $appointments->map(function ($appointment) {
            $date = Carbon::parse($appointment->date);
            return [
                'date' => $date->format('d-m-Y'),
                'day' => $date->format('j'),
                'day_name' => $date->format('l'),
                'month_name' => $date->format('F')
            ];
        });
        return response()->json($dates);
    }


    public function getAllAppointments(Request $request){
        $date = $request->query('date');
        if($date){
            $appointments = Appointment::where('date', $date)->get();
        } else {
            $appointments = Appointment::all();
        }
        return AppointmentResource::collection($appointments);
    }

    public function listDatesWithAppointments()
    {
        $appointments = Appointment::with('service', 'user', 'vehicle', 'dates')->get();
        $formattedAppointments = AppointmentResource::collection($appointments);
    
        return response()->json($formattedAppointments, 200);
    }

    public function adminStore(StoreAppointmentRequest $request)
    {
        $date = Carbon::parse($request->date);

        $newAppointment = Appointment::create([
            'date' => $date->format('Y-m-d'),
            'hour' => $request->hour,
            'user_id' => $request->user_id,
            'vehicle_id' => $request->vehicle_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'state' => $request->state ?? 'Disponible',
        ]);
        return response()->json(new AppointmentResource($newAppointment), 201);
    }

    public function Destroy($id){
        $user = Auth::user();

        $appointment = Appointment::find($id);

        if(!$appointment) {
            return response()->json(['error' => 'No existe un turno con ese id'], 400);
        }

        switch ($user->role->description) {
            case 'administrador':
                $isDeleted = $appointment->delete();

                if(!$isDeleted){
                    return response()->json(['error' => 'No se pudo eliminar'], 400);
                }

                return response()->json(['message' => 'Se elimino con exito'], 200);
            case 'empleado' || 'cliente':
                return response()->json(['error' => 'No estas autorizado'], 403);
                
            default:
                return response()->json(['error' => 'Rol inexistente'], 400);
        }
    }

    public function Release($id){
        $user = Auth::user();

        $appointment = Appointment::find($id);

        if(!$appointment) {
            return response()->json(['error' => 'No existe un turno con ese id'], 400);
        }

        switch ($user->role->description) {
            case 'administrador' || 'empleado':
                
                switch ($appointment->state) {
                    case 'Disponible':
                        return response()->json(['error' => 'Ese turno ya esta disponible'], 400);
                    case 'Reservado':
                        $appointment->release();
                        break;
                    case 'Completo':
                        $appointment->state = 'Reservado';
                        break;
                    
                    default:
                        return response()->json(['error' => 'Estado del turno no valido'], 400);
                        break;
                }

                $isSaved = $appointment->save();

                if(!$isSaved){
                    return response()->json(['error' => 'No se pudo guardar'], 400);
                }

                return response()->json(new AppointmentResource($appointment), 200);

            case 'cliente':

                if($appointment->user_id != $user->id) {
                    return response()->json(['error' => 'Este turno no te pertenece'], 401);
                }

                if($appointment->state === 'Completo') {
                    return response()->json(['error' => 'No puedes liberar un turno ya completo'], 401);
                }

                $appointment->release();
                $isSaved = $appointment->save();

                if(!$isSaved){
                    return response()->json(['error' => 'No se pudo guardar'], 400);
                }

                return response()->json(new AppointmentResource($appointment), 200);
            
            default:
                return response()->json(['error' => 'No definido'], 400);
                break;
        }
    }
    public function Complete($id){
        $user = Auth::user();

        $appointment = Appointment::find($id);

        if(!$appointment) {
            return response()->json(['error' => 'No existe un turno con ese id'], 400);
        }

        switch ($user->role->description) {
            case 'administrador' || 'empleado':

                if($appointment->state === 'Completo') {
                    return response()->json(['error' => 'Ese turno ya esta Completo'], 400);
                }
                
                if($appointment->state === 'Disponible') {
                    return response()->json(['error' => 'No puedes completar un turno disponible'], 400);
                }

                $appointment->state = 'Completo';
                $isSaved = $appointment->save();

                if(!$isSaved){
                    return response()->json(['error' => 'No se pudo guardar'], 400);
                }

                return response()->json(new AppointmentResource($appointment), 200);

            case 'cliente':
                return response()->json(['error' => 'No estas autorizado'], 403);
            default:
                return response()->json(['error' => 'No definido'], 400);
                break;
        }
    }

    public function getAppointmentsByDate($date)
    {

        $date = Carbon::parse($date);
        $formattedDate = $date->format('Y-m-d');
        $appointments = Appointment::where('date', $formattedDate)->where('state', 'Disponible')->get();

        return response()->json(AppointmentResource::collection($appointments));
    }
}