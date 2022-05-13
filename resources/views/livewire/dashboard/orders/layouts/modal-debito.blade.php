<div wire:ignore.self class="modal fade" id="modal-debito" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    Débito para el pedido N°
                    @if($this->order)
                        {{ $this->order->id }}
                        de
                        {{ $this->order->user->name }}
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
                                <label for="exampleFormControlSelect2">Ingrese monto... <span class="text-danger">(*)</span></label>
                                <input type="number" wire:model.defer="input_debito" class="form-control" min="1" required>
                            </div>
                        </div>
                    </div><!-- ./row -->

                </div>
                <div class="modal-footer">
                    <button wire:click="confirmarPago({{ $order }})" type="button" class="btn btn-warning text-white">Confirmar pago</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                </div>

            </form>
        </div>
    </div>
</div>