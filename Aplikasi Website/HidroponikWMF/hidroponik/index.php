<?php
  session_start();
  $timeout = 120; // setting timeout dalam menit
  $logout = "index.php?page=logout"; // redirect halaman logout

  $timeout = $timeout * 60; // menit ke detik
  if(isset($_SESSION['start_session'])){
    $elapsed_time = time()-$_SESSION['start_session'];
    if($elapsed_time >= $timeout){
      session_destroy();
      echo "<script type='text/javascript'>alert('Sesi telah berakhir');window.location='$logout'</script>";
    } 
  }

  $_SESSION['start_session']=time();

  //Database config_hidroponik
  include "config/config.php";

  $page = isset($_GET['page']) ? $_GET['page'] : null;
  // Jika alamat URL == login
  // Maka akan menampilkan halaman login
  if ($page == "login"){
    include "login.php";
  } else {
    if($_SESSION['status']!="login"){
      $login = "index.php?page=login";
      header("Location:index.php?page=login"); 
    } else {
      if($_SESSION['role']=="1"){ ?>
        <!--  Jika sudah login maka akan menampikan tempalte dan halaman sesuai role-->
        <!DOCTYPE html>
        <html>
        <?php 
          include 'hidroponik/pemilik/layout/header.php';
        ?>
        <body class="hold-transition sidebar-mini layout-fixed">
          <div class="wrapper">
            <?php
            //Navbar
            include "hidroponik/pemilik/layout/navbar.php";
            //Sidebar
            include "hidroponik/pemilik/layout/sidebar.php";
            //Jquery
            include 'hidroponik/pemilik/layout/foot.php';
            ?>
            <!-- Content Wrapper. Contains page content -->
            <?php
            switch($page){
              case 'login':
              include 'hidroponik/login.php';
              break;
              case 'dashboard':
              include 'pemilik/index.php';
              break;
              case 'dp':
              include 'pemilik/pengguna.php';
              break;
              case 'ddp':
              include 'pemilik/detail_pengguna.php';
              break;
              case 'tp':
              include 'pemilik/tambah_pengguna.php';
              break;
              case 'up':
              include 'pemilik/edit_pengguna.php';
              break;
              case 'hp':
              include 'pemilik/hapus_pengguna.php';
              break;
              case 'logout':
              include 'hidroponik/logout.php';
              break;
              default:
              include 'hidroponik/pemilik/index.php';
              break;
            }
            ?>
          </div>
        </body>
        <!-- Footer and Control Side Bar -->
        <?php
          include 'hidroponik/pemilik/layout/footer.php';
          include 'hidroponik/pemilik/layout/controlsidebar.php';
        ?>
        </html>
        
        <?php 
        } elseif ($_SESSION['role']=="2") { ?>
        <!--  Jika sudah login maka akan menampikan tempalte dan halaman sesuai role-->
        <!DOCTYPE html>
        <html>
        <?php include 'hidroponik/pegawai/layout/header.php';?>
        <body class="hold-transition sidebar-mini layout-fixed">
          <div class="wrapper">
            <?php
            //Navbar
            include "hidroponik/pegawai/layout/navbar.php";
            //Sidebar
            include "hidroponik/pegawai/layout/sidebar.php";
            //Jquery
            include 'hidroponik/pegawai/layout/foot.php';
            ?>
            <!-- Content Wrapper. Contains page content -->
            <?php
            switch($page){
              case 'login':
              include 'hidroponik/pegawai/login.php';
              break;
              case 'dashboard':
              include 'hidroponik/pegawai/index.php';
              break;
              case 'mtds':
              include 'hidroponik/pegawai/monitoring_tds.php';
              break;
              case 'ktds':
              include 'hidroponik/pegawai/kendali_tds.php';
              break;
              case 'kpnutris':
              include 'hidroponik/pegawai/status.php';
              break;
              case 'mph':
              include 'hidroponik/pegawai/monitoring_ph.php';
              break;
              case 'kph':
              include 'hidroponik/pegawai/kendali_ph.php';
              break;
              case 'logout':
              include 'hidroponik/logout.php';
              break;
              default: 
              include 'hidroponik/pegawai/index.php';
              break;
            }
            ?>
            <!-- Footer and Control Side Bar -->
          </div>
        </body>
        <?php
          include 'hidroponik/pegawai/layout/footer.php';
          include 'hidroponik/pegawai/layout/controlsidebar.php';
        ?>
        </html>
        <?php
      }
      ?>
      <?php
    }
  }
?>