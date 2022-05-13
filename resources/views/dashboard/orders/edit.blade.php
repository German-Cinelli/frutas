@extends('dashboard/dashboard')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Pedido N° {{ $order->id }}</h4>
                <p>Cliente: <strong>{{ $order->user->name }}</strong></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @livewire('dashboard.orders.edit', ['order' => $order])
                </div>
            </div>
        </div>
    </div>
    


@endsection

