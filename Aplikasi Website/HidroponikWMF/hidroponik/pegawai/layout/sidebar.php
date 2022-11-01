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
          <!--Sidebar Menu TDS Nutrisi-->
          <li class="nav-item has-treeview">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-thermometer"></i>
            <p>TDS Nutrisi</p> <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item active">
              <a href="index.php?page=mtds" class="nav-link active">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Monitoring</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php?page=ktds" class="nav-link active">
                <i class="nav-icon fas fa-gamepad"></i>
                <p>Kendali</p>
              </a>
            </li>
          </ul>
        </li>

        <!--Sidebar Menu pH Nutrisi-->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-thermometer-half"></i>
            <p> pH Nutrisi <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php?page=mph" class="nav-link active">
                <i class="nav-icon fas fa-desktop"></i>
                <p>Monitoring</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php?page=kph" class="nav-link active">
                <i class="nav-icon fas fa-gamepad"></i>
                <p>Kendali</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>