<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_nd = $_POST['ten_nd'];
    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    // Kiểm tra tính hợp lệ
    $errors = [];
    if (empty($ten_nd)) {
        $errors['ten_nd']['require'] = 'Vui lòng nhập tên của bạn !!!';
    } elseif (!preg_match('/^\S+$/', $ten_nd)) {
        $errors['ten_nd']['format'] = 'Tên đăng nhập không được chứa khoảng trắng !!!';
    }
    if (empty($email)) {
        $errors['email']['require'] = 'Vui lòng nhập email !!!' ;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email']['invalid'] = 'Email không hợp lệ, Vui lòng nhập đúng định dạng Email. !!';
    }
    if (empty($mat_khau)) {
        $errors['mat_khau']['require'] = ' Vui lòng nhập mật khẩu !!!';
    } elseif (preg_match('/\s/', $mat_khau)) {
        $errors['mat_khau']['format'] = 'Mật khẩu không được chứa khoảng trắng !!!';
    }
    // nếu đúng thì đăng nhập
    if (empty($errors)) {
        $user = validate_user($ten_nd, $email, $mat_khau);
        if (isset($user) && (is_array($user) && (count($user)) > 0)) {
            extract($user);
            setcookie('ma_nd', $user['ten_nd']);
            echo "<script>window.location.href = 'index.php?page=trangchu'</script>";
            exit;
        } else {
            echo '<div  class="alert alert-danger" style = "text-align: center" >
            <strong></strong> Tài khoản đăng nhập sai <br> Vui lòng nhập lại !!!
          </div>';
        }
    }
}
?>
<div class="col-md-6 offset-md-3">
    <span class="anchor" id="formLogin"></span>

    <!-- form card login with validation feedback -->
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">ĐĂNG NHẬP</h3>
        </div>
        <div class="card-body">
            <form class="form" action="" role="form" autocomplete="off" id="loginForm" novalidate="" method="POST">
                <div class="form-group">
                    <label for="uname1">Tên đăng nhập</label>

                    <input type="text" class="form-control" name="ten_nd" id="uname1" placeholder="Nhập vào tên đăng nhập">
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
                    </p>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" id="pwd1" autocomplete="new-password" placeholder="Nhập vào mật khẩu" name="mat_khau">
                    <p style="color: red;">
                        <?php echo !empty($errors['mat_khau']['require']) ? $errors['mat_khau']['require'] : ''; ?>
                        <?php echo !empty($errors['mat_khau']['format']) ? $errors['mat_khau']['format'] : ''; ?>
                    </p>
                </div>
                <button type="submit" class="btn btn-success btn-lg float-left btn-block" id="btnLogin" name="dangnhap">Đăng nhập</button>
                <span>Bạn chưa có tài khoản ? <a href="index.php?page=signup">Đăng kí</a></span>
                <span class="changePass"> <a href="index.php?page=forgot">Quên mật khẩu</a></span>
            </form>
        </div>
        <!--/card-body-->
    </div>
    <!-- /form card login -->

</div>

<style>
    .changePass {
        float: right;
    }
</style>