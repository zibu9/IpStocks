<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\Cast\Double;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function localisation()
    {
        return $this->belongsTo(Localisation::class);
    }

    public function getStocks($refId)
    {
        $entree = DB::table('products')->where('refId', $refId)
                                    ->where('designation', 'entree')
                                    ->sum('quantite');

        $sortie = DB::table('products')->where('refId', $refId)
                                       ->where('designation', 'sortie')
                                       ->sum('quantite');
        return (((double)$entree) - ((double)$sortie)) ;
    }


}
