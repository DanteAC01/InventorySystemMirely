<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movimientos = Movement::with(['originSector', 'destinationSector', 'movementDetails'])
            ->orderBy('id', 'asc')
            ->get();
        // var_dump($movimientos); 
        return view('home', compact('movimientos'));
    }

    public function markAsReturned($id)
    {
        $movement = Movement::findOrFail($id);

        if ($movement->type === 'salida') {
            $movement->type = 'entrada';
            $movement->save();
        }

        return redirect()->back()->with('success', 'Material marcado como devuelto.');
    }
}
