<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function index(): JsonResponse
    {
        $appointments = Appointment::with('patient')->get();
        return response()->json($appointments);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date',
            'type' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,completed,cancelled,walkin',
            'notes' => 'nullable|string'
        ]);

        $appointment = Appointment::create($validated);
        return response()->json($appointment, 201);
    }

    public function show(Appointment $appointment): JsonResponse
    {
        return response()->json($appointment->load('patient'));
    }

    public function update(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'appointment_date' => 'date',
            'type' => 'string|max:255',
            'status' => 'string|in:scheduled,completed,cancelled,walkin',
            'notes' => 'nullable|string'
        ]);

        $appointment->update($validated);
        return response()->json($appointment);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();
        return response()->json(null, 204);
    }
} 