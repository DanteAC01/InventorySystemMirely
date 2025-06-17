<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Material;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Models\MovementDetail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trae todos los préstamos con las relaciones cargadas
        $loansDataList = Movement::with(['user', 'alumno', 'prestamoMateriales.materials.sector'])->get();

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
        $sectorsData = Sector::all(); // Agregamos las áreas

        return view('loans.create', compact('materialsData', 'sectorsData','users',));
    }
    
    public function materialsByClassroom($sector)
    {
        $materials = Material::where('sector_id', $sector)->select('id', 'name')->get();
        return response()->json($materials);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'observaciones' => 'nullable|string',
        ]);

        $prestamo = Movement::create([
            'user_id' => Auth::id(),
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion' => $request->fecha_devolucion,
            'observaciones' => $request->observaciones ?? null,
        ]);

        $materials = json_decode($request->materials_json, true);

        foreach ($materials as $material) {
            MovementDetail::create([
                'prestamo_id' => $prestamo->id,
                'material_id' => $material['material_id'],
                'destinationSector' => $material['destinationSector'],
                'cantidad' => $material['cantidad'],
                'estado' => $material['estado'],
            ]);
        }

        return redirect()->route('loanList')->with('success', 'Préstamo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movement $prestamos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($id)
    {
        $loan = Movement::findOrFail($id);
        $classroomsData = Sector::all();
        $materialsData = Material::all();
        $prestamoMaterialData = $loan->prestamoMateriales;
        return view('loans.edit', compact('loan', 'alumnosData', 'classroomsData', 'materialsData', 'prestamoMaterialData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Decodificar el JSON recibido desde el input hidden
       $materiales = json_decode($request->input('materials_json'), true);

        // Validar manualmente los datos principales y los materiales decodificados
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'observaciones' => 'nullable|string',
        ]);

        if (!is_array($materiales) || count($materiales) < 1) {
            return back()->withErrors(['materiales' => 'Debes agregar al menos un material.'])->withInput();
        }

        // Validación personalizada para cada material
        foreach ($materiales as $material) {
            Validator::make($material, [
                'material_id' => 'required|exists:materials,id',
                'area_id' => 'required|exists:areas,id',
                'cantidad' => 'required|integer|min:1',
                'estado' => 'required|string|in:prestado,devuelto,pendiente,perdida',
            ])->validate();
        }

        // Actualizar el préstamo
        $loan = Movement::findOrFail($id);
        $loan->update([
            'alumno_id' => $request->alumno_id,
            'fecha_prestamo' => $request->fecha_prestamo,
            'fecha_devolucion' => $request->fecha_devolucion,
            'observaciones' => $request->observaciones,
        ]);

        // Eliminar materiales anteriores
        $loan->prestamoMateriales()->delete();

        // Crear los nuevos materiales
        foreach ($materiales as $material) {
            MovementDetails::create([
                'prestamo_id' => $loan->id,
                'material_id' => $material['material_id'],
                'area_id' => $material['area_id'],
                'cantidad' => $material['cantidad'],
                'estado' => $material['estado'],
            ]);
        }

        return redirect()->route('loanList')->with('success', 'Préstamo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movement $prestamos)
    {
        //
    }
}
