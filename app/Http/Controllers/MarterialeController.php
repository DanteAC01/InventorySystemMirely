<?php

namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Area;

use Illuminate\Http\Request;

class MarterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classroomDataMaterial = Area::withCount('materiales')->get(); // asumiendo relación 'materiales'

        return view('material.index', compact('classroomDataMaterial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $classroomData = Area::all();

        return view('material.create', compact('classroomData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'total' => 'required|integer|min:0',
            'estado' => 'required|in:nuevo,usado,deteriorado,en reparación,dado de baja',
            'fecha_ingreso' => 'required|date',
            'area_id' => 'required|exists:areas,id',
        ]);

        $validated['cantidad_disponible'] = $validated['total'];
        Material::create($validated);


        return redirect()->route('materialList')->with('success', 'Material registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Carga el área con todos sus materiales relacionados
        $va = Area::with('materiales.area')->findOrFail($id); // también cargamos la relación inversa 'area'

        $areaNombre = $va->nombre;

        return view('material.show', compact('va', 'areaNombre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $material = Material::findOrFail($id);
        $classroomData = Area::all();
        
        return view('material.edit', compact('material','classroomData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validUpdate = $request->validate([
            'nombre' => 'required|string|max:255',
            'total' => 'required|integer|min:0',
            'estado' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'descripcion' => 'required|string',
            'area_id' => 'required|exists:areas,id',
        ]);
        
        $validUpdate['cantidad_disponible'] = $validUpdate['total'];

        $material = Material::findOrFail($id);
        $material->update($validUpdate);



        return redirect()->route('materialList')->with('success', 'Material actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
