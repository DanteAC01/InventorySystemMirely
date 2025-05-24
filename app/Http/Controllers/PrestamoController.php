<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Material;
use App\Models\Alumno;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae todos los préstamos con las relaciones cargadas
        $loansDataList = Prestamo::with(['user', 'alumno', 'material.area'])->get();

        // Retorna la vista y pasa los datos   
        return view('loans.index', compact('loansDataList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        $materialsData = Material::all();
        $classroomsData = Area::all(); // Agregamos las áreas
        $AlumnosData = Alumno::all();

        return view('loans.create', compact('materialsData', 'classroomsData','users','AlumnosData'));
    }
    
    public function materialsByClassroom($classroom)
    {
        $materials = Material::where('area_id', $classroom)->get();
        return response()->json($materials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'material_id' => 'required|exists:materials,id',
            'area_id' => 'required|exists:areas,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|in:prestado,devuelto,pendiente,perdida',
            'observaciones' => 'nullable|string',
        ]);

        $material = \App\Models\Material::findOrFail($validated['material_id']);

        if ((int)$validated['cantidad'] > (int)$material->cantidad_disponible) {
            return back()->withErrors(['cantidad' => 'No hay suficiente cantidad disponible.']);
        }

        // Descontar cantidad
        $material->cantidad_disponible -= $validated['cantidad'];
        $material->save();

        $validated['user_id'] = Auth::id();

        Prestamo::create($validated);
        
        return redirect()->route('loanList')->with('success', 'Préstamo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $loan = Prestamo::findOrFail($id);
        $AlumnosData = Alumno::all();
        $classroomsData = Area::all();

        return view('loans.edit', compact('loan', 'AlumnosData', 'classroomsData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'material_id' => 'required|exists:materials,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
        ]);

        $loan = Prestamo::findOrFail($id);
        $loan->update($request->all());

        return redirect()->route('loanList')->with('success', 'Préstamo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamos)
    {
        //
    }
}
