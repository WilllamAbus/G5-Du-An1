
<?php
if (isset($_SESSION['ten_nd'])) {
    $ten_nd = $_SESSION['ten_nd'];
}

$ma_nd = ($_COOKIE['ma_nd']);


$loi = "";

// Kiểm tra xem form đã được submit hay chưa
if (isset($_POST['btndoimatkhau'])) {
    // Lấy dữ liệu từ form
    $matkhaucu = isset($_POST['matkhaucu']) ? $_POST['matkhaucu'] : "";
    $matkhaumoi_1 = isset($_POST['matkhaumoi_1']) ? $_POST['matkhaumoi_1'] : "";
    $matkhaumoi_2 = isset($_POST['matkhaumoi_2']) ? $_POST['matkhaumoi_2'] : "";

    // Kiểm tra tính hợp lệ của mật khẩu cũ
    if (empty($matkhaucu)) {
        $loi .= "Mật khẩu cũ không được để trống<br>";
    }

    // Kiểm tra tính hợp lệ của mật khẩu mới
    if (empty($matkhaumoi_1)) {
        $loi .= "Mật khẩu mới không được để trống<br>";
    } elseif (strlen($matkhaumoi_1) < 8) {
        $loi .= "Mật khẩu mới quá ngắn, tối thiểu 8 kí tự<br>";
    }

    // Kiểm tra tính hợp lệ của mật khẩu xác nhận
    if (empty($matkhaumoi_2)) {
        $loi .= "Xác nhận mật khẩu mới không được để trống<br>";
    } elseif ($matkhaumoi_1 !== $matkhaumoi_2) {
        $loi .= "Mật khẩu mới không trùng khớp<br>";
    }

    // Nếu không có lỗi, thực hiện cập nhật mật khẩu
    if ($loi == "") {
        $conn = pdo_get_connection();
        if ($conn) {
            $sql = "SELECT * FROM nguoi_dung WHERE ten_nd = ? AND mat_khau = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$ma_nd, $matkhaucu]);

            if ($stmt->rowCount() == 0) {
                $loi .= "Mật khẩu cũ không chính xác<br>";
            } else {
                // Cập nhật mật khẩu mới
                $sql_update = "UPDATE nguoi_dung SET mat_khau = ? WHERE ten_nd = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->execute([$matkhaumoi_1, $ma_nd]);

                if ($stmt_update->rowCount() > 0) {
                    echo '<div class="alert alert-success" style="text-align: center">
                            <strong></strong> Đã cập nhật xong !!!.
                          </div>';
                } else {
                    $loi .= "Có lỗi xảy ra khi cập nhật mật khẩu mới<br>";
                }
            }
        }
    }
}
?>
<?
if ($loi != "") { ?>
    <div class="alert alert-danger"><? echo $loi ?></div>
    </div>
<? } ?></div>

<div class="col-md-6 offset-md-3">
    <span class="anchor" id="formChangePassword"></span>
    <hr class="mb-5">
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">ĐỔI MẬT KHẨU</h3>
        </div>

        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method="post">
                <div class="form-group">
                    <label for="">Tên người dùng</label>
                    <input disabled value="<?= $ma_nd ?>" type="text" class="form-control" placeholder="" name="" id="">
                </div>

                <div class="form-group">
                    <label for="matkhaucu">Mật khẩu</label>
                    <input value="<? if (isset($matkhaucu) == true) echo $matkhaucu ?>" type="password" class="form-control" placeholder="Nhập vào mật khẩu cũ" name="matkhaucu" id="matkhaucu">
                </div>
                <div class="form-group">
                    <label for="matkhaumoi_1">Mật khẩu mới</label>
                    <input value="<? if (isset($matkhaumoi_1) == true) echo $matkhaumoi_1 ?>" type="password" class="form-control" placeholder="Nhập vào mật khẩu mới" name="matkhaumoi_1" id="matkhaumoi_1">
                </div>
                <div class="form-group">
                    <label for="matkhaumoi_2">Nhập lại mật khẩu mới</label>
                    <input value="<? if (isset($matkhaumoi_2) == true) echo $matkhaumoi_2 ?> " type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" name="matkhaumoi_2" id="matkhaumoi_2">
                </div>
                <div class="form-group">
                    <button name="btndoimatkhau" type="submit" class="btn btn-success btn-lg btn-block">Lưu</button>
                </div>
                <span>Bạn đã có tài khoản ? <a href="index.php?page=login">Đăng nhập</a></span>
            </form>
        </div>
    </div>
</div>