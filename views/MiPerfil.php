<?php
define( "BASE_URL", "/GestionDocente/views/");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Gestión Docente | Mi Perfil</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        <!-- Header -->
        <?php
            include("modulos/header.php");
        ?>
        <!-- /.Header -->

        <!-- Menú -->
        <?php
            include("modulos/menu.php");
        ?>
        <!-- /.Menú -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2"></div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Mi Perfil</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usu_nom">Nombres</label>
                                        <input type="text" class="form-control" name="usu_nom" id="usu_nom" placeholder="Ingrese su nombre" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usu_ape">Apellidos</label>
                                        <input type="text" class="form-control" name="usu_apep" id="usu_ape" placeholder="Ingrese su apellido" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_correo">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="usu_correo" id="usu_correo" placeholder="Ingrese su email" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_rol">Rol</label>
                                        <select class="form-control select2" name="usu_rol" id="usu_rol" data-placeholder="Seleccione" disabled>
                                            <option label="Seleccione"></option>
                                            <option value="ADMO">Administrativo</option>
                                            <option value="DOC">Profesor</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="usu_pass">Contraseña Actual</label>
                                        <input type="text" class="form-control" name="usu_pass" id="usu_pass" placeholder="Ingrese su email" disabled>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usu_pass">Nueva Contraseña</label>
                                        <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Ingrese su nueva contraseña">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="usu_pass">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="txtpassnew" name="txtpassnew" placeholder="Ingrese su nueva contraseña">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-secondary" id="btnactualizar">Cambiar Contraseña</button>
                            </div>
                        <!-- /.card-body -->
                        </div>
                    <!-- /.row -->
                </div>
            </section>
        </div>
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/miPerfil.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
