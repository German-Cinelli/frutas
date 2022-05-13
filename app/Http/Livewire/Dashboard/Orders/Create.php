<?php

namespace App\Http\Livewire\Dashboard\Orders;

use Livewire\Component;
use App\Order;
use App\Product;

class Create extends Component
{
    public $product;

    protected $listeners = [
        'selectedProduct',
    ];

    public function render()
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('livewire.dashboard.orders.create', compact('products'));
    }

    public function hydrate()   {
        $this->emit('select2');
    }

    public function selectedProduct($product_id){
        if($product_id) {
            dd($product_id);
            $this->product = Product::find($item);
            $this->emit('selectedProductId', $this->product->id);
        } else {
            $this->product = null;
        }
    }

}
