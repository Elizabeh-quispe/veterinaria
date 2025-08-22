<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;


class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Mascota::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom_mascota' => 'required|max:100',
            'raza' => 'required|max:100',
            'edad' => 'required|integer|min:0',
            'color' => 'required|max:30',
            'id_propietario' => 'required|exists:propietario,id_propietario'
        ]);

        $mascota = Mascota::create($request->all());

        return response()->json([
            'mensaje' => 'Mascota creada exitosamente',
            'mascota' => $mascota
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $mascota = Mascota::find($id);

        if (!$mascota) {
            return response()->json(['mensaje' => 'Mascota no encontrada'], 404);
        }

        return response()->json($mascota, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $mascota = Mascota::find($id);

        if (!$mascota) {
            return response()->json(['mensaje' => 'Mascota no encontrada'], 404);
        }

        $request->validate([
            'nom_mascota' => 'required|max:100',
            'raza' => 'required|max:100',
            'edad' => 'required|integer|min:0',
            'color' => 'required|max:30',
            'id_propietario' => 'required|exists:propietario,id_propietario'
        ]);

        $mascota->update($request->all());

        return response()->json([
            'mensaje' => 'Mascota actualizada exitosamente',
            'mascota' => $mascota
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mascota = Mascota::find($id);

        if (!$mascota) {
            return response()->json(['mensaje' => 'Mascota no encontrada'], 404);
        }

        $mascota->delete();

        return response()->json(['mensaje' => 'Mascota eliminada exitosamente'], 200);
    }
}
