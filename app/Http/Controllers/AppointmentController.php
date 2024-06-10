<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function getAll(){
        return Appointment::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation Error',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            $appointment = Appointment::create([
                'price' => $request->price
            ]);

            if (!$appointment) {
                throw new Exception('No se completó la operación', 402);
            }

            return response()->json($appointment, 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Exception Error',
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }
}
