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

    public $price_kg = false;

    public $input_discount = 0;

    protected $listeners = [
        'selectedProduct',
        'modalAdd_product',
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
                $this->emit('closeModal_product_edit');

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

    public function changeStat($item_id){
        $item = OrderProduct::find($item_id);
        $msg = '';
        if($item->stat == 0){
            $msg = 'MARCADO';
            $item->update([
                'stat' => 1
            ]);
        } else {
            $msg = 'DESMARCADO';
            $item->update([
                'stat' => 0
            ]);
        }
        
        $save = $item->save();

        if($save){
            $this->notification('success', $msg);
        } else {
            $this->notification('error', 'Estado cambiado!');
        }
        
    }

    /**
     * Botón editar
     */
    public function price_kg(OrderProduct $item){
        $this->product = $item->id;
        $this->price_kg = $item->price_kg;
    }

    /**
     * Botón de confirmar edición de precio
     * modal-edit-product
     */
    public function updatePrice_kg(OrderProduct $item){
       
        if($this->price_kg < 0 || $this->price_kg == null){
            $this->notification('error', 'Seleccione un precio válido!');
        } else {
            $item->price_kg = $this->price_kg;
            $save = $item->save();
            if($save){
                $this->notification('success', 'Precio por Kg modificado!');
                $this->emit('closeModal_pice_kg'); // Cerramos el modal
            } else {
                $this->notification('error', 'Se produjo un error al ingresar el precio por Kg.');
            }
        }
        
    }

    /**
     * Método para cargar el descuento que ya tiene
     * un pedido en el input del descuento del modal
     */
    public function loadDiscount_to_modal(){
        $this->input_discount = $this->order->dto;
    }


    /**
     * Aplicar descuento al pedido
     */
    public function discount(){
        if($this->input_discount < 0 || $this->input_discount == null){
            $this->notification('error', 'Ingrese un vallor válido');
        } else {
            $order = Order::find($this->order->id);
            $order->total = ($order->total + $order->dto) - $this->input_discount;
            $order->dto = $this->input_discount;
            $save = $order->save();
            if($save){
                $this->notification('success', 'Descuento aplicado!');
                $this->emit('closeModal_discount'); // Cerramos el modal
            } else {
                $this->notification('error', 'Se produjo un error, recárgue la página para intentarlo nuevamente');
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
