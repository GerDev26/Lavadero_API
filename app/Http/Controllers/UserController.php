<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\VehicleResource;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAll()
    {
        return User::with('role')->get();
    }
    public function Store(StoreUserRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json($user, 201);
    }
    public function Destroy($id)
    {
        $isDeleted = User::destroy($id);
        $message = $isDeleted ? "Se elimino el registro con exito" : "Error al eliminar el registro";
        return response()->json(['message' => $message]);
    }
    public function getUserVehicles()
    {
        $userId = Auth::user()->id;
        
        $user = User::find($userId);
        
        if(!$user) {
            return response()->json(['error' => 'El usuario no existe'], 400);
        }

        $vehicles = Vehicle::where('user_id', $userId)->get();

        if($vehicles->isEmpty()) {
            return response()->json(['error' => 'El usuario no tiene vehiculos'], 400);
        }

        $formattedVehicles = VehicleResource::collection($vehicles);
        return response()->json($formattedVehicles);
    }
}
