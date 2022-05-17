@extends('dashboard/dashboard')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Pedido N° {{ $order->id }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card mt-3">
                <div class="card-header">Cliente: {{ $order->user->name }} <strong>Emisión: {{ $order->updated_at }}</strong>
                    <span class="float-right">
                        <strong>Estado:</strong>
                        <i class="fa fa-circle {{ $order->status->bg }}"></i>
                        {{ $order->status->name }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <h6>De:</h6>
                            <div> <strong>Mario</strong> </div>
                            <div>Teléfono: 097 226 953</div>
                        </div>
                        <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <h6>Para:</h6>
                            <div> <strong>{{ $order->user->name }}</strong> </div>
                            <div>Dirección Grecia 1234</div>
                            <div>Teléfono: {{ $order->user->phone }}</div>
                        </div>
                        <!--<div class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                            <div class="row align-items-center" style="font-size: 0.9rem;">
                                <div class="col-auto"> <img src="https://apirone.com/static/promo/bitcoin_logo_vector.svg" class="img-fluid mb-3" style="max-height: 30px;" alt=""><br>
                                    <span>Please send exact amount: <strong>0.15050000 BTC</strong><br>
                                        <strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></span><br>
                                    <small class="text-muted">Current exchange rate 1BTC = $6590 USD</small>
                                </div>
                                <div class="col-auto"> <img src="https://apirone.com/api/v1/qr?message=bitcoin%3A1DonateWffyhwAjskoEwXt83pHZxhLTr8H%3Famount%3D0.15050000" class="img-fluid" alt="" style="max-width: 114px;"> </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Producto</th>
                                    <th class="right">Unitario</th>
                                    <th class="center">Ctd.</th>
                                    <th class="right">Precio</th>
                                    <th class="right">$ / Kg</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $index => $item)
                                <tr>
                                    <td class="center">{{ ++$index }}</td>
                                    <td class="left strong">{{ $item->product->name }}</td>
                                    <td class="right">{{ priceFormat($item->unit_price) }}</td>
                                    <td class="center">x{{ $item->qty }}</td>
                                    <td class="right">{{ priceFormat($item->price) }}</td>
                                    <td class="right">
                                        @if($item->price_kg)
                                            {{ priceFormat($item->price_kg) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5"> </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right">{{ priceFormat($order->subtotal)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Descuento</strong></td>
                                        <td class="right">{{ priceFormat($order->dto) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>{{ priceFOrmat($order->total) }}</strong><br></td>
                                    </tr>
                                </tbody>
                            </table>
                            <strong class="text-uppercase">{{ $total_to_words }} pesos uruguayos.</strong>
                        </div>
                    </div>
                    @if(count($order->payments) > 0)
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-6 col-lg-6 ">
                            <div class="table-responsive">
                                <h4>Historial de pagos</h4>
                                <table class="table table-hover table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->payments as $index => $payment)
                                        <tr>
                                            <th>{{ ++$index }}</th>
                                            <td><strong>{{ priceFormat($payment->payment) }}</strong></td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection