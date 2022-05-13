<div>
    @livewire('dashboard.customers.create')
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
                                <th wire:click="order('id')">
                                        Nombre
                                        @if($this->sort == 'id')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('name')">
                                        Nombre
                                        @if($this->sort == 'name')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <th wire:click="order('phone')">
                                        Teléfono
                                        @if($this->sort == 'phone')
                                            {{ datatable_arrow($this->direction) }}
                                        @endif
                                    </th>
                                    <!--<th>Acción</th>-->
                                </tr>
                            </thead>
                            <tbody id="customers">

                                @foreach($customers as $customer)
                                <tr class="btn-reveal-trigger">
                                    <td class="py-2">{{ $customer->id }}</td>
                                    <td class="py-2">{{ $customer->name }}</td>
                                    <td class="py-2">{{ $customer->phone }}</td>

                                    <!--<td class="py-2">
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1" data-toogle="tooltip" title="Editar"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </td>-->
                                </tr>
                                @endforeach
                                    
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <div class="float-right">
                            {{ $customers->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
