<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        $patients = Patient::with('appointments')->get();
        return response()->json($patients);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:Male,Female,Other',
            'contact' => 'required|string|max:20',
            'address' => 'nullable|string',
            'medical_history' => 'nullable|string'
        ]);

        $patient = Patient::create($validated);
        return response()->json($patient, 201);
    }

    public function show(Patient $patient): JsonResponse
    {
        return response()->json($patient->load('appointments'));
    }

    public function update(Request $request, Patient $patient): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'age' => 'integer|min:0',
            'gender' => 'string|in:Male,Female,Other',
            'contact' => 'string|max:20',
            'address' => 'nullable|string',
            'medical_history' => 'nullable|string'
        ]);

        $patient->update($validated);
        return response()->json($patient);
    }

    public function destroy(Patient $patient): JsonResponse
    {
        $patient->delete();
        return response()->json(null, 204);
    }
} 