<div wire:ignore.self class="modal fade" id="modal-discount" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    Aplicar descuento
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" class="forms-sample">
                <div class="modal-body">
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Ingrese descuento <span class="text-danger">(*)</span></label>
                                <input wire:model="input_discount" type="number" class="form-control" min="0" required>
                            </div>
                        </div>
                    </div><!-- ./row -->

                </div>
               
                <div class="modal-footer">
                    <button 
                        wire:click="discount"
                        type="button" 
                        class="btn btn-primary">
                        Confirmar
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                </div>

            </form>
        </div>
    </div>
</div>