<?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $dc = isset($_POST['dc']) ? $_POST['dc'] : '';
    if (empty($hoten)) {
        $errhoten = "Họ Tên Trống";
    }
    if (empty($email)) {
        $erremail = "Email Trống";
    }
    if (empty($sdt)) {
        $errsdt = "Số Điện Thoại Trống";
    }
    if (empty($dc)) {
        $errdc = "Địa Chỉ Trống";
    }
    if (!isset($errhoten) && !isset($erremail) && !isset($errsdt) && !isset($errdc)) {
        header('Location: index.php?page=orderComplete');
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
        <div class="col-md-4 order-md-1 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Giỏ hàng của bạn</span>

            </h4>
            <?
            $tong = 0;
            $i = 0;
            $ship = 30000;
            $tongthanhtoan = 0;
            $tongsl = 0;
            foreach ($_SESSION['mycart'] as $cart) {
                $thanhtien = $cart[2] * $cart[4];
                $tong = $tong + $thanhtien;
                $tongthanhtoan = $ship + $tong;
                $tongsl += $cart[4];
                $i += 1;
                echo '
              <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Sản Phẩm ' . $i . ': ' . $cart[1] . '</h6>
                  <small class="text-muted">Số lượng:' . $cart[4] . '</small>
                </div>
                <span class="text-muted">' . number_format($cart[2],) . ' VNĐ</span>
              </li>
              ';
            }

            ?>

            <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Giảm giá</h6>
                    <small>Mã giảm giá</small>
                </div>
                <span class="text-success">0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Tiền Ship</h6>

                </div>
                <span class="text-success">
            <?= number_format($ship,) ?> VNĐ
          </span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Tổng tiền</span>
                <strong>
                    <?= number_format($tongthanhtoan,) ?> VNĐ
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
        <div class="col-lg-8 order-md-1">
            <h4 class="mb-3">Thông tin</h4>
            <form class="needs-validation" action="" method="post">
                <div class="row">
                    <!-- <div class="col-md-6 mb-3">
                        <label for="firstName">Họ</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Nhập vào họ" value="" required>
                        <div class="invalid-feedback">
                          Vui lòng nhập vào họ
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="lastName">Tên</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Nhập vào tên" value="" required>
                        <div class="invalid-feedback">
                        Vui lòng nhập vào tên
                        </div>
                      </div> -->
                </div>

                <div class="mb-3">
                    <label for="username">Tên đăng nhập</label>
                    <div class="input-group">

                        <input type="text" name="hoten" class="form-control" id="username"
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
                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                    <?
                    if (!empty($erremail)) {
                        echo '<p style="color:red;">' . $erremail . '</p>';
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="dc" class="form-control" id="address" placeholder="Nhập vào địa chỉ">
                    <?
                    if (!empty($errdc)) {
                        echo '<p style="color:red;">' . $errdc . '</p>';
                    }
                    ?>
                </div>


                <!-- <hr class="mb-4"> -->
                <!-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Tôi cam kết thông tin trên là đúng</label>
                  </div> -->


                <hr class="mb-4">
                <button type="submit" class="btn btn-primary btn-lg btn-block"
                        style="background-color: #FBEE2C; color: #132A1E;">Thanh Toán
                </button>

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