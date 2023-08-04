<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Product extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.product');
    }
}
