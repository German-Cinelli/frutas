<?php

namespace App\Http\Livewire\Dashboard\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    protected $listeners = ['customerCreated' => 'render'];

    public function render()
    {
        $customers =  User::where('name','like','%'. $this->search . '%')
            ->where('role_id', 2)
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.dashboard.customers.index', compact('customers'));
    }


    /**
     * Método para ordenar los datos en la tabla
     */
    public function order($sort){
        if ($this->sort == $sort) {
            $this->direction = ($this->direction == 'desc' ? 'asc' : 'desc');
        } else {
            $this->sort = $sort;
            $this->direction == 'asc';
        }
    }


    /**
     * Método para eliminar un producto
     */
    public function destroy($product_id){
        $product = Product::find($product_id);

        $delete = $product->delete();

        if($delete){
            $this->notification('success', 'Producto eliminado');
        } else {
            $this->notification('danger', 'Se produjo un error al eliminar el producto');
        }

    }

    /**
     * Método para eliminar un producto
     */
    public function restore($product_id){
        $product = Product::withTrashed()->find($product_id);

        $restore = $product->restore();

        if($restore){
            $this->notification('success', 'Producto restaurado');
        } else {
            $this->notification('danger', 'Se produjo un error al restaurar el producto');
        }
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
            
            default:
                $this->dispatchBrowserEvent('alert-success', [
                    'message' => 'Algo salió mal, por favor recargue nuevamente la página.'
                ]);
                break;
        }
    }
}
