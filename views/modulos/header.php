<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-primary" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="text-primary fas fa-user"></i>
          <span class="text-muted"><?php echo $_SESSION["usu_nom"]." ".$_SESSION["usu_ape"];?></span>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Cambio de Password</span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo BASE_URL; ?>MiPerfil.php" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Mi perfil
          </a>
        </div>
      </li>
  </ul>
</nav>