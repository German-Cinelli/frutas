<div wire:ignore.self class="modal fade" id="modal-product-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title">Ingreso de producto</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        
                        <div class="form-group">
                            <select class="form-control form-control-md" wire:model="category_id">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">*Seleccione categoría</span>
                            @enderror
                        </div>         
                        <div class="form-group">
                            <input type="text" wire:model="name" value="{{ old('name') }}" class="form-control input-default" placeholder="Ingrese nombre">
                            @error('name')
                                <span class="text-danger">*Ingrese un nombre</span>
                            @enderror
                        </div>

                        <input type="file" wire.model="file">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="store" wire.loading.attr="disabled" wire.target="store" class="btn btn-primary">Ingresar</button>
                </div>
            </form>

        </div>
    </div>
</div>