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
            <h1>Monitoring pH Nutrisi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Monitoring pH Nutrisi</li>
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
                <h3 class="card-title">Nilai pH Nutrisi</h3> 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1743141/widgets/503096"></iframe>
                <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1743141/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&max=14&min=0&results=60&title=Monitoring+pH&type=line&xaxis=Waktu&yaxis=Nilai+pH"></iframe>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data pH Nutrisi</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <?php 
                $db = dbConnect();
                if ($db->connect_errno==0) {
                $sql = "SELECT *, DATE_FORMAT(tanggal, '%W, %d %M %Y - %H:%i:%s WIB') AS tanggal_input FROM m_ph";
                $res=$db->query($sql);
                if ($res) { ?>
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nomor</th>
                          <th>Nilai pH</th>
                          <th>Tanggal & Waktu</th>
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
                            <td><?php echo $barisdata['nilai_ph']; ?></td>
                            <td><?php echo $barisdata['tanggal_input']; ?></td>
                          </tr>
                          <?php
                          $no++;}
                          ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nomor</th>
                          <th>Nilai pH</th>
                          <th>Tanggal & Waktu</th>
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