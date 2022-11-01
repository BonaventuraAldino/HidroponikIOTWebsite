<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active">Detail Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail <small>Pengguna</small></h3>
              </div>
              <!-- /.card-header -->
              <?php
              if(isset($_GET["id_pengguna"])){
                $db=dbConnect();
                $id_pengguna=$db->escape_string($_GET["id_pengguna"]);
                if($datapengguna=getDataPengguna($id_pengguna))
                {// cari data pengguna, kalau ada simpan di $data
              ?>
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>ID Pengguna</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["id_pengguna"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Usernama</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["username"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["nama_pengguna"];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["no_telepon"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["email"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["password"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["role"];?>" readonly>  
                  </div>
                  <div class="form-group">
                    <label>Tanggal Input</label>
                    <input type="text" class="form-control" value="<?php echo $datapengguna["tanggal_input"];?>" readonly>  
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="index.php?page=dp" class="btn btn-danger">Kembali</a>
                </div>
              </form>
              <?php
                }
                else
                echo "Pengguna dengan Kode : $id_pengguna tidak ada. Pengeditan dibatalkan";
              ?>
              <?php
              }
              else
                echo "ID Pengguna tidak ada. Pengeditan dibatalkan.";
              ?>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
</body>
