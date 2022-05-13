@extends('dashboard/dashboard')

@section('content')

    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Nuevo pedido</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ url('order-new') }}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>A continuación seleccione el cliente:</label>
                                <select name="customer_id" class="form-control form-control-lg">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                Continuar
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

