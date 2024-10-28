<?php
  /*TODO: Llamando Cadena de Conexion */
  require_once("config/conexion.php");

  if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
    require_once("models/Usuario.php");
    /*TODO: Inicializando Clase */
    $usuario = new Usuario();
    $usuario->login();
  }
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="public/login/styles.css">
      <title>Gestión Docentes</title>
   </head>
   <body>
      <div class="login">
         <img src="public/dist/img/login-bg.png" alt="login image" class="login__img">
         <form method="post" class="login__form">
            <input type="hidden" id="usu_rol" name="usu_rol" class="form-control" value="ADMO">
            <h1 class="login__title">Login</h1>
            <?php
               if(isset($_GET["m"])){
                  switch($_GET["m"]){
                  case "1";
                     ?>
                     <div class="alert alert-danger" role="alert">
                        Los datos ingresados son incorrectos!
                     </div>
                     <?php
                     break;
                  case "2";
                     ?>
                        <div class="alert alert-warning" role="alert">
                        El formulario tiene los campos vacios!
                        </div>
                     <?php
                     break;
                  }
               }
            ?>
            <div class="login__content">
               <div class="login__box">
                  <i class='bx bxs-user'></i>
                  <div class="login__box-input">
                     <input type="email"  class="login__input" name="correo" id="correo" placeholder=" ">
                     <label for="login-email" class="login__label">Usuario</label>
                  </div>
               </div>
               <div class="login__box">
                  <i class='bx bxs-key'></i>
                  <div class="login__box-input">
                     <input type="password"  class="login__input" name="passwd" id="passwd" placeholder=" ">
                     <label for="login-pass" class="login__label">Contraseña</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>
            <input type="hidden" name="enviar" class="form-control" value="si">
            <button type="submit" class="login__button">Ingresar</button>
         </form>
      </div>
   </body>
</html>