<?php

namespace App\Http\Controllers;
use App\Models\Materiales;
use App\Models\Areas;

use Illuminate\Http\Request;

class MarterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Areas::withCount('materiales')->get(); // asumiendo relación 'materiales'

        return view('materiale.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $areas = Areas::all();

        return view('materiale.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'area_id' => 'required|exists:areas,id',
        ]);

        Materiales::create($request->all());

        return redirect()->route('materialeList')->with('success', 'Material registrado correctamente.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
