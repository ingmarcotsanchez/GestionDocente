<?php
define( "BASE_URL", "/GestionDocente/views/");
require_once("../config/conexion.php");
if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Gestión Docente | Profesores</title>
</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <?php
            include("modulos/header.php");
        ?>
        <?php
            include("modulos/menu.php");
        ?>
       
        <div class="content-wrapper">
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2"></div>
            </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admón Profesores</h3>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-primary mb-2" onclick="nuevo()">Crear Profesor</button>
                            <button type="button" class="btn btn-outline-secondary mb-2" id="btnplantilla">Cargar Planilla</button>
                            <table id="docente_data" class="table display responsive wrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Profesor</th>
                                        <th>Teléfono</th>
                                        <th>Escalafón</th>
                                        <th>Estado</th>
                                        <th>Programa</th>
                                        <th>Modalidad</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
  
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <?php require_once("admProfesorModal.php"); ?>
    <?php require_once("admProfesorPlantilla.php"); ?>
    <?php include("modulos/js.php"); ?>
    <script type="text/javascript" src="js/admProfesor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
   
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
