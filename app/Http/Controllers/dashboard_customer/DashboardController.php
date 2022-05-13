<?php

namespace App\Http\Controllers\dashboard_customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Livewire\WithPagination;
use App\Order;

class DashboardController extends Controller
{
    use WithPagination;

    public function isCustomer()
    {
        if(\Auth::user()->role->id =! 2){
            return redirect('/');
        }
    }


    public function orders(){
        $this->isCustomer(); // Comprobamos que haya un usuario con rol cliente
        
        $orders = Order::where('user_id', \Auth::user()->id)->where('status_id', 3)->orWhere('status_id', 4)->paginate(10);
        return view('dashboard_customer.orders.index', compact('orders'));
    }
}
