<?php
$valid = 0;
$db=dbConnect();
if($db->connect_errno==0){
  if(isset($_POST["submit"])){
    $username=$db->escape_string($_POST["username"]);
    $password=$db->escape_string($_POST["password"]);

    $sql="SELECT username,password,role,nama_pengguna,id_pengguna FROM pengguna WHERE username='$username' and password=md5('$password')";

    $res=$db->query($sql);
    if($res){
      if($res->num_rows==1){
        $data=$res->fetch_assoc();
        session_start();
        $_SESSION["status"]="login";
        $_SESSION["username"]=$data["username"];
        $_SESSION["password"]=$data["password"];
        $_SESSION["nama_pengguna"]=$data["nama_pengguna"];
        $_SESSION["role"]=$data["role"];
        if (isset($_SESSION['status'])){
          if($_SESSION['status']=="login"){
            if ($_SESSION['role'] == '1') {
              header('location:index.php?page=dashboard');
            }
            elseif ($_SESSION['role'] == '2') {
              header('location:index.php?page=dashboard');
            }
          }
          else 
          $valid = 3;
        }  
      }
      else
        $valid = 1;
    }
  }
}
else 
  $valid = 2;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-box">
      <div class="login-logo">
        <a href="login.php">
          <b>Login</b>
        </a>
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <!--Alert-->
        <?php
        if ($valid == 1){
          echo "<div class=\"card-body\">
          <div class=\"alert alert-danger alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
          <h5><i class=\"icon fas fa-ban\"></i> Login Gagal! </h5>
          Username/Password Salah
          </div>";
        } elseif ($valid == 2){
          echo "<div class=\"card-body\">
          <div class=\"alert alert-danger alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
          <h5><i class=\"icon fas fa-ban\"></i> Login Gagal! </h5>
          Error Koneksi Database
          </div>";
        } elseif ($valid == 3){
          echo "<div class=\"card-body\">
          <div class=\"alert alert-danger alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
          <h5><i class=\"icon fas fa-ban\"></i> Login Gagal! </h5>
          Silahkan Login Terlebih Dahulu
          </div>";
        }
        ?>
        <form method="POST" enctype='multipart/form-data'>
        </br>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div  align="center">
          <div class="col-4" >
            <input type="submit" class="btn btn-block btn-primary" name="submit" value="Log In"/>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </br>
  </div>
  <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
  if (isset($_GET["error"])) 
  {
  $error=$_GET["error"];
  if ($error==1)showError
    ("username dan password tidak sesuai.");
  else if ($error==2)showError
    ("Error database. Silahkan hubungi administrator");
  else if ($error==3)showError
    ("Koneksi ke Database gagal. Autentikasi gagal.");
  else if ($error==4)showError
    ("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
      Silahkan login terlebih dahulu.");
  else showError
    ("Unknown Error.");
  }
?>

