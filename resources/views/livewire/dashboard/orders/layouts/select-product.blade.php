<div class="row">
    <div class="col-12">
        <div class="form-group">

            <div class="form-group">
                <label>Precio unitario del producto a escoger:</label>
                <div class="input-group mb-3 input-info">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input wire:model.defer="unit_price" type="number" min="0" class="form-control">
                </div>
            </div>
                    
            <div class="form-group">
                <label>Producto:</label>
                <select id="single-select" class="form-control">
                    <option value="0" disabled selected>Seleccione...</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="pull-right">
                <button wire:click="loadDiscount_to_modal" data-toggle="modal" data-target="#modal-discount" type="button" class="btn btn-secondary">
                    <i class="fa fa-usd"></i>
                    Descontar
                </button>
            </div>
            
        </div>
    </div>
</div>