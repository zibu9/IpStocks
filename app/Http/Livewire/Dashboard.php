<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{

    public string $query = '';
    public $products = [];
    public int $selectedIndex = 0;
    public $message = "";
    public $searchBy = "";


    public function mount()
    {
        $this->products = Stock::all();

    }

    public function updatedQuery()
    {
        if(strlen($this->query) >= 1){
            if($this->searchBy == ""){
                $words = '%' . $this->query . '%';
                $this->products = Stock::where('refId', 'like', $words)->get();
            }
            elseif($this->searchBy == "Modele"){
                $words = '%' . $this->query . '%';
                $this->products = Stock::where('modele', 'like', $words)->get();
            }
            elseif($this->searchBy == "Type"){
                $words = '%' . $this->query . '%';
                $this->products = Stock::where('type', 'like', $words)->get();
            }
        }
        elseif(strlen($this->query)< 1)
        {
            $this->products = Stock::all();
        }
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
