<?php

namespace App\Http\Controllers;

use App\Models\Ac;

class DashboardController extends Controller
{
    public function index()
    {
        // Carregar todas as ACs e suas respectivas AC N2 e ARs
        $acs = Ac::with('acN2.ars')->get();

        return view('dashboard', compact('acs'));
    }
}
