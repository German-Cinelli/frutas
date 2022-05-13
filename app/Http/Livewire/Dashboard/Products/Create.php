<?php

namespace App\Http\Livewire\Dashboard\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Product;
use App\Category;

class Create extends Component
{
    use WithFileUploads;
    public $category_id = 1;
    public $name;
    public $file;

    public function render()
    {
        $categories = Category::all();
        return view('livewire.dashboard.products.create', compact('categories'));
    }

    /**
     * Crear un nuevo producto
     */
    public function store(){
        $this->validate([
            'category_id' => 'required',
            'name' => 'required'
        ]);

        $image = null;
        if(!empty($this->file)){
            $image = $this->file->store('products');
        }
        
        
        Product::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'image' => $image
        ]);

        $this->default();
        $this->emit('productCreated');
        $this->notification('success', 'Producto ingresado');
    }


    /**
     * Método para limpiar todos los campos
     */
    Public function default(){
        $this->reset([
            'category_id',
            'name',
            'image',
        ]);
    }


    /**
     * Notifications
     */
    public function notification($type, $message){
        switch ($type) {
            case 'success':
                $this->dispatchBrowserEvent('alert-success', [
                    'message' => $message
                ]);
                break;

            case 'warning':
                $this->dispatchBrowserEvent('alert-warning', [
                    'message' => $message
                ]);
                break;

            case 'error':
                $this->dispatchBrowserEvent('alert-error', [
                    'message' => $message
                ]);
                break;

            case 'info':
                $this->dispatchBrowserEvent('alert-info', [
                    'message' => $message
                ]);
                break;
            
            default:
                $this->dispatchBrowserEvent('alert-success', [
                    'message' => 'Algo salió mal, por favor recargue nuevamente la página.'
                ]);
                break;
        }
    }
    
}
