<div>
    <!-- Modal editar precio de un producto -->
    @include('livewire.dashboard.orders.layouts.modal-edit-product')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th class="align-middle">#</th>
                        <th class="align-middle">Producto</th>
                        <th class="align-middle">Precio un.</th>
                        <th class="align-middle">Cantidad</th>
                        <th class="align-middle">Precio</th>
                        <th class="no-sort">Acción</th>
                    </tr>
                </thead>
                <tbody id="orders">
                                           
                    @foreach($this->order->items as $index => $item)
                    <tr class="btn-reveal-trigger">

                        <td class="py-2">{{ ++$index }}</td>
                        <td class="py-2">
                            <img src="{{ asset($item->product->image) }}" width="32px" alt="">
                            {{ $item->product->name }}
                        </td>

                        <td class="py-2">{{ priceFormat($item->unit_price) }}</td>
                        <td class="py-2">
                            <button wire:click="minus({{ $item }})" class="btn btn-light btn-rounded btn-icon" data-toogle="tooltip" title="Disminuir cantidad">
                                <i class="fa fa-minus text-dark"></i>
                            </button>
                            x{{ $item->qty }}
                            <button wire:click="plus({{ $item->product_id }})" class="btn btn-light btn-rounded btn-icon" data-toogle="tooltip" title="Aumentar cantidad">
                                <i class="fa fa-plus text-dark"></i>
                            </button>
                        </td>
                        <td class="py-2">{{ priceFormat($item->price) }}</td>
                        <td class="py-2">
                            <div class="d-flex">
                                <button type="button" wire:click="edit({{ $item }})" class="btn btn-primary shadow btn-xs sharp" data-toogle="tooltip" title="Editar" data-toggle="modal" data-target="#modal-edit-product"><i class="fa fa-pencil"></i></button>
								<button type="button" wire:click="delete({{ $item }})" class="btn btn-danger shadow btn-xs sharp" data-toogle="tooltip" title="Eliminar"><i class="fa fa-trash"></i></button>
							</div>
                        </td>
                    </tr>
                    @endforeach                

                </tbody>
            </table>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4 col-sm-5 ml-auto">
                <table class="table table-clear">
                    <tbody>
                        <tr>
                            <td class="left"><strong>Subtotal</strong></td>
                            <td class="right">{{ priceFormat($this->order->subtotal) }}</td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Dto.</strong></td>
                            <td class="right">{{ priceFormat($this->order->dto) }}</td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Total</strong></td>
                            <td class="right"><strong>{{ priceFormat($this->order->total) }}</strong><br>
                                <!--<strong>numberToWords</strong></td>-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
</div>