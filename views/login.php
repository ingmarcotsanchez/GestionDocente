<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="../public/login/styles.css">
      <title>Gestión Docentes</title>
   </head>
   <body>
      <div class="login">
         <img src="../public/dist/img/login-bg.png" alt="login image" class="login__img">
         <form action="" class="login__form">
            <h1 class="login__title">Login</h1>
            <div class="login__content">
               <div class="login__box">
                  <i class='bx bxs-user'></i>
                  <div class="login__box-input">
                     <input type="email" required class="login__input" id="login-email" placeholder=" ">
                     <label for="login-email" class="login__label">Usuario</label>
                  </div>
               </div>
               <div class="login__box">
                  <i class='bx bxs-key'></i>
                  <div class="login__box-input">
                     <input type="password" required class="login__input" id="login-pass" placeholder=" ">
                     <label for="login-pass" class="login__label">Contraseña</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>
            <button type="submit" class="login__button">Ingresar</button>
         </form>
      </div>
   </body>
</html>