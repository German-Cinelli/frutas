<?php

namespace App\Http\Livewire\Dashboard\Customers;

use Livewire\Component;

use App\User;

class Create extends Component
{

    public $name;
    public $email;
    public $password;
    public $phone = null;

    public function render()
    {
        return view('livewire.dashboard.customers.create');
    }


    /**
     * Crear un nuevo cliente
     */
    public function store(){
        $this->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // Verificamos que el nombre de usuario no exista
        $user_name = User::where('name', $this->name)->first();

        if($user_name){
            $this->notification('warning', 'Ya existe un cliente registrado con ese nombre!');
        } else {
            User::create([
                'role_id' => 2,
                'name' => $this->name,
                'email' => strtolower($this->name) . '@frutasdecalidad.uy',
                'password' => bcrypt($this->password),
                'phone' => $this->phone
        
            ]);
    
            $this->default();
            $this->emit('customerCreated');
            $this->notification('success', 'Cliente ingresado');
        }

        
    }


    /**
     * Método para limpiar todos los campos
     */
    Public function default(){
        $this->reset([
            'name',
            'phone',
            'password'
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
