<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function index()
    {
        $affectations = Affectation::all();
        return view('affectation.home', compact('affectations'));
    }
}
