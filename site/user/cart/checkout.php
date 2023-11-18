<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $ten_nd = $_POST['ten_nd'];
    // $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $dia_chi = $_POST['dia_chi'];


    if (empty($ten_nd)) {
        $errhoten = "Họ Tên Trống";
    }
    // if (empty($email)) {
    //     $erremail = "Email Trống";
    // }
    if (empty($sdt)) {
        $errsdt = "Số Điện Thoại Trống";
    }
    if (empty($dia_chi)) {
        $errdc = "Địa Chỉ Trống";
    }
    if (!isset($errhoten) && !isset($errsdt) && !isset($errdc)) {
        $conn = pdo_get_connection();
        $conn->beginTransaction();

        $ma_nd = $_COOKIE['ma_nd'];
        $ten_nd = $_POST['ten_nd'];
        $sdt = $_POST['sdt'];
        $ngay_lap = date_create()->format('Y-m-d H:i:s');
        $dia_chi = $_POST['dia_chi'];
        $pttt = $_POST['pttt'];
        $tong_tien = $_POST['tong_tien'];


        order_data($ma_nd, $ten_nd, $dia_chi, $sdt, $ngay_lap, $pttt, $tong_tien);


        $ma_hd = $_POST['ma_hd'];
        $ma_hh = $_POST['ma_hh'];
        $ten_hh = $_POST['ten_hh'];
        $don_gia = $_POST['don_gia'];
        $so_luong = $_POST['so_luong'];
        $giam_gia = $_POST['giam_gia'];
        $thanh_tien = $_POST['thanh_tien'];
        $hinh = $_POST['hinh'];


        order_detail_data($ma_hd, $ma_hh, $ten_hh, $don_gia, $so_luong, $giam_gia, $thanh_tien, $hinh);

        echo "<script>alert('Đặt hàng thành công!');</script>";
        echo "<script>window.location.href = 'index.php?page=process'</script>";
        // header('Location: index.php?page=orderComplete');
    }


}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>THANH TOÁN</h2>
    </div>

    <div class="row">
        <div class="col-md-6 order-md-1 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Giỏ hàng của bạn</span>

            </h4>
            <?
            $tong = 0;
            $i = 0;
            $ship = 30000;
            $tongthanhtoan = 0;
            $tongsl = 0;
            $giam_gia = 1;
            foreach ($_SESSION['mycart'] as $cart) {
                $thanhtien = $giam_gia > 0 ? ($cart[2] * $cart[4]) * (100 - $cart[5]) / 100 : $cart[2] * $cart[4];
                $tong = $tong + $thanhtien;
                $tongthanhtoan = $ship + $tong;
                $tongsl += $cart[4];
                $i += 1;
                echo '
              <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Sản Phẩm ' . $i . ': ' . $cart[1] . '</h6>
                  <img  src="../controller/hinh/' . $cart[3] . '"alt="" style="width: 78px; height: 126px">
                  <small class="text-muted">Số lượng:' . $cart[4] . '</small>
                </div>
                <span class="text-muted">' . number_format($cart[2], ) . ' VNĐ</span>
                <span class="text-muted">' . $cart[5] . ' %</span>
                <a href="index.php?page=xoacart&idcart=' . $i . '">  Xóa
                    </a>
              </li>
              ';
            }

            ?>


            <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Tiền Ship</h6>

                </div>
                <span class="text-success">
                        <?= number_format($ship, ) ?> VNĐ
                    </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Tổng tiền</span>
                <strong>
                    <?= number_format($tongthanhtoan) ?> VNĐ
                </strong>
            </li>
            </ul>
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tổng số lượng sản phẩm</span>
                <span class="badge badge-secondary badge-pill">
                        <?= $tongsl ?>
                    </span>
            </h4>
        </div>
        <div class="col-lg-6 order-md-1">
            <h4 class="mb-3">Thông tin</h4>

            <form class="needs-validation" action="" method="post">


                <div class="mb-3">
                    <label for="username">Tên đăng nhập</label>
                    <div class="input-group">

                        <input type="text" name="ten_nd" class="form-control" id="username"
                               placeholder="Nhập vào tên đăng nhập">
                    </div>
                    <?
                    if (!empty($errhoten)) {
                        echo '<p style="color:red;">' . $errhoten . '</p>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="username">Số điện thoại</label>
                    <div class="input-group">
                        <input type="number" name="sdt" class="form-control" id="username"
                               placeholder="Nhập vào số điện thoại">
                    </div>
                    <?
                    if (!empty($errsdt)) {
                        echo '<p style="color:red;">' . $errsdt . '</p>';
                    }
                    ?>
                </div>
                <!-- <div class="mb-3">
                        <label for="email">Email </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                        <?
                // if (!empty($erremail)) {
                //     echo '<p style="color:red;">' . $erremail . '</p>';
                // }
                ?>
                    </div> -->

                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="dia_chi" class="form-control" id="address"
                           placeholder="Nhập vào địa chỉ">
                    <?
                    if (!empty($errdc)) {
                        echo '<p style="color:red;">' . $errdc . '</p>';
                    }
                    ?>
                </div>
                <div class="mb-3">

                    <input type="hidden" name="tong_tien" class="form-control" value=<?= $tongthanhtoan ?>>

                </div>


                <hr class="mb-4">
                <h4 class="mb-3">Phương thức thanh toán</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="pttt" type="radio" class="custom-control-input" value="0">
                        <label class="custom-control-label" for="credit">Thanh toán bằng tiền mặt</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="pttt" type="radio" class="custom-control-input" value="1" checked>
                        <label class="custom-control-label" for="debit">Thanh toán bằng MoMo</label>
                    </div>

                </div>
                <?php
                // $conn = pdo_get_connection();
                $stament = ma_hdLoad();
                // var_dump($stament);
                foreach ($stament as $stam) {
                    extract($stam);


                    ?>


                    <?php

                };

                ?>
                <input id="credit" name="ma_hd" type="hidden" class="custom-control-input"
                       value=" <?= $stam['ma_hd'] ?>">
                <input id="credit" name="ma_hh" type="hidden" class="custom-control-input" value="<?= $cart[0] ?>">
                <input id="credit" name="ten_hh" type="hidden" class="custom-control-input" value="<?= $cart[1] ?>">
                <input id="credit" name="don_gia" type="hidden" class="custom-control-input"
                       value="<?= $cart[2] ?>">
                <input id="credit" name="so_luong" type="hidden" class="custom-control-input" value=<?= $cart[4] ?>>
                <input id="credit" name="giam_gia" type="hidden" class="custom-control-input"
                       value="<?= $cart[5] ?>">
                <input id="credit" name="thanh_tien" type="hidden" class="custom-control-input"
                       value=<?= $tongthanhtoan ?>>
                <input id="credit" name="hinh" type="hidden" class="custom-control-input" value="<?= $cart[3] ?>">

                <hr class="mb-4">
                <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                      action="">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"
                            style="background-color: #FBEE2C; color: #132A1E;">Hoàn thành thanh toán
                    </button>
                </form>


            </form>
        </div>
    </div>


</div>
<style>
    .payCheck {
        text-decoration: none !important;
        color: black;
    }
</style>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/vendor/holder.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';

        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>

</html>