<div class="modal fade" id="modalcrearDocente" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="docente_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="doc_id" id="doc_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="prof_image">Foto</label>
                                <input type="file" class="doc_image" name="doc_image">
                                <p class="help-block">Peso máximo de la imagen 2MB y <strong>Formato PNG</strong></p>
                                <img src="image/profesor/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="doc_dni">ID</label>
                                <input type="text" class="form-control" name="doc_dni" id="doc_dni" placeholder="Ingrese un ID">
                                <div id="respuesta"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="doc_nom">Nombres</label>
                                <input type="text" class="form-control" name="doc_nom" id="doc_nom" placeholder="Ingrese los Nombres">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="doc_ape">Apellidos</label>
                                <input type="text" class="form-control" name="doc_ape" id="doc_ape" placeholder="Ingrese los Apellidos">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_correo">Correo Electrónico Administrativo</label>
                                <input type="email" class="form-control" name="doc_correo" id="doc_correo" placeholder="Ingrese el correo .edu">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_correo2">Correo Electrónico Académico</label>
                                <input type="email" class="form-control" name="doc_correo2" id="doc_correo2" placeholder="Ingrese el correo .edu.co">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="doc_niv">Último Nivel de Estudio</label>
                                <select class="form-control select2" style="width:100%" name="doc_niv" id="doc_niv" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="P">Pregrado</option>
                                    <option value="E">Especialización</option>
                                    <option value="M">Maestria</option>
                                    <option value="D">Doctorado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="doc_sex">Sexo</label>
                                <select class="form-control select2" style="width:100%" name="doc_sex" id="doc_sex" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="doc_telf">Celular</label>
                                <input type="text" class="form-control" name="doc_telf" id="doc_telf" placeholder="Ingrese un número de celular">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="esc_id">Escalafón</label>
                                <select class="form-control select2" style="width:100%" name="esc_id" id="esc_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="doc_fecini">Fecha de ingreso</label>
                                <input type="date" class="form-control" name="doc_fecini" id="doc_fecini" placeholder="Seleccione una fecha">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="doc_fecfin">Fecha de retiro</label>
                                <input type="date" class="form-control" name="doc_fecfin" id="doc_fecfin" placeholder="Seleccione una fecha">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_cvlac">Link de CVLAC</label>
                                <input type="text" class="form-control" name="doc_cvlac" id="doc_cvlac" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_orcid">Link de ORCID</label>
                                <input type="text" class="form-control" name="doc_orcid" id="doc_orcid" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_google">Link de GOOGLE SHOLAR</label>
                                <input type="text" class="form-control" name="doc_google" id="doc_google" placeholder="Ingrese un link">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="doc_est">Estado</label>
                                <select class="form-control select2" style="width:100%" name="doc_est" id="doc_est" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value=1>Activo</option>
                                    <option value=0>Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prog_id">Programa</label>
                                <select class="form-control select2" style="width:100%" name="prog_id" id="prog_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mod_id">Modalidad</label>
                                <select class="form-control select2" style="width:100%" name="mod_id" id="mod_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fileElem">Hoja de Vida</label>
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

