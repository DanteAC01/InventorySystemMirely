<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use Carbon\Carbon;


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

        $late = Movement::where('type', 'salida')->whereDate('date_return', '<', Carbon::today())->count();

        return view('home', compact('movimientos', 'late'));
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
