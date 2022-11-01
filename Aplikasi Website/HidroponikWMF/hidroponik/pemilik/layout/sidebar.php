<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-olive elevation-4 text-sm">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-2 pb-2 mb-2 d-flex">
      <div class="image">
        <img src="dist/img/user4-128x128.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="index.php?page=dashboard" class="d-block"><?php  echo $_SESSION['nama_pengguna'];?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          <!--Sidebar Menu Dashboard -->
          <li class="nav-item">
            <a href="index.php?page=dashboard" class="nav-link active">
              <p>
                <i class="nav-icon fas fa-tachometer-alt"></i>  
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?page=dp" class="nav-link active">
              <p>
                <i class="nav-icon fas fa-user"></i> 
                Pengguna
              </p>
            </a>
          </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>