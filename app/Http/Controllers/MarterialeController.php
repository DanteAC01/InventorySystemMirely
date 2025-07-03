<?php

namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Sector;

use Illuminate\Http\Request;

class MarterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectorDataMaterial = Sector::withCount('materials')->get(); // asumiendo relación 'materiales'

        return view('material.index', compact('sectorDataMaterial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $sectorData = Sector::all();

        return view('material.create', compact('sectorData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'statusMaterial' => 'required|in:nuevo,usado,deteriorado,en reparación,dado de baja',
            'dateEntry' => 'required|date',
            'sectorID' => 'required|exists:sectors,id',
        ]);

        // Mapeo de campos personalizados al modelo
        $validated['status'] = $validated['statusMaterial'];
        $validated['sector_id'] = $validated['sectorID'];
        $validated['quantityAvailable'] = $validated['quantity'];

        // Elimina los campos que no existen en la tabla
        unset($validated['statusMaterial'], $validated['sectorID']);

        Material::create($validated);

        return redirect()->route('materialList')->with('success', 'Material registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Carga el área con todos sus materiales relacionados
        $va = Sector::with('materials.sector')->findOrFail($id); // también cargamos la relación inversa 'area'

        $areaNombre = $va->nombre;

        return view('material.show', compact('va', 'areaNombre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = Material::findOrFail($id);
        $sectorData = Sector::all();
        
        return view('material.edit', compact('material','sectorData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validUpdate = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string',
            'dateEntry' => 'required|date',
            'description' => 'required|string',
            'sector_id' => 'required|exists:sectors,id',
        ]);
        
        $validUpdate['quantityAvailable'] = $validUpdate['quantity'];

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
