<?
// if ($_COOKIE() =='') session_start();
// if (isset($_COOKIE['ma_nd']) == false){
//     header('locatione: login.php');
//     exit();
// }

// if(isset($_COOKIE['ma_nd'])){
// $ma_nd = $_COOKIE['ma_nd'];
// }
// $ten_nd = $_SESSION['ten_nd'];
// Lấy giá trị từ session
if (isset($_SESSION['ten_nd'])) {
    $ten_nd = $_SESSION['ten_nd'];
}

$ma_nd = ($_COOKIE['ma_nd']);


$loi = "";
// print_r($_POST);
print_r($_POST);
if (isset($_POST['btndoimatkhau']) == true) {
    if (isset($_POST['matkhaucu'])) {
        $matkhaucu = $_POST['matkhaucu'];
    }

    if (isset($_POST['matkhaumoi_1'])) {
        $matkhaumoi_1 = $_POST['matkhaumoi_1'];
    }

    if (isset($_POST['matkhaumoi_2'])) {
        $matkhaumoi_2 = $_POST['matkhaumoi_2'];
    }
    //  $conn = new PDO(
    //         "mysql:host=localhost;dbname=bookstore_g5;charset=utf8",
    //         "huytv_pc07617",
    //         "192383T&"
    //     );

    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn = pdo_get_connection();
    if ($conn) {
        // $sql = "SELECT * FROM nguoi_dung WHERE ten_nd =? AND mat_khau =? ";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute([$ma_nd, $matkhaucu]);
       
        $sql = "SELECT * FROM nguoi_dung WHERE ten_nd = ? AND mat_khau = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_nd, $matkhaucu]);
        if ($stmt->rowCount() == 0) { {
                $loi .= "Mật khẩu bạn nhập vào không chính xác <br>";
            }
        }
        if (strlen($matkhaumoi_1) < 7) { {
                $loi .= "Mật khẩu ngắn quá, Tối thiểu 8 kí tự <br>";
            }
        }
        if ($matkhaumoi_1 != $matkhaumoi_2) {
            $loi .= "Mật khẩu mới không trùng nhau<br>";
        }
    }
    if ($loi == "") {
        // $sql = "UPDATE nguoi_dung SET ten_nd =? WHERE mat_khau =? ";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute([$ma_nd, $matkhaumoi_1]);
        if($stmt->rowCount() > 0){
            $sql = "UPDATE nguoi_dung SET mat_khau = ? WHERE ten_nd = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$matkhaumoi_1, $ma_nd]); 
          }
        echo "Đã cập nhật xong mật khẩu";
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