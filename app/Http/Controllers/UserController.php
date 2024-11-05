<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAll()
    {
        return User::with('role')->whereIn('role_id', [2, 3])->get();
    }
    public function getAllRoles(){
        return Role::all();
    }
    public function checkRole() {
        return response()->json(['role' => Auth::user()->role->description], 200);
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

        $user->load('role');

        return response()->json($user, 201);
    }
    public function Destroy($id)
    {
        if(Auth::user()->id == $id) return response()->json(['error' => 'No puedes eliminarte a ti mismo'], 400);
        
        $isDeleted = User::destroy($id);
        $message = $isDeleted ? "Se elimino el registro con exito" : "Error al eliminar el registro";
        return response()->json(['message' => $message]);
    }
    public function Update($id, UpdateUserRequest $request){

        $user = User::find($id);

        if(!$user) return response()->json(['error' => 'No existe un usuario con ese id'], 400);
        
        $dataToUpdate = array_filter($request->only(['name', 'surname', 'phone_number', 'email', 'role_id']));
        $isUpdated = $user->update($dataToUpdate);

        if(!$isUpdated){
            response()->json(['error' => 'Error al actualizar'], 400);
        }
        return response()->json($user, 200);
    }
    public function getUserVehicles()
    {
        $userId = Auth::user()->id;
        
        $user = User::find($userId);
        if(!$user) {
            return response()->json(['error' => 'El usuario no existe'], 400);
        }

        $vehicles = Vehicle::where('user_id', $userId,)->where('state', true)->get();

        $formattedVehicles = VehicleResource::collection($vehicles);
        return response()->json($formattedVehicles);
    }
}
