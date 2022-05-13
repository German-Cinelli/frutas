<div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Seleccione producto:</label>
                <select id="single-select" class="form-control form-control-lg">
                    <option value="0" disabled selected>Seleccione...</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>
    </div>
</div>
