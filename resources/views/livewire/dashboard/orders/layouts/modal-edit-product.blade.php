<div wire:ignore.self class="modal fade" id="modal-edit-product" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    Editar precio
                    @if($this->product)
                        de {{ getProduct_name($this->product) }}
                    @endif
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
                                <label for="exampleFormControlSelect2">Ingrese precio unitario <span class="text-danger">(*)</span></label>
                                <input wire:model.defer="unit_price_edit" type="number" class="form-control" minlenght="0" required>
                            </div>
                        </div>
                    </div><!-- ./row -->

                </div>
               
                <div class="modal-footer">
                    <button 
                        <?php if($this->product) : ?>
                        
                        <?php endif ?>
                        wire:click="updatePrice({{ $this->product }})"
                        type="button" 
                        class="btn btn-danger">
                        Confirmar
                    </button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                </div>

            </form>
        </div>
    </div>
</div>