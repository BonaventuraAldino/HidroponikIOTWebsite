<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=editstasiuna">Pengguna</a></li>
              <li class="breadcrumb-item active">Edit Data Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ubah <small>Data Pengguna</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              if(isset($_GET["id_pengguna"])){
                $db=dbConnect();
                $id_pengguna=$db->escape_string($_GET["id_pengguna"]);
                if($datapengguna=getDataPengguna($id_pengguna)){// cari data pengguna, jika ada simpan di $data   
              ?>
              <form method="post" name="frm">
                <div class="card-body">
                  
                  <input input type="hidden" class="form-control" name="id_pengguna" value="<?php echo $datapengguna["id_pengguna"];?>" readonly>
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $datapengguna["username"];?>">
                  </div>
                  <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" name="nama_pengguna" value="<?php echo $datapengguna["nama_pengguna"];?>">
                  </div>
                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" value="<?php echo $datapengguna["no_telepon"];?>">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $datapengguna["email"];?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" value="<?php echo $datapengguna["password"];?>">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <input type="text" class="form-control" name="role" value="<?php echo $datapengguna["role"];?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_pengguna" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=dp" class="btn btn-danger">Kembali</a>
                </div>
              </form>
              <?php
            }
            else
              echo "Stasiun dengan Kode : $id_pengguna tidak ada. Pengeditan dibatalkan";
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
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php
if(isset($_POST["update_pengguna"])){
  $db=dbConnect();
  if($db->connect_errno==0){
    // Bersihkan data
        $id_pengguna    = $db->escape_string($_POST["id_pengguna"]);
        $username       = $db->escape_string($_POST["username"]);
        $nama_pengguna  = $db->escape_string($_POST["nama_pengguna"]); 
        $no_telepon     = $db->escape_string($_POST["no_telepon"]);
        $email          = $db->escape_string($_POST["email"]);
        $password       = $db->escape_string($_POST["password"]);  
        $role           = $db->escape_string($_POST["role"]);

    // Susun query update
    $sql="UPDATE pengguna SET 
        id_pengguna='$id_pengguna', username='$username', nama_pengguna='$nama_pengguna', no_telepon='$no_telepon', email='$email', password='$password', role='$role' WHERE id_pengguna='$id_pengguna'";

    // Eksekusi query update
    $res=$db->query($sql);
    if($res){
      if($db->affected_rows>0){ // jika ada update data
        ?>
        <script>
          alert('Berhasil diupdate!');
          document.location.href = 'index.php?page=dp';
        </script>
        <?php
      }
      else{ // Jika sql sukses tapi tidak ada data yang berubah
        ?>
        <script>
          alert('Update pengguna berhasil tanpa perubahan!');
          document.location.href = 'index.php?page=dp';
        </script>
        <?php
      }
    }
    else{ // gagal query
      ?>
      <script>
          alert('Gagal update!');
          document.location.href = 'index.php?page=up';
        </script>
      <?php
    }
  }
  else
    echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
}
?>
</body>
