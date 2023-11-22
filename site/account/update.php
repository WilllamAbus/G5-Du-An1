<?
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_COOKIE['ma_nd'])) {
    header('Location: signin.php');
    exit();
}
$ma_nd = ($_COOKIE['ma_nd']);


print_r($_POST);

?>
<?

?>
<?php
$id = $_COOKIE['ma_nd'];
if (!empty((string) $id)) {
    $conn = pdo_get_connection();
    $sql = "SELECT * FROM nguoi_dung WHERE ten_nd = '" . $id . "' ";
    $resultAcc = $conn->query($sql);
    $updatAccount = $resultAcc->fetch();
    // print_r($updatAccount);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ten_nd'])) {
        $ten_nd = $_POST['ten_nd'];
        // $ma_nd = $_POST['ma_nd'];
        $ma_nd = $_POST['ma_nd'];
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];
        $sdt = $_POST['sdt'];
        $errors = [];
        if (empty($ten_nd)) {
            $errors['email'] = 'Vui lòng nhập tên';
        }
        if (empty($email)) {
            $errors['email'] = "Vui lòng nhập email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
        }
        if (empty($errors)) {
            $sql = "UPDATE nguoi_dung SET ten_nd='" . $ten_nd . "', email='" . $email . "', sdt='" . $sdt . "' WHERE ma_nd='" . $ma_nd . "'";

            pdo_execute($sql, $ten_nd, $email, $sdt, $mat_khau, $ma_nd);
            // $sql = "UPDATE nguoi_dung SET ten_nd=?, email=?, sdt=? WHERE ma_nd=?";
            // $stmt = $conn->prepare($sql);
            // $stmt->execute([$ten_nd, $email, $sdt, $ma_nd]);
            echo "đã cập nhật thành công ";
            // $_SESSION['message'] = 'User information updated successfully.';
            // echo "<script>window.location.href = 'index.php'</script>";
        } else {
            // header("Location: update.php");
        }
    }
}

// Kiểm tra tính hợp lệ

?>
<?
if (isset($_COOKIE['ma_nd']) && (is_array($_COOKIE['ma_nd']))) {
    $ma_nd = $_COOKIE['ma_nd'];

}
?>
<form id="form" method="post" action="">
    <div class="col-md-6 offset-md-3">
        <span class="anchor" id="formResetPassword"></span>
        <hr class="mb-5">
        <!-- form card reset password -->
        <div class="card card-outline-secondary">
            <div class="card-header">
                <h3 class="mb-0">CẬP NHẬT</h3>
            </div>
            <div class="card-body">
                <form class="form" role="form" autocomplete="off" id="loginForm" novalidate="" method="POST">
                    <div class="form-group">
                        <label for="uname1">Tên đăng nhập</label>
                        <input value="<?php echo $updatAccount['ten_nd'] ?>" class="form-control" name="ma_nd" id="uname1" placeholder="Nhập vào tên đăng nhập">

                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?php echo $updatAccount['email'] ?>" name="email" type="email" class="form-control" id="email" placeholder="Nhập vào Email">
                    </div>
                    <div class="form-group">
                        <label for="mat_khau">Mật khẩu</label>
                        <input value="<?php echo $updatAccount['mat_khau'] ?>" type="password" name="mat_khau" class="form-control" id="mat_khau" autocomplete="new-password" placeholder="Nhập vào mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input value="<?php echo $updatAccount['sdt']  ?>" type="phone" name="sdt" class="form-control" id="sdt" placeholder="Nhập vào số điện thoại">
                    </div>
                    <button name="submit" type="submit" class="btn btn-success btn-lg float-left btn-block" id="btnLogin">Cập nhật</button>
                    <span>Bạn đã có tài khoản ? <a href="index.php?page=changePass">Đổi mật khẩu</a></span>
                </form>
            </div>
        </div>
        <!-- /form card reset password -->
    </div>
</form>