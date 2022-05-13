<div wire:ignore.self class="modal fade" id="modal-order-cancel" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                    Cancelar pedido N°
                    @if($this->order != null)
                        {{ $this->order->id }}
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
                                <label for="exampleFormControlSelect2">Seleccione motivo... <span class="text-danger">(*)</span></label>
                                <select wire:model="reason_id" class="form-control form-control-lg" required>
                                    <option value="El cliente cambió de idea." selected>El cliente cambió de opinión.</option>
                                    <option value="Ésto es un pedido de prueba.">Ésto es un pedido de prueba.</option>
                                    <option value="Hay inconsistencias en los importes.">Hay inconsistencias en los importes</option>
                                    <option value="Otro motivo.">Otro motivo.</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- ./row -->

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$emit('cancelOrder', {{ isset($this->order->id) ? $this->order->id : null}})" class="btn btn-danger">Cancelar pedido</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                </div>

            </form>
        </div>
    </div>
</div>