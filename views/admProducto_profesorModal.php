<div class="modal fade" id="modalcrearProducto_profesor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="productos_profesor_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="prod_prof_id" id="prod_prof_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prod_prof_nom">Título del Curso</label>
                                <input type="text" class="form-control" name="prod_prof_nom" id="prod_prof_nom" placeholder="Ingrese el título del curso">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prod_prof_tipo">Tipo</label>
                                <select class="form-control select2" name="prod_prof_tipo" id="prod_prof_tipo" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="AD">Artículo Divulgativo</option>
                                    <option value="AC">Artículo Cientifico</option>
                                    <option value="AS">Artículo Scopus</option>
                                    <option value="DS">Desarrollo de Software</option>
                                    <option value="PI">Ponencia Interna</option>
                                    <option value="PE">Ponencia Externa</option>
                                    <option value="CL">Capitulo Libro</option>
                                    <option value="LI">Libro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prod_prof_anno">Año</label>
                                <input type="text" class="form-control" name="prod_prof_anno" id="prod_prof_anno" placeholder="Ingrese el Año de elaboración">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_id">Profesor</label>
                                <select class="form-control select2" style="width:100%" name="prof_id" id="prof_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
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