<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.php" class="brand-link">
      <img src="../public/dist/img/Logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">GESTIÓN DOCENTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
   
       
          <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">
          <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"] ?>">
          
        


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if($_SESSION["usu_rol"] == "ADMO"):?>
          <li class="nav-header"><strong class="text-warning">INFORMACIÓN</strong></li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>inicio.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Inicio</p>
            </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION["usu_rol"] == "ADMO"):?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admUsuarios.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
        
          <li class="nav-header"><strong class="text-warning">CONFIGURACIÓN</strong></li>
          
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admEscalafon.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Escalafón</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admLineas.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Líneas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admModalidades.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Modalidades</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admProgramas.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Programas</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admTipos.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Tipos</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admProfesor.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Profesores</p>
            </a>
          </li>

          
          <?php endif; ?>
          
          <?php if($_SESSION["usu_rol"] == "ADMO" || $_SESSION["usu_rol"] == "DOC"):?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admCursos_profesor.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Cursos</p>
            </a>
          </li>
          <?php endif; ?>
       
          <li class="nav-header"><strong class="text-warning">LOGOUT</strong></li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>Logout.php" class="nav-link">
              <i class="nav-icon fas fa-circle text-danger"></i>
              <p class="text">Salir</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>