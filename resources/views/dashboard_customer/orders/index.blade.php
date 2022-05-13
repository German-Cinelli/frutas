@extends('dashboard/dashboard_customer')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Mis pedidos</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12 col-md-6 col-lg-3 float-right mb-5">
                        <input type="text" wire:model="search" class="form-control" placeholder="Buscar">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped">
                            <thead style="cursor: pointer">
                                <tr>
                                    <th>N°</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="orders">

                                @foreach($orders as $order)
                                <tr class="btn-reveal-trigger">
                                    <td class="py-2">{{ $order->id }}</td>
                                    <td class="py-2">{{ priceFormat($order->total) }}</td>
                                    <td class="py-2">{{ $order->created_at }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle {{ $order->status->bg }} mr-1"></i>
                                            {{ $order->status->name }}
                                        </div>
                                    </td>

                                    <td class="py-2">
                                        <div class="d-flex">
                                            <a href="{{ url('/pedido/' . $order->id) }}" class="btn btn-info shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Ver pedido"><i class="fa fa-info-circle"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                    
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <div class="float-right">
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

