<div class="modal fade" id="modalcrearPrograma" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="programa_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prog_id" id="prog_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prog_codigo">Código</label>
                                <input type="text" class="form-control" name="prog_codigo" id="prog_codigo" placeholder="Ingrese el código del programa">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prog_nom">Nombre del programa</label>
                                <input type="text" class="form-control" name="prog_nom" id="prog_nom" placeholder="Ingrese el nombre del programa">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prog_sigla">Sigla</label>
                                <input type="text" class="form-control" name="prog_sigla" id="prog_sigla" placeholder="Ingrese la sigla">
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