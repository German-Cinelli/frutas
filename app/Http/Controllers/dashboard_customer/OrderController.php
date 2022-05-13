<?php

namespace App\Http\Controllers\dashboard_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Livewire\WithPagination;
use App\Order;
use NumberToWords\NumberToWords;

class OrderController extends Controller
{
    use WithPagination;

    public function isCustomer()
    {
        if(\Auth::user()->role->id =! 2){
            return redirect('/');
        }
    }

    public function index(){
        $this->isCustomer(); // Comprobamos que haya un usuario con rol cliente
        //$user = \Auth::user();
        ///dd($user->orders);
        $orders = Order::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard_customer.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $this->isCustomer(); // Comprobamos que haya un usuario con rol cliente

        $order = Order::where('id', $id)->where('user_id', \Auth::user()->id)->first();
        if($order){
            $total_to_words = NumberToWords::transformNumber('es', $order->total);
            return view('dashboard_customer.orders.show', compact('order', 'total_to_words'));
        } else {
            return redirect('/mis_pedidos');
        }
        
    }
}
