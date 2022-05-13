@extends('dashboard/dashboard')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Pedidos</h4>
                <a href="{{ url('orders/create') }}" class="btn btn-info btn-fw float-right mt-3" ><i class="fa fa-plus"></i> Nuevo pedido</a>
                <!--<p class="mb-0">Your business dashboard template</p>-->
            </div>
        </div>
    </div>

    @livewire('dashboard.orders.index')

@endsection

