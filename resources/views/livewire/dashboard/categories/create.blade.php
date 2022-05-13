<div wire:ignore.self class="modal fade" id="modal-category-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Ingreso de categoría</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                    
                        <div class="form-group">
                            <input type="text" wire:model.defer="name" class="form-control input-default " placeholder="Ingrese nombre para la categoría">
                        </div>
                        
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