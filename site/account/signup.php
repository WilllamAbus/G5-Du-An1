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

    if (empty($ten_nd)) {
        $errors['require'] = 'Vui lòng nhập tên đăng nhập';
    } else if (empty($email)) {
        $errors['email']['require'] = 'Vui lòng nhập email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không hợp lệ';
    } elseif (empty($mat_khau)) {
        $errors['mat_khau']['require'] = 'Vui lòng nhập mật khẩu';
    } elseif ($mat_khau !== $confirm) {
        $errors['prePass']['require'] = 'Xác nhận mật khẩu không khớp';
    }


    if (empty($errors)) {
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
            <form m action='' method='post' class="form" role="form" autocomplete="off">
                <div class="form-group">
                    <label for="inputName">Tên</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Nhập vào tên" name="ten_nd">
                </div>

                <div class="form-group">
                    <label for="inputEmail3">Email</label>
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Nhập vào Email" name="email">
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập vào số điện thoại" name="sdt">
                </div>

                <div class="form-group">
                    <label for="inputPassword3">Mật khẩu</label>
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Nhập vào mật khẩu"
                           name="mat_khau">
                </div>

                <div class="form-group">
                    <label for="inputPassword3">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Nhập lại mật khẩu"
                           name="xac_nhan_mat_khau">
                </div>

                <button type="submit" class="btn btn-success btn-lg float-left btn-block" id="btnLogin" name="signup">
                    Đăng ký
                </button>

        </div>
        <span class="ab">Bạn đã có tài khoản ? <a href="index.php?page=login">Đăng nhập</a></span>
        <span class="ab">Cập nhật tài khoản ? <a href="index.php?page=update">Cập nhật</a></span>
        </form>
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