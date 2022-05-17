<?php

namespace App\Http\Livewire\Dashboard\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Order;
use App\Product;
use App\OrderProduct;
use App\Payment;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    /**
     * Ésta propiedad es declarada unicamente con el objetivo de desplegar un modal 
     * cuando el usuario presiona sobre el botón cancelar pedido.
     */
    public $order = null;

    public $input_debito = null;

    protected $listeners = ['cancel', 'concretar', 'debito'];

    public function render()
    {
        /**
         * Consulta que filtra por nombre de producto o nombre de categoría
         */
        $orders =  Order::join('users','orders.user_id','=','users.id')
            ->where('users.name','like','%'. $this->search . '%')
            ->select('orders.*')
            ->orderBy($this->sort, $this->direction)
            ->withTrashed()
            ->paginate(10);

        return view('livewire.dashboard.orders.index', compact('orders'));
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
     * Método que se invoca cuando el usuario presiona sobre el botón de cancelar pedido
     */
    public function cancel_order(Order $order){
        $this->order = $order;
    }


    /**
     * Método para cancelar un pedido
     */
    public function cancel(Order $order){
         // Borramos los items

         foreach($order->items as $item){
            $product = Product::find($item->product_id);
            $product->qty_sold = $product->qty_sold - $item->qty;
            
            $product->save();
            // Borramos el item
            $item->delete();
        }
        
        // Modificamos el estado del pedido
        $order->status_id = 2; // Cancelado
        $order->save();
        
        $this->notification('success', 'El pedido ha sido cancelado');
    }

    /**
     * Método para concretar un pedido
     */
    public function concretar(Order $order){
        $order->status_id = 4; // Concretado

        $save = $order->save();

        if($save){
            $this->notification('success', 'El pedido ha sido concretado');
        } else {
            $this->notification('danger', 'Se produjo un error al concretar el pedido');
        }

       
   }


    public function debito(Order $order){
        $this->order = $order;
    }

    public function confirmarPago(Order $order){

        //Comprobamos antes que nada que el debito de un pedido sea menor o igual al monto del input
        $this->validate([
            'input_debito' => 'required',
        ]);

        /**
         * Comprobamos que el monto ingresado no sea superior a lo que el cliente debe
         */
        if($this->input_debito > $this->order->debt && $this->order->debt != 0){
            $this->notification('warning', 'El monto ingresado no debe ser mayor a la deuda del cliente');
        } else {
            /**
             * Comprobamos que haya pagos anteriores
             */
            if($order->payments->first()){
                $latest_payment = Payment::latest()->first();

                $payment = new Payment();
                $payment->order_id = $this->order->id;
                $payment->payment = $this->input_debito;
                $payment->debito = $latest_payment->debito - $this->input_debito;
                $payment_save = $payment->save();
                
            } else {
                $payment = new Payment();
                $payment->order_id = $this->order->id;
                $payment->payment = $this->input_debito;
                $payment->debito = $order->total - $this->input_debito;
                $payment_save = $payment->save();

            }

            if($payment->debito <= 0){
                $order->status_id = 4; // Pasamos el estado concretado;
                $order->debt = 4; // Output: 0
                $order->save();
                $this->notification('success', 'Se registró un pago de ' . $this->input_debito . ' [PEDIDO CONCRETADO]');
                $this->emit('closeModal_debito'); // Cerramos el modal
            } else {
                $order->status_id = 3; // Pasamos el estado a pendiente;
                $order->debt = $payment->debito;
                $order_save = $order->save();
                $this->notification('success', 'Se registró un pago de ' . $this->input_debito);
                $this->emit('closeModal_debito'); // Cerramos el modal
            }
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
