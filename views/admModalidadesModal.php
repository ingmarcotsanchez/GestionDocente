<div class="modal fade" id="modalcrearModalidad" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="modalidad_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="mod_id" id="mod_id">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="mod_codigo">Código</label>
                                <input type="text" class="form-control" name="mod_codigo" id="mod_codigo" placeholder="Código">
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label for="mod_nom">Nombre del programa</label>
                                <input type="text" class="form-control" name="mod_nom" id="mod_nom" placeholder="Ingrese el nombre de la modalidad">
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>