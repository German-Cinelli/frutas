<?php

namespace App\Http\Livewire\Dashboard\Categories;

use Livewire\Component;

use App\Category;

class Create extends Component
{

    public $name;

    public function render()
    {
        return view('livewire.dashboard.categories.create');
    }

    /**
     * Crear un nuevo producto
     */
    public function store(){
        Category::create([
            'name' => $this->name
        ]);

        $this->default();
        $this->emit('categoryCreated');
        $this->notification('success', 'Categoría ingresada');
    }


    /**
     * Método para limpiar todos los campos
     */
    Public function default(){
        $this->reset([
            'name'
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
