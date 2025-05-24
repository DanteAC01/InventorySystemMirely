<?php

namespace App\Http\Controllers;
use App\Models\Area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $classroomDataList = Area::all();
        return view('classroom.index', compact('classroomDataList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Area::create($validated);

        // Redireccionar con mensaje de éxito
        return redirect()->route('classroomList')->with('success', 'Área creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Area::findOrFail($id); // Lanza 404 si no encuentra el registro

        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Buscar y actualizar
        $classroom = Area::findOrFail($id);
        $classroom->nombre = $request->input('nombre');
        $classroom->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('classroomList')->with('success', 'Aula actualizada correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->route('classroomList')->with('success', 'Aula eliminada correctamente.');
    }
}
