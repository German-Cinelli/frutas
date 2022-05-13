<div wire:ignore.self class="modal fade" id="modal-customer-create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Ingreso de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                    
                        <div class="form-group">
                            <input type="text" wire:model.defer="name" class="form-control input-default " placeholder="Ingrese nombre">
                        </div>

                        <div class="form-group">
                            <input type="text" wire:model.defer="phone" class="form-control input-default " placeholder="Ingrese teléfono">
                        </div>

                        <div class="form-group">
                            <input type="text" wire:model.defer="password" class="form-control input-default " placeholder="Ingrese contraseña de acceso al sistema">
                        </div>
                        
                    </div>
                </div>

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible alert-alt fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>

                    @error('name')
                        <p>Por favor ingrese el campo <strong>Nombre</strong></p>
                    @enderror

                    @error('password')
                    <p>Por favor ingrese el campo <strong>Contraseña</strong></p>
                    @enderror
                    
                </div>
                @endif

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancelar</button>
                    <button type="button" wire:click="store" wire.loading.attr="disabled" wire.target="store" class="btn btn-primary">Ingresar</button>
                </div>
            </form>

        </div>
    </div>
</div>