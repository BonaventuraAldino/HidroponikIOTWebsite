<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Stasiun Awal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Pengguna</li>
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
                <h3 class="card-title">Input <small>Data Pengguna</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" name="frm">
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                  	<label>Nama Pengguna</label>
                  	<input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna">
                  </div>
                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" placeholder="Nomor Telepon">
                  </div>
                  <div class="form-group">
                  	<label>Email</label>
                  	<input type="text" class="form-control" name="email" placeholder="Email">
                  </div>                  
                  <div class="form-group">
                  	<label>Password</label>
                  	<input type="text" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                      <option>--- Pilih Role ---</option>
                      <option value="1">Pemilik</option>
                      <option value="2">Pegawai</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="save_pengguna" value="Simpan" class="btn btn-primary">Submit</button>
                  <a href="index.php?page=dp" class="btn btn-danger">Kembali</a>
                </div>
              </form>
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
 <?php
    if (isset($_POST["save_pengguna"])) {
      $db=dbConnect();
      if ($db->connect_errno==0) {
        // Bersihkan Data
        $username       = $db->escape_string($_POST["username"]);
        $nama_pengguna  = $db->escape_string($_POST["nama_pengguna"]);
        $no_telepon     = $db->escape_string($_POST["no_telepon"]);   
        $email          = $db->escape_string($_POST["email"]);
        $password       = $db->escape_string($_POST["password"]);  
        $role           = $db->escape_string($_POST["role"]);
        $paswd_hash     = md5($password);

      // Query Insert
      $sql="INSERT INTO pengguna (id_pengguna, username,  nama_pengguna, no_telepon, email, password, role)VALUES ('','$username','$nama_pengguna','$no_telepon','$email','$paswd_hash','$role')";
      // Eksekusi Query
      $res=$db->query($sql);
      if ($res) {
        if ($db->affected_rows>0) {
          // Jika Ada Penambahan Data
          ?>
          <script>
            alert('Tambah Pengguna Berhasil!');
            document.location.href = 'index.php?page=dp';
          </script>
          <?php
          }
        } 
        else {
        ?> 
        <script>
          alert('Tambah Pengguna Gagal!');
          document.location.href = 'index.php?page=tp';
        </script>
        <?php 
        }
      }  
      else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
    }
  ?>
