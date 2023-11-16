<?php
// $loi = "";

// if (isset($_POST['nutguiyeucau']) == true) {

//     $email = $_POST['email'];
//     $conn = new PDO(
//         "mysql:host=localhost;dbname=bookstore_g5;charset=utf8",
//         "huytv_pc07617",
//         "192383T&"
//     );
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $sql = "SELECT * FROM nguoi_dung WHERE email = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$email]);
//     $count = $stmt->rowCount();
//     if ($count == 0) {
//         $loi = "Email chưa đăng kí";
//     } else {
//         $matkhaumoi = substr(md5(rand(0, 99999)), 0, 8);
//         $sql = " UPDATE nguoi_dung SET mat_khau = ? WHERE email = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute([$matkhaumoi, $email]);
//         // echo "Mật khẩu mới đã được g";
//         Guimatkhaumoi($email, $matkhaumoi);
//     }
// }



$loi = "";

if (isset($_POST['nutguiyeucau'])) {
    // Kiểm tra xem người dùng đã nhập email hay chưa
    if (empty($_POST['email'])) {
        $loi = "Vui lòng nhập địa chỉ email.";
    } else {
        $email = $_POST['email'];
        // Kiểm tra định dạng email sử dụng biểu thức chính quy
        if (!preg_match('/^[^\@]{2,64}@[^\.\@]{2,253}\.[0-9a-z-\.]{2,63}$/', $email)) {
            $loi = "Địa chỉ email không hợp lệ. Vui lòng nhập đúng định dạng ";
        } else {
            // $conn = new PDO(
            //     "mysql:host=localhost;dbname=bookstore_g5;charset=utf8",
            //     "huytv_pc07617",
            //     "192383T&"
            // );
            $conn = pdo_get_connection();
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM nguoi_dung WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);
            $count = $stmt->rowCount();
            // Kiểm tra xem email có tồn tại dtbase
            if ($count == 0) {
                $loi = "Email chưa đăng kí";
            } else {
                $matkhaumoi = substr(md5(rand(0, 99999)), 0, 8);
                $sql = "UPDATE nguoi_dung SET mat_khau = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$matkhaumoi, $email]);
                Guimatkhaumoi($email, $matkhaumoi);
            }
        }
    }
}



?>
<?
function Guimatkhaumoi($email, $matkhaumoi)
{
    // require "PHPMailer-master/src/PHPMailer.php"; 
    // require "PHPMailer-master/src/SMTP.php"; 
    // require 'PHPMailer-master/src/Exception.php'; 
    require "../PHPMailer-master/src/PHPMailer.php";
    require "../PHPMailer-master/src/SMTP.php";
    require '../PHPMailer-master/src/Exception.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'truongvanhuy0502@gmail.com'; // SMTP username
        $mail->Password = 'sfpm pflp vlxv busm';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to   
        $mail->setFrom('truongvanhuy0502@gmail.com', 'Huy');
        // $mail->addAddress('$email'); 
        // Lấy giá trị email người dùng
        $email = $_POST['email'];
        // Thêm địa chỉ email hợp lệ
        $mail->addAddress($email);
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Thông báo khẩn về việc thay đổi mật khẩu';
        $noidungthu = "Đây là mật khẩu mới của bạn, do bạn hoặc ai đó yêu cầu đổi mật khẩu mới... 
        Mật khẩu của bạn là  {$matkhaumoi}";
        $mail->Body = $noidungthu;
        $mail->send();
        // echo 'Đã gửi mail đến ' . $email;
        if ($mail->send()) { ?>
            <div class="alert alert-success"><? echo 'Đã gửi mail đến ' . $email; ?></div><? }
    } catch (Exception $e) {
        // echo 'Error: ', $mail->ErrorInfo;
        echo 'Error: ', $e->getMessage();
    }
};
?>

<div class="col-md-6 offset-md-3">
    <span class="anchor" id="formChangePassword"></span>
    <hr class="mb-5">
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">QUÊN MẬT KHẨU</h3>
        </div>
        <? if ($loi != "") { ?>
            <div class="alert alert-danger"><? echo $loi ?></div>
        <? } ?>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="<?php if (isset($email)) echo $email; ?>" type="email" name="email" class="form-control" id="email" placeholder="Nhập vào Email">
                </div>
                <button type="submit" name="nutguiyeucau" value="nutgui" class="btn btn-success btn-lg btn-block">Gửi</button>
                <span>Bạn đã có tài khoản ? <a href="index.php?page=login">Đăng nhập</a></span>
            </form>
        </div>
    </div>
</div>