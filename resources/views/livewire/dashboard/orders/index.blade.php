<div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Modal cancelar pedido -->
            @include('livewire.dashboard.orders.layouts.modal-cancel-order')
            <!-- Modal debito -->
            @include('livewire.dashboard.orders.layouts.modal-debito')
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12 col-md-6 col-lg-3 float-right mb-5">
                        <input type="text" wire:model="search" class="form-control" placeholder="Buscar">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped">
                            <thead style="cursor: pointer">
                                <tr>
                                    <th wire:click="order('id')">
                                        N°
                                        @if($this->sort == 'id')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('user_id')">
                                        Cliente
                                        @if($this->sort == 'user_id')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('subtotal')">
                                        Subtotal
                                        @if($this->sort == 'subtotal')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('dto')">
                                        Dto.
                                        @if($this->sort == 'dto')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('total')">
                                        Total
                                        @if($this->sort == 'total')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th>Debito</th>
                                    <th wire:click="order('status_id')">
                                        Estado
                                        @if($this->sort == 'status_id')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="customers">

                                @foreach($orders as $order)
                                <tr class="btn-reveal-trigger">
                                    <td class="py-2">{{ $order->id }}</td>
                                    <td class="py-2">{{ $order->user->name }}</td>
                                    <td class="py-2">{{ priceFormat($order->subtotal) }}</td>
                                    <td class="py-2">{{ priceFormat($order->dto) }}</td>
                                    <td class="py-2">{{ priceFormat($order->total) }}</td>
                                    <td class="py-2">{{ priceFormat(debito($order->id)) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle {{ $order->status->bg }} mr-1"></i>
                                            {{ $order->status->name }}
                                        </div>
                                    </td>

                                    <td class="py-2">
                                        <div class="d-flex">

                                        @switch(true)
                                            @case($order->status_id == 1)
                                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Editar pedido"><i class="fa fa-pencil"></i></a>
                                                <a href="#" wire:click="$emit('cancelOrder', {{ $order }})" class="btn btn-danger shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Cancelar pedido"><i class="fa fa-close"></i></a>
                                                <a href="#" wire:click="$emit('openModal_debito', {{ $order }})" class="btn btn-warning shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Registrar pago"><i class="fa fa-usd text-white"></i></a>
                                                <a href="#" wire:click="$emit('concretarOrder', {{ $order }})" class="btn btn-success shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Concretar pedido"><i class="fa fa-check"></i></a>
                                                @break
                                        
                                            @case($order->status_id == 2)
                                                
                                                @break

                                            @case($order->status_id == 3)
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Ver pedido"><i class="fa fa-info-circle"></i></a>
                                                <a href="#" wire:click="$emit('cancelOrder', {{ $order }})" class="btn btn-danger shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Cancelar pedido"><i class="fa fa-close"></i></a>
                                                <a href="#" wire:click="$emit('openModal_debito', {{ $order }})" class="btn btn-warning shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Registrar pago"><i class="fa fa-usd text-white"></i></a>
                                                @break

                                             @case($order->status_id == 4)
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Ver pedido"><i class="fa fa-info-circle"></i></a>
                                                @break
                                            @default
                                                
                                        @endswitch
                                            
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
</div>
