<?php
session_start();
include_once "./dao/pdo.php";
include_once "./dao/user.php";

?>


<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ten_nv = $_POST['ten_nv'];
  $email = $_POST['email'];
  $mat_khau = $_POST['mat_khau'];


  // Kiểm tra tính hợp lệ
  $errors = [];



  if (empty($ten_nv)) {
    $errors['ten_nv']['require'] = 'Vui lòng nhập tên ';
  }
  if (empty($email)) {
    $errors['email']['require'] = 'Vui lòng nhập email';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email không hợp lệ';
  }
  if (empty($mat_khau)) {
    $errors['mat_khau']['require'] = 'Vui lòng nhập mật khẩu';

  }
  if (empty($errors)) {
    $user =  check_user($ten_nv, $email, $mat_khau);


    if (isset($user) && (is_array($user) && (count($user)) > 0)) {
      extract($user);
      setcookie('user_admin', $user['ten_nv'], time() + 3600, "/");


        header('location: admin/');
        exit;
     
   


    }  else {
      header('location: site/');
      exit;
    }

  }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">


</head>

<body class="hold-transition login-page">

  <div class="login-box">

    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>Bible</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">ĐĂNG NHẬP</p>

        <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tên" name="ten_nv">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <p style="color: red;">
            <? echo !empty($errors['ten_nv']['require']) ? $errors['ten_nv']['require'] : ''; ?>
          </p>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <p style="color: red;">
            <? echo !empty($errors['email']['require']) ? $errors['email']['require'] : ''; ?>
          </p>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="mat_khau">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <p style="color: red;">
            <? echo !empty($errors['mat_khau']['require']) ? $errors['mat_khau']['require'] : ''; ?>
          </p>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Ghi nhớ
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12  ">
              <input type="submit" class="  btn btn-info btn-flat btn-sm btn-block 
             " name="dangNhap" value="Đăng nhập">
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google mr-2"></i> Google
          </a>
        </div>
        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
          <a href="forgotPassword.php">Quên mật khẩu</a>
        </p> -->
        <!-- <p class="mb-0">
          <a href="register.php" class="text-center">Đăng ký</a>
        </p> -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="admin/dist/js/adminlte.min.js"></script>


</body>

</html>