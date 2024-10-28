<?php
define( "BASE_URL", "/GestionDocente/views/");
define("BASE_PATH","/GestionDocente");
/* Llamamos al archivo de conexion.php */
require_once("../config/conexion.php");

require_once("../models/Profesor.php");
    $profesor = new Docente();
    $prof = $profesor->get_profesorDetallexid($_GET['doc_id']);

require_once("../models/Cv.php");
    $hoja = new Cv();
    $cv = $hoja->get_cv_x_profesor($_GET['doc_id']);
                                        
                                

if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Gestión Docente | Perfil</title>
  <style>
    .card-body-profile{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .card-body-profile h4{
        font-weight: 900;
    }
    .card-body-profile .prof{
        font-weight: 600;
        text-transform: uppercase;
    }

    .card-profile-img-bg{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .card-profile-img-bg img{
        border-radius: 100%;
        width: 200px;
    }
  </style>
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
            <?php for($i=0;$i<sizeof($prof);$i++): ?>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="br-mainpanel br-profile-page">
                        <div class="card shadow-base bd-0 rounded-0 widget-4">
                            <div class="card-header ht-75"></div>
                            <div class="card-body-profile">
                                <div class="card-profile-img-bg">
                                    <img src='<?php echo (isset($prof[$i]["doc_image"])) ? BASE_PATH.$prof[$i]["doc_image"] : $ruta ;?>' alt="foto de perfil">
                                    
                                </div>
                                <h4 class="tx-normal tx-roboto tx-white"><?php echo $prof[$i]["doc_nom"] ." ". $prof[$i]["doc_ape"]; ?></h4>
                                <?php
                                    if($prof[$i]["doc_niv"] == 'P'){ ?>
                                    <p class="mg-b-25 prof"> Profesional </p>
                                <?php
                                    }elseif ($prof[$i]["doc_niv"] == 'E'){?>
                                        <p class="mg-b-25 prof"> Especialista </p>
                                <?php
                                    }elseif ($prof[$i]["doc_niv"] == 'M'){?>
                                        <p class="mg-b-25 prof"> Magister </p>
                                <?php
                                    }elseif ($prof[$i]["doc_niv"] == 'D'){?>
                                        <p class="mg-b-25 prof"> Doctor </p>
                                <?php
                                    }else{?>
                                        <p class="mg-b-25 prof"> Sin estudios </p>
                                <?php
                                    }
                                ?> 
                            </div>
                        </div>
                    </div>

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-light">
                                        <div class="card-header">
                                            <h3 class="card-title">Información General</h3>
                                        </div>
                                        <div class="card-body">
                                            <strong>ID</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_dni"];?></p>
                                            <strong>CORREO ADMINISTRATIVO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_correo"];?></p>
                                            <strong>CORREO ACADÉMICO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_correo2"];?></p>
                                            <strong>ESCALAFÓN</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["esc_nombre"];?></p>
                                            <strong>CARGO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["mod_nom"];?></p>
                                            <strong>PROGRAMA</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["prog_nom"];?></p>
                                            <strong>TELÉFONO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_telf"];?></p>
                                            <strong>FECHA DE INGRESO</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_fecini"];?></p>
                                            <strong>FECHA DE RETIRO</strong>
                                            <?php if($prof[$i]["doc_fecfin"] == "1970-01-01"): ?>
                                                <p class="text-muted">Actualmente</p>
                                            <?php else: ?>
                                                <p class="text-muted"><?php echo $prof[$i]["doc_fecfin"];?></p>
                                            <?php endif; ?>
                                            <hr>
                                            <strong>CVLAC</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_cvlac"];?></p>
                                            <strong>ORCID</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_orcid"];?></p>
                                            <strong>GOOGLE SCHOLAR</strong>
                                            <p class="text-muted"><?php echo $prof[$i]["doc_google"];?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="row p-2">  
                                            <div class="col-lg-12">
                                                <fieldset class="form-group">
                                                    <label class="form-label semibold" for="tick_titulo">Hoja de Vida</label>
                                                    <table id="cv_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 90%;">Nombre</th>
                                                            <th class="text-center" style="width: 10%;"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for($i=0;$i<sizeof($prof);$i++): ?>
                                                            <?php if($cv[$i]["doc_id"] == $prof[$i]["doc_id"]): ?> 
                                                           <td>
                                                            <a href='../document/cv/<?php echo $cv[$i]["doc_id"];?>/<?php echo $cv[$i]["cv_nom"];?>'target="_blank"><?php echo $cv[$i]["cv_nom"];?></a>
                                                           </td>
                                                           <td>
                                                            <a href='../document/cv/<?php echo $cv[$i]["doc_id"];?>/<?php echo $cv[$i]["cv_nom"];?>'target="_blank" class="btn btn-inline btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                           </td>
                                                           <?php else: ?>
                                                            <td>No hay archivos</td>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Cursos complementarios del docente</h3>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">   
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            <?php endfor; ?>
        </div>
        <?php
            include("modulos/footer.php");
        ?>
    </div>
    <!-- /.Site warapper -->
    <?php
    include("modulos/js.php");
    ?>
    <script type="text/javascript" src="js/admDtllProfesor.js"></script>
</body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
   header("Location:".Conectar::ruta()."views/404.php");
 }
?>
