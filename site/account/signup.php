<?php

setcookie($ten_nd);
// Kết nối CSDL 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ten_nd = isset($_POST['ten_nd']) ? $_POST['ten_nd'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : "";
  $mat_khau = isset($_POST['mat_khau']) ? $_POST['mat_khau'] : "";
  $confirm = isset($_POST['xac_nhan_mat_khau']) ? $_POST['xac_nhan_mat_khau'] : "";
  // Kiểm tra tính hợp lệ
  $errors = [];
  if (empty($ten_nd)) {
    $errors['ten_nd']['require'] = 'Vui lòng nhập tên đăng nhập';
  }
  if (empty($email)) {
    $errors['email']['require'] = 'Vui lòng nhập email';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email']['invalid'] = 'Email không hợp lệ';
  }
  if (empty($sdt)) {
    $errors['sdt']['require'] = 'Vui lòng nhập số điện thoại';
  } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
    $errors['sdt']['invalid'] = 'Số điện thoại không hợp lệ, bắt đầu số 0 và nhập 10 số';
  }
  if (empty($mat_khau)) {
    $errors['mat_khau']['require'] = 'Vui lòng nhập mật khẩu';
  }
  if ($mat_khau !== $confirm) {
    $errors['xac_nhan_mat_khau']['mismatch'] = 'Xác nhận mật khẩu không khớp';
  }

  if (empty($errors)) {
    // Continue with the database insertion logic
    $conn = pdo_get_connection();
    $sql = "INSERT INTO nguoi_dung (ten_nd, email, sdt, mat_khau) VALUES (:ten_nd, :email, :sdt, :mat_khau)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":ten_nd", $ten_nd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":sdt", $sdt);
    $stmt->bindParam(":mat_khau", $mat_khau);

    $stmt->execute();
    echo "<script>alert('Đăng ký thành công !'); location.href='index.php?page=login'</script>";

    exit;
  }
}
// Xử lý khi submit form
?>
<div class="col-md-6 offset-md-3">
  <span class="anchor" id="formRegister"></span>
  <!-- form card register -->
  <div class="card card-outline-secondary">
    <div class="card-header">
      <h3 class="mb-0">ĐĂNG KÍ</h3>
    </div>
    <div class="card-body">
      <form action='signup.php' method='post' class="form" role="form" autocomplete="off">
        <div class="form-group">
          <label for="inputName">Tên</label>
          <input type="text" class="form-control" id="inputName" placeholder="Nhập vào tên" name="ten_nd">
          <p style="color: red;">
            <?php echo !empty($errors['ten_nd']['require']) ? $errors['ten_nd']['require'] : ''; ?>
          </p>
        </div>

        <div class="form-group">
          <label for="inputEmail3">Email</label>
          <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập vào Email" name="email">
          <p style="color: red;">
            <?php
            echo !empty($errors['email']['require']) ? $errors['email']['require'] : '';
            echo !empty($errors['email']['invalid']) ? $errors['email']['invalid'] : '';
            ?>
          </p>
        </div>

        <div class="form-group">
          <label for="phone">Số điện thoại</label>
          <input type="text" class="form-control" id="phone" placeholder="Nhập vào số điện thoại" name="sdt">
          <p style="color: red;">
            <?php
            echo !empty($errors['sdt']['require']) ? $errors['sdt']['require'] : '';
            echo !empty($errors['sdt']['invalid']) ? $errors['sdt']['invalid'] : '';
            ?>
          </p>
        </div>

        <div class="form-group">
          <label for="inputPassword3">Mật khẩu</label>
          <input type="password" class="form-control" id="inputPassword3" placeholder="Nhập vào mật khẩu" name="mat_khau">
          <p style="color: red;">
            <?php echo !empty($errors['mat_khau']['require']) ? $errors['mat_khau']['require'] : ''; ?>
          </p>
        </div>

        <div class="form-group">
          <label for="inputPassword3">Xác nhận mật khẩu</label>
          <input type="password" class="form-control" id="inputPassword3" placeholder="Nhập lại mật khẩu" name="xac_nhan_mat_khau">
          <p style="color: red;">
            <?php echo !empty($errors['xac_nhan_mat_khau']['mismatch']) ? $errors['xac_nhan_mat_khau']['mismatch'] : ''; ?>
          </p>
        </div>

        <button type="submit" class="btn btn-success btn-lg float-left btn-block" id="btnLogin" name="signup">Đăng ký</button>
      </form>
    </div>
    <span class="ab">Bạn đã có tài khoản ? <a href="index.php?page=login">Đăng nhập</a></span>
    <span class="ab">Đổi mật khẩu ? <a href="index.php?page=changePass">Đổi mật khẩu</a></span>
  </div>
</div>

<style>
  .login {
    /* margin-left: 30px; */
    color: blue !important;
    text-decoration: none;
  }

  .ab {
    float: right !important;
    margin: 10px;
  }
</style>
