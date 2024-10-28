<?php
define( "BASE_URL", "/Aspirantes/views/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include("modulos/head.php");
  ?>
  <title>Gestión Docente | Error 404</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->

    <section class="content">
      <div class="container-fluid">
        <div class="content-wrapper">
          <section class="content-header">
            <h1>Página no encontrada</h1>
          </section>
          <section class="content">
            <div class="error-page">
              <h2 class="headline text-primary">404</h2> 
              <div class="error-content">
                <h3>
                  <i class="fa fa-warning text-primary"></i> 
                  Ooops! La Página no fue encontrada.
                </h3>
                <p>
                  Ingresa al menú lateral y allí podrás encontrar las páginas disponibles. También puedes regresar haciendo <a href="http://localhost/GestionDocente/">click aquí.</a>
                </p>
              </div>
            </div>  
          </section>
        </div>
      </div>
    </section>

<!-- /.Site warapper -->
<?php
  include("modulos/js.php");
?>
</body>
</html>





