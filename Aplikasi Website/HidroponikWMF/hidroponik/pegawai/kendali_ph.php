<body class="hold-transition sidebar-mini layout-boxed">
<!-- Site Wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kendali pH Nutrisi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Kendali pH Nutrisi</li>
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
                <h3 class="card-title">Status Pompa pH Nutrisi</h3> 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                      <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1743141/widgets/503096"></iframe>
                  
                  <div class="col-md-3 col-sm-6 col-12" >
                    <!-- Card Pompa A -->
                    <div class="card card-dark">
                      <div class="card-header" style="text-align: center;">
                        Status Pompa pH Down
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="text-align: center;">
                        <div>
                          <label>
                            <span id="status">
                            <?php
                              $konek = mysqli_connect("localhost", "root", "", "hidroponikwmf");
                              $sql = mysqli_query($konek, "SELECT * FROM k_ph ORDER BY id DESC limit 1");
                              $data = mysqli_fetch_array($sql);
                              $relaya = $data['status_pompad'];
                              $relayb = $data['status_pompau']; { ?>
                            <?php 
                            if($relaya==1) 
                              echo "Menyala"; 
                            else 
                              echo "Mati"; ?>
                            </span>
                          </label>
                        </div>
                      </div>

                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- ./col -->

                  <div class="col-md-3 col-sm-6 col-12" >
                    <!-- Card Pompa A -->
                    <div class="card card-dark">
                      <div class="card-header" style="text-align: center;">
                        Status Pompa pH Up
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body" style="text-align: center;">
                        <div>
                          <label>
                            <span id="status">
                            <?php 
                            if($relayb==1) 
                              echo "Menyala"; 
                            else 
                              echo "Mati"; 
                            }?>
                            </span>
                          </label>
                        </div>
                      </div>

                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- ./col -->

                </div>
                <!-- ./row -->
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pompa pH Nutrisi</h3>
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
                $sql = "SELECT *, status_pompad, status_pompau, DATE_FORMAT(waktu_input, '%W, %d %M %Y - %H:%i:%s WIB') AS tanggal_input, DATE_FORMAT(waktu_input+INTERVAL 5 SECOND, '%W, %d %M %Y - %H:%i:%s WIB') AS tanggal_output FROM k_ph";
                $res=$db->query($sql);
                if ($res) { ?>
                <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nomor</th>
                          <th>Status Pompa pH Down</th>
                          <th>Status Pompa pH Up</th>
                          <th>Tanggal & Waktu</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $barisdata) 
                        {
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td>
                              <?php 
                                if($barisdata['status_pompad']==1) 
                                  echo "Menyala"; 
                                else 
                                  echo "Mati"; 
                              ?>
                            </td>
                            <td>
                              <?php 
                                if($barisdata['status_pompau']==1) 
                                  echo "Menyala"; 
                                else 
                                  echo "Mati"; 
                              ?>
                            </td>
                            <td><?php echo $barisdata['tanggal_input']; ?></td>
                          </tr>
                          <?php
                          $no++;}
                          ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Nomor</th>
                          <th>Status Pompa pH Down</th>
                          <th>Status Pompa pH Up</th>
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
<script>
      function ubahstatus(value)
      {
        if(value==true) value="Menyala";
        else value="Mati";
        document.getElementById('status').innerHTML=value;

        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
          {
            //ambil respon dari web setelah berhasil merubah nilai
            document.getElementById('status').innerHTML = xmlhttp.responseText;
          }
        }   
        //Ekseskusi file php untuk merubah status pompa
        xmlhttp.open("GET", "hidroponik/pegawai/status_pnutrisi.php?stat=" + value, true);
        //Kirim data
        xmlhttp.send();
    }
</script>