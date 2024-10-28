<div class="modal fade" id="modalcrearUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="usu_id" id="usu_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_nom">Nombres</label>
                                <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese su Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_ape">Apellidos</label>
                                <input type="text" class="form-control" name="usu_ape" id="usu_ape" placeholder="Ingrese su Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_correo">Correo Electrónico</label>
                                <input type="email" class="form-control" name="usu_correo" id="usu_correo" placeholder="Ingrese su Correo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_pass">Password</label>
                                <input type="password" class="form-control" name="usu_pass" id="usu_pass" placeholder="Ingrese su Contraseña">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_rol">Rol</label>
                                <select class="form-control select2" name="usu_rol" id="usu_rol" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="ADMO">Coordinador</option>
                                    <option value="ASPI">Aspirante</option>
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