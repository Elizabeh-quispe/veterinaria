<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;


class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Cita::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'servicio' => 'required|max:100',
        ]);

        $cita = Cita::create($request->all());

        return response()->json([
            'mensaje' => 'Cita creada exitosamente',
            'cita' => $cita
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $request->validate([
            'id_mascota' => 'required|exists:mascota,id_mascota',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'servicio' => 'required|max:100',
        ]);

        $cita->update($request->all());

        return response()->json([
            'mensaje' => 'Cita actualizada exitosamente',
            'cita' => $cita
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $cita->delete();

        return response()->json(['mensaje' => 'Cita eliminada exitosamente'], 200);
    }
}