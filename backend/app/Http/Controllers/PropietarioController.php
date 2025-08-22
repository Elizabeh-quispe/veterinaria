<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propietario;


class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Propietario::all());
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validaciones para formulario
    $request->validate([
        'nombre' => 'required|max:100',
        'apellido_p' => 'required|max:100',
        'apellido_m' => 'required|max:100',
        'ci' => 'required|max:20',
        'telefono' => 'required|max:20',
        'direccion' => 'required|max:100',

    ]);

    $propietario = Propietario::create([
        'nombre' => $request->nombre,
        'apellido_p' => $request->apellido_p,
        'apellido_m' => $request->apellido_m,
        'ci' => $request->ci,
        'telefono' => $request->telefono,
        'direccion' => $request->direccion, // 🔹 valor temporal
    ]);

    return response()->json([
        'mensaje' => 'Propietario creado exitosamente',
        'propietario' => $propietario
    ], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $propietario = Propietario::find($id);

        if (!$propietario) {
            return response()->json(['mensaje' => 'Propietario no encontrado'], 404);
        }

        return response()->json($propietario, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $propietario = Propietario::find($id);

        if (!$propietario) {
            return response()->json(['mensaje' => 'Propietario no encontrado'], 404);
        }

        $request->validate([
             'nombre' => 'required|max:100',
        'apellido_p' => 'required|max:100',
        'apellido_m' => 'required|max:100',
        'ci' => 'required|max:20',
        'telefono' => 'required|max:20',
        'direccion' => 'required|max:100',

        ]);

        $propietario->update($request->all());

        return response()->json([
            'mensaje' => 'Propietario actualizado exitosamente',
            'propietario' => $propietario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $propietario = Propietario::find($id);

        if (!$propietario) {
            return response()->json(['mensaje' => 'Propietario no encontrado'], 404);
        }

        $propietario->delete();

        return response()->json(['mensaje' => 'Propietario eliminado exitosamente'], 200);
    
    }
}
