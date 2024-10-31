<div class="modal fade" id="modalcrearCurso_profesor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="cursos_profesor_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="cur_prof_id" id="cur_prof_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cur_image">Foto</label>
                                <input type="file" class="cur_image" name="cur_image">
                                <p class="help-block">Peso máximo de la imagen 2MB y <strong>Formato PNG</strong></p>
                                <img src="image/certificados/default/default.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cur_prof_nom">Título del Curso</label>
                                <input type="text" class="form-control" name="cur_prof_nom" id="cur_prof_nom" placeholder="Ingrese el título del curso">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tipo_id">Tipo</label>
                                <select class="form-control select2" style="width:100%" name="tipo_id" id="tipo_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cur_prof_anno">Año</label>
                                <input type="text" class="form-control" name="cur_prof_anno" id="cur_prof_anno" placeholder="Ingrese el Año de elaboración">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_id">Profesor</label>
                                <select class="form-control select2" style="width:100%" name="doc_id" id="doc_id" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fileElem">Certificado</label>
                                <input type="file" class="form-control" id="fileElem" name="fileElem" multiple>
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