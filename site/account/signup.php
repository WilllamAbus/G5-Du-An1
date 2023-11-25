<?php
// Kết nối CSDL 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ten_nd = isset($_POST['ten_nd']) ? $_POST['ten_nd'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : "";
  $mat_khau = isset($_POST['mat_khau']) ? $_POST['mat_khau'] : "";
  $confirm = isset($_POST['xac_nhan_mat_khau']) ? $_POST['xac_nhan_mat_khau'] : "";

  // Kiểm tra tính hợp lệ
  $errors = [];

  // Check if email or username already exists
  $conn = pdo_get_connection();
  $check_existing_user_sql = "SELECT * FROM nguoi_dung WHERE email = :email OR ten_nd = :ten_nd";
  $check_existing_user_stmt = $conn->prepare($check_existing_user_sql);
  $check_existing_user_stmt->bindParam(":email", $email);
  $check_existing_user_stmt->bindParam(":ten_nd", $ten_nd);
  $check_existing_user_stmt->execute();



  if ($check_existing_user_stmt->rowCount() > 0) {
    $errors['existing_user'] = '  <div class="alert alert-danger">
    <strong></strong> Email và tên đăng nhập đã tồn tại.
  </div>';
  }


  // Continue with other validation checks
  if (empty($ten_nd)) {
    $errors['ten_nd']['require'] = 'Vui lòng nhập tên của bạn !!!';
} elseif (!preg_match('/^\S+$/', $ten_nd)) {
    $errors['ten_nd']['format'] = 'Tên đăng nhập không được chứa khoảng trắng !!!';
}
if (empty($email)) {
  $errors['email']['require'] = 'Vui lòng nhập email !!!' ;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email']['invalid'] = 'Email không hợp lệ, Vui lòng nhập đúng định dạng Email. !!';
}elseif (!preg_match('/^\S+$/', $email)) {
  $errors['email']['format'] = 'Email không được chứa khoảng trắng !!!';
}
  if (empty($sdt)) {
    $errors['sdt']['require'] = 'Vui lòng nhập số điện thoại';
  } elseif (!preg_match('/^0[0-9]{9}$/', $sdt)) {
    $errors['sdt']['invalid'] = 'Số điện thoại không hợp lệ, bắt đầu số 0 và nhập 10 số';
  }
  elseif (!preg_match('/^\S+$/', $sdt)) {
    $errors['sdt']['format'] = 'Sdt không được chứa khoảng trắng !!!';
}
  if (empty($mat_khau)) {
    $errors['mat_khau']['require'] = ' Vui lòng nhập mật khẩu !!!';
} elseif (preg_match('/\s/', $mat_khau)) {
    $errors['mat_khau']['format'] = 'Mật khẩu không được chứa khoảng trắng !!!';
}
  if ($mat_khau !== $confirm) {
    $errors['xac_nhan_mat_khau']['mismatch'] = 'Xác nhận mật khẩu không khớp';
  }

  if (empty($errors)) {
    // Insert new user only if there are no validation errors
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
      <form action='' method='post' class="form" role="form" autocomplete="off">
        <p style="color: red;">
          <?php echo !empty($errors['existing_user']) ? $errors['existing_user'] : ''; ?>
        </p>

        <div class="form-group">
          <label for="inputName">Tên người dùng</label>
          <input       type="text" class="form-control" id="inputName" placeholder="Nhập vào tên" name="ten_nd">
          <p style="color: red;">
                        <?php echo !empty($errors['ten_nd']['require']) ? $errors['ten_nd']['require'] : ''; ?>
                        <?php echo !empty($errors['ten_nd']['format']) ? $errors['ten_nd']['format'] : ''; ?>
                   
                    </p>
        </div>

        <div class="form-group">
          <label for="inputEmail3">Email</label>
          <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập vào Email" name="email">
          <p style="color: red;">
                        <?php echo !empty($errors['email']['require']) ? $errors['email']['require'] : ''; ?>
                        <?php echo !empty($errors['email']['invalid']) ? $errors['email']['invalid'] : ''; ?>
                        <?php echo !empty($errors['email']['format']) ? $errors['email']['format'] : ''; ?>
                    </p>
        </div>

        <div class="form-group">
          <label for="phone">Số điện thoại</label>
          <input type="text" class="form-control" id="phone" placeholder="Nhập vào số điện thoại" name="sdt">
          <p style="color: red;">
            <?php
            echo !empty($errors['sdt']['require']) ? $errors['sdt']['require'] : '';
            echo !empty($errors['sdt']['invalid']) ? $errors['sdt']['invalid'] : '';
            echo !empty($errors['sdt']['format']) ? $errors['sdt']['format'] : ''; 
            ?>
          </p>
        </div>
        <div class="form-group">
          <label for="inputPassword3">Mật khẩu</label>
          <input type="password" class="form-control" id="inputPassword3" placeholder="Nhập vào mật khẩu" name="mat_khau">
          <p style="color: red;">
                        <?php echo !empty($errors['mat_khau']['require']) ? $errors['mat_khau']['require'] : ''; ?>
                        <?php echo !empty($errors['mat_khau']['format']) ? $errors['mat_khau']['format'] : ''; ?>
                    
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