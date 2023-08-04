<?php

namespace App\Http\Controllers;

use App\Models\Localisation;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class LocalisationController extends Controller
{
    public function index()
    {
        $localisations = Localisation::all();
        return view('localisation.home', compact('localisations'));
    }

    public function create()
    {
        return view('localisation.create');
    }

    public function store(Request $request)
    {
        $localisations = Localisation::all();
        $c = count($localisations);
        $a = (int)$c + 1;
        Localisation::create([
            'content' => 'WAREHOUSE_'.$a,
            'etagere' => $request->etagere
        ]);

        return redirect()->route('location');
    }
}
