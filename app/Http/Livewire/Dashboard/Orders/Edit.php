<?php

namespace App\Http\Livewire\Dashboard\Orders;

use Livewire\Component;
use App\Order;
use App\Product;
use App\OrderProduct;

class Edit extends Component
{
    public $order;

    public $unit_price = null;

    public $unit_price_edit = null;

    public $open = false; // Modal para setear el precio unitario de un producto

    public $product = false; // Propiedad para ser manejada en el modal de editar precio de un producto

    protected $listeners = [
        'selectedProduct',
        'modalAdd_product',
        'closeModal_product_edit',
        'cancel'
    ];

    public function render()
    {
        $this->order = Order::find($this->order->id);
        $products = Product::orderBy('name', 'asc')->get();
        return view('livewire.dashboard.orders.edit', [
            'order' => $this->order,
            'products' => $products
        ]);
    }

    public function hydrate()   {
        $this->emit('select2');
    }

    public function selectedProduct($product_id){
        if($product_id) {
            if($this->unit_price <= 0 || $this->unit_price == null){
                $this->notification('error', 'Seleccione un precio válido!');
            } else {
                $this->add($product_id);
            }
            
        } else {
            $this->product = null;
        }
    }

    /**
     * Método para desplegar el modal
     */
    public function open_modal(){
        $this->emit('modalAdd_product');
    }


    /**
     * Botón editar
     */
    public function edit($item){
        $this->product = $item['id'];
        $this->unit_price_edit = $item['unit_price'];
    }

    /**
     * Botón de confirmar edición de precio
     * modal-edit-product
     */
    public function updatePrice($item_id){
        if($this->unit_price_edit <= 0 || $this->unit_price_edit == null){
            $this->notification('error', 'Seleccione un precio válido!');
        } else {
            $item = OrderProduct::find($item_id);
            if($item){

                $order = Order::find($item->order_id);
                // Restamos en la order el item
                $order->subtotal = $order->subtotal - $item->price;
                $order->total = $order->total - $item->price;

                // Modificamos el precio unitario y precio final del item según la cantidad
                $item->unit_price = $this->unit_price_edit;
                $item->price = $this->unit_price_edit * $item->qty;
                $item->save();

                // Modificamos el subtotal y total de la order con el nuevo precio del item
                $order->subtotal = $order->subtotal + $item->price;
                $order->total = $order->total + $item->price;
                $order->save();

                $this->notification('success', 'Precio modificado');
                //$this->emit('closeModal_product_edit'); No funciona, corregir

            }

            

        }
        
    }


    public function add($product_id)
    {
        $product = Product::find($product_id);
        $this->addItem($product);

    }


    /**
     * Botón de disminuir cantidad
     */
    public function minus($item){
        if($item['qty'] == 1){
            $this->notification('warning', 'El producto ya tiene una cantidad mínima!');
        } else {
            $product = Product::find($item['product_id']);
            $this->removeItem($product);
        }
    }

    /**
     * Botón de aumentar cantidad
     */
    public function plus($product_id){
        $this->add($product_id);
    }

    /**
     * Botón acción para eliminar
     */
    public function delete($item){
        $product = Product::find($item['product_id']);
        $this->removeItem($product, $all = true);
    }


    /**
     * Método para añadir un nuevo item al pedido
     */
    public function addItem($product){
        $item = OrderProduct::where('order_id', $this->order->id)->where('product_id', $product->id)->first();

        /**
         * Si hay item no es necesario crear otro, simplemente se le agrega una unidad
         */
        if($item){
            // Modificar cantidad
            $item->qty = ++$item->qty;
            $item->price += $item->unit_price;
            $save_item = $item->save();

            if($save_item){
                // Actualizamos el subtotal y total del pedido
                $order = Order::find($item->order_id);
                $order->subtotal = $order->subtotal + $item->unit_price;
                $order->total = $order->total + $item->unit_price;
                $save_order = $order->save();

                if($save_order){
                    $product = Product::find($item->product_id);
                    $product->qty_sold = ++$product->qty_sold;
                    
                    $save_product = $product->save();
    
                    if($save_product){
    
                        $this->notification('success', 'Cantidad aumentada!');
                    } else {
    
                        $this->notification('error', 'Algo salió mal! Recárgue la página');
                    }
                    
                } else {

                    $this->notification('error', 'Algo salió mal! Recárgue la página');
                }

            } else {

                $this->notification('error', 'Algo salió mal! Recárgue la página');
            }

        } else {
            // Crear nuevo item
            $item = OrderProduct::create([
                'order_id' => $this->order->id,
                'product_id' => $product->id,
                'unit_price' => $this->unit_price,
                'qty' => 1,
                'price' => $this->unit_price
            ]);

            if($item){
                /**
                 * Le sumamos al subtotal de la order el valor del item
                 */
                $order = Order::find($item->order_id);

                $order->subtotal = $order->subtotal + $item->unit_price;
                $order->total = $order->total + $item->unit_price;

                $save = $order->save();

                if($save){

                    $product = Product::find($item->product_id);
                    $product->qty_sold = ++$product->qty_sold;

                    $save_product = $product->save();
    
                    if($save_product){
    
                        $this->notification('success', 'Producto añadido');
                    } else {
    
                        $this->notification('error', 'Algo salió mal! Recárgue la página');
                    }

                } else {

                    $this->notification('error', 'Algo salió mal! Por favor recárgue la página');
                }
            } else {
                
                $this->notification('error', 'Algo salió mal! Por favor recárgue la página');
            }

        }
    }


    /**
     * Método para disminuir cantidad de un pedido
     */
    public function removeItem($product, $all = false){
        /**
         * Si el valor de $all = true, quiere decir que se presionó el boton de acción eliminar
         * Quiere decir que no se va a restar 1 cantidad, es decir...
         * que hay que restar tantos items haya
         */
        $item = OrderProduct::where('order_id', $this->order->id)->where('product_id', $product->id)->first();

        /**
         * Si hay item no es necesario crear otro, simplemente se le agrega una unidad
         */
        if($item){

            if($all){
                $order = Order::find($item->order_id);
                $order->subtotal = $order->subtotal - $item->price;
                $order->total = $order->total - $item->price;
                $order->save();


                $product = Product::find($item->product_id);
                $product->qty_sold = $product->qty_sold - $item->qty;
            
                $product->save();

                // Eliminamos el item del pedido
                $item->delete();

                $this->notification('success', 'Se removió un producto del pedido');

            } else {

                // Modificar cantidad
                $item->qty = --$item->qty;
                $item->price -= $item->unit_price;
                $save_item = $item->save();

                if($save_item){
                    // Actualizamos el subtotal y total del pedido
                    $order = Order::find($item->order_id);
                    $order->subtotal = $order->subtotal - $item->unit_price;
                    $order->total = $order->total - $item->unit_price;
                    $save_order = $order->save();

                    if($save_order){
                        $product = Product::find($item->product_id);
                        $product->qty_sold = --$product->qty_sold;

                        $save_product = $product->save();
        
                        if($save_product){
        
                            $this->notification('success', 'Cantidad disminuida');
                        } else {
        
                            $this->notification('error', 'Algo salió mal! Recárgue la página');
                        }
                        
                    } else {

                        $this->notification('error', 'Algo salió mal! Recárgue la página');
                    }

                } else {

                    $this->notification('error', 'Algo salió mal! Recárgue la página');
                }

            }

        } else {
                
            $this->notification('error', 'Algo salió mal! Por favor recárgue la página');
            
        }
    }

    public function cancel(){
        dd($this->order);
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
