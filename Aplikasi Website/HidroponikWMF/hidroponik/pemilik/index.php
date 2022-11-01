<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site Wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Hidroponik WMF</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!--Jumlah Data TDS-->
    <?php
    $db=dbConnect();
    $sql = "SELECT * FROM pengguna";
    $data_pengguna = mysqli_query($db,$sql);
    $jumlah_pengguna = mysqli_num_rows($data_pengguna);
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-navy">
              <div class="inner">
                <h3><?php echo $jumlah_pengguna?></h3>

                <p>Data Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="index.php?page=dp" class="small-box-footer">
                Pengolahan Data Pengguna <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.penutup baris -->

        <!-- =========================================================== -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
</body>