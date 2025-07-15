<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Material;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Models\MovementDetail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movementDataList = Movement::with(['user', 'movementDetails.material.sector'])->get();

        return view('loans.index', compact('movementDataList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $materialsData = Material::all();
        $sectorsData = Sector::all(); // Agregamos las áreas

        return view('loans.create', compact('materialsData', 'sectorsData'));
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
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_devolucion',
            'destinationSector' => 'required|exists:sectors,id',
            'materials_json' => 'required|json',
        ]);

        $materials = json_decode($request->materials_json, true);

        if (empty($materials)) {
            return back()->withErrors(['materials_json' => 'Debe añadir al menos un material.']);
        }

        // Usamos el área origen del primer material (puedes modificar esto si necesitas múltiples movimientos por origen)
        $firstMaterial = $materials[0];

        $movement = Movement::create([
            'type' => 'salida',
            'origin_sector_id' => $firstMaterial['area_id'], // primer origen
            'destination_sector_id' => $request->destinationSector,
            'user_id' => auth()->id(),
            'date' => $request->fecha_prestamo,
            'date_return' => $request->fecha_devolucion,
        ]);

        foreach ($materials as $material) {
            MovementDetail::create([
                'movement_id' => $movement->id,
                'material_id' => $material['material_id'],
                'quantity' => $material['cantidad'],
                'status' => $material['estado'],
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
        $movement = Movement::findOrFail($id);
        $sectorsData = Sector::all();
        $materials = Material::all();

        // Formatear la fecha
        $date = Carbon::parse($movement->date)->format('Y-m-d');
        $dateReturn = Carbon::parse($movement->date_return)->format('Y-m-d');

        $movementDetails = $movement->movementDetails->map(function ($detail) {
            return [
                'material_id' => $detail->material_id,
                'material_nombre' => $detail->material->name ?? 'Sin nombre',
                'quantity' => $detail->quantity,
                'status' => $detail->status,
            ];
        });

        $originArea = Sector::find($movement->origin_sector_id);
        $originAreaID = $originArea->id ;
        $originAreaName = $originArea ? $originArea->name : 'Área desconocida';

        return view('loans.edit', compact('movement', 'sectorsData', 'materials', 'movementDetails', 'date', 'dateReturn','originAreaID', 'originAreaName'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_prestamo',
            'origin_sector_id' => 'required|exists:sectors,id',
            'destinationSector' => 'required|exists:sectors,id',
            'materials_json' => 'required|json',
        ]);

        $materials = json_decode($request->materials_json, true);

        if (empty($materials)) {
            return back()->withErrors(['materials_json' => 'At least one material must be added.'])->withInput();
        }

        foreach ($materials as $material) {
            Validator::make($material, [
                'material_id' => 'required|exists:materials,id',
                'quantity' => 'required|integer|min:1',
                'statusCell' => 'required|string|in:Reparación,Traslado,Reparacion',
            ])->validate();
        }

        $movement = Movement::findOrFail($id);

        $firstMaterial = $materials[0];

        $movement->update([
            'type' => 'salida',
            'origin_sector_id' => $request->origin_sector_id,
            'destination_sector_id' => $request->destinationSector,
            'user_id' => auth()->id(),
            'date' => $request->fecha_prestamo,
            'date_return' => $request->fecha_devolucion,
        ]);

        $movement->movementDetails ()->delete();

        foreach ($materials as $material) {
            MovementDetail::create([
                'movement_id' => $movement->id,
                'material_id' => $material['material_id'],
                'quantity' => $material['quantity'],
                'status' => $material['statusCell'],
            ]);
        }

        return redirect()->route('loanList')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($transferid)
    {
        $traslado = Movement::findOrFail($transferid);
        $traslado->movementDetails()->delete();
        $traslado->delete();

        return redirect()->route('loanList')->with('success', 'Movimiento eliminado correctamente.');
    }
}
