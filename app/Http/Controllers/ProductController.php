<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Product;
use App\Models\Localisation;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($refId)
    {
        $product = Product::where('refId', $refId)->get();
        $stocks = Stock::where('refId', $refId)->first();

        return view('product.show', compact('product', 'stocks'));
    }

    public function create()
    {
        $localisations = Localisation::all();
        $affectations = Affectation::all();
        return view('product.create', compact('localisations','affectations'));
    }

    public function store(Request $request)
    {
       $request->validate([
            'refid' => 'required|min:2',
            'modele' =>'required',
            'type' =>'required',
            'fabricant' =>'required|min:2',
            'quantite' =>'required',
            'provenance' =>'required',
            'date_designation' =>'required'

        ]);



        $stocks = Stock::where('refId', $request->refid)->first();
        if($stocks){
            if($request->designation == "entree"){
                $quantite = ((int)$stocks->quantite + (int)$request->quantite);
                $entree = ((int)$stocks->entree + (int)$request->quantite);
                $sortie = (int) $stocks->sortie;
            }
            elseif($request->designation == "sortie"){
                $quantite = ((int)$stocks->quantite - (int)$request->quantite);
                $entree = (int) $stocks->entree;
                $sortie = ((int)$stocks->sortie + (int)$request->quantite);
            }
            /*else{$quantite = $request->quantite;}*/
            if($quantite > 0){
                Stock::where('refId', $request->refid)
                            ->update(['quantite' => $quantite,
                                      'entree' => $entree,
                                      'sortie' => $sortie
                        ]);
            }
        }
        else{

            if($request->designation == "entree"){
                $entree = ((int)$request->quantite);
                $sortie = 0;
            }
            elseif($request->designation == "sortie"){
                $sortie = ((int)$request->quantite);
                $entree = 0;
            }

            Stock::create([
                'refId' => $request->refid,
                'modele' =>$request->modele,
                'type' =>$request->type,
                'fabricant' =>$request->fabricant,
                'entree' =>$entree,
                'sortie' =>$sortie,
                'quantite' =>$request->quantite
            ]);
        }

        Product::create([
            'refid' => $request->refid,
            'localisation_id' =>$request->localisation,
            'affectation_id' =>$request->affectation,
            'modele' =>$request->modele,
            'emplacement' =>$request->emplacement,
            'type' =>$request->type,
            'fabricant' =>$request->fabricant,
            'etat' =>$request->etat,
            'quantite' =>$request->quantite,
            'designation' =>$request->designation,
            'emplacement' =>$request->emplacement,
            'provenance' =>$request->provenance,
            'date_designation' =>$request->date_designation
        ]);


        return redirect()->route('dashboard');

    }

    public function edit($id)
    {
        $localisations = Localisation::all();
        $affectations = Affectation::all();
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product', 'localisations', 'affectations'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $stocks = Stock::where('refId', $request->refid)->first();

        $product->update([
            'refid' => $request->refid,
            'localisation_id' =>$request->localisation,
            'affectation_id' =>$request->affectation,
            'modele' =>$request->modele,
            'emplacement' =>$request->emplacement,
            'type' =>$request->type,
            'fabricant' =>$request->fabricant,
            'etat' =>$request->etat,
            'quantite' =>$request->quantite,
            'designation' =>$request->designation,
            'emplacement' =>$request->emplacement,
            'provenance' =>$request->provenance,
            'date_designation' =>$request->date_designation
        ]);

        $products = Product::where('refId', $request->refid)->get();
        $quantite = 0;
        $sortie = 0;
        $entree = 0;

        foreach ($products as $pdt)
        {
            if($pdt->designation == "entree")
                $entree += $pdt->quantite;
            elseif($pdt->designation == "sortie")
                $sortie += $pdt->quantite;
        }
        $quantite += (int)$entree - (int)$sortie;

        Stock::where('refId', $request->refid)
        ->update(['quantite' => $quantite,
                  'entree' => $entree,
                  'sortie' => $sortie
        ]);


        return redirect()->route('product.show', $product->refId);

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $stock = Stock::where('refId', $product->refId)->first();
        $quantite = 0;
        $sortie = 0;
        $entree = 0;

        if($product->designation == "entree"){
            $e = $product->quantite;
            $entree += $stock->entree - $e;
            $sortie = $stock->sortie;
        }
        elseif($product->designation == "sortie"){
            $s = $product->quantite;
            $sortie += $stock->sortie - $s;
            $entree = $stock->entree;
        }
        $quantite += (int)$entree - (int)$sortie;

        if($entree == 0 && $sortie == 0)
        {
            $stock->delete();
        }
        else{
            Stock::where('refId', $product->refId)
            ->update(['quantite' => (int)$quantite,
                      'entree' => (int)$entree,
                      'sortie' => (int)$sortie
            ]);
        }

        $product->delete();
        return redirect()->route('dashboard');
    }

}
