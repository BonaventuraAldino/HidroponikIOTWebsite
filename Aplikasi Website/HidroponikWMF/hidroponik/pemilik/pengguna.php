<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site Wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pengguna</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="card text-center">
                  <a href="index.php?page=tp" class="btn btn-secondary"><i class="fas fa-plus"></i> Tambah Pengguna</a>
                </div>
                <?php 
                $db = dbConnect();
                if ($db->connect_errno==0) {
                $sql = "SELECT * FROM pengguna";
                $res=$db->query($sql);
                if ($res) { ?>
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID Pengguna</th>
                          <th>Nama</th>
                          <th>Telepon</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) {
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $barisdata['nama_pengguna']; ?></td>
                            <td><?php echo $barisdata['no_telepon']; ?></td>
                            <td><?php echo $barisdata['email']; ?></td>
                            <td>
                              <?php 
                                if($barisdata['role']==1) 
                                  echo "Pemilik"; 
                                else 
                                  echo "Pegawai"; 
                              ?>
                            </td>
                            <td>  
                              <a class="btn btn-primary btn-sm" href="index.php?page=ddp&id_pengguna=<?php echo $barisdata["id_pengguna"];?>">
                                <i class="fas fa-folder"></i>
                                View
                              </a>

                              <!--Edit Button-->
                              <a class="btn btn-info btn-sm" href="index.php?page=up&id_pengguna=<?php echo $barisdata["id_pengguna"];?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                              </a>

                              <!--Delete Button-->
                              <a class="btn btn-danger btn-sm" href="index.php?page=hp&id_pengguna=<?php echo $barisdata["id_pengguna"];?>">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                              </a>
                            </td>
                          </tr>
                          <?php
                          $no++;}
                          ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID Pengguna</th>
                          <th>Nama</th>
                          <th>Telepon</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                        <?php
                        $res->free();
                        } else "Gagal Eksekusi SQL".(DEVELOPMENT?" : ".$db->error:"")."<br>";
                        } else echo "Gagal koneksi".(DEVELOPMENT?" : ".$db->connect_error:"")."<br>";
                        ?>
                      </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
        </div>
      </div>
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