<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_hh = $_POST['ma_hh'];
    $ten_hh = $_POST['ten_hh'];
    $don_gia = $_POST['don_gia'];
    $so_luong = $_POST['so_luong'];
    $giam_gia = $_POST['giam_gia'];
    $thanh_tien = $_POST['thanh_tien'];
    $hinh = $_POST['hinh'];
    $ma_cthd = $_POST['ma_cthd'];
    $ma_nv = $_POST['ma_nv'];
    $ma_nd = $_POST['ma_nd'];


    khach_hang_insert($ma_nd, $ma_hh, $thanh_tien, $so_luong, $don_gia, $giam_gia, $hinh, $ten_hh, $ma_cthd, $ma_nv);
    echo "<script>alert('Thêm thành công!');</script>";

    //   //     // $sql="insert into khach_hang(ma_kh, ten_kh, email,  sdt , dia_chi , ngay_sinh ,mat_khau, hinh, vai_tro, kich_hoat)
    //   //     // values(:ma_kh,:ten_kh,:email,:sđt,?,?,?,?,?,?)";

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
    <!-- bs5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
<div class="card card-info">
    <h1 style="color:red">
        <?php

        if (isset($MESSAGE)) {
            echo $MESSAGE;
            unset($MESSAGE);
        }
        ?>
    </h1>
    <div class="card-header">
        <h3 class="card-title">QUẢN LÝ KHÁCH HÀNG</h3>

    </div>

    <?php

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
    };
    ?>

    <form action="index.php?page=customer" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="">Mã Khách Hàng

                </label>

                <input class="form-control" type="text" name="ma_kh" disabled>
            </div>
            <?php
            if (isset($thongbao) && ($thongbao != ""))
                echo $thongbao;
            ?>

        </div>
        <?
        $mahdctLoad = ma_hdctLoad();
        foreach ($mahdctLoad as $mahdct) {
            extract($mahdct);
        }
        ?>

        <?
        $mandLoad = ma_ndLoad();
        foreach ($mandLoad as $mand) {
            extract($mand);
        }
        ?>
        <?
        $manvLoad = ma_nvLoad();
        foreach ($manvLoad as $manv) {
            extract($manv);
        }
        ?>
        <div class="card-body">
            <input id="credit" name="ma_nv" type="hidden" class="custom-control-input"
                   value=" <?= $manv['ma_nv'] ?>">
            <input id="credit" name="ma_nd" type="hidden" class="custom-control-input"
                   value=" <?= $mand['ma_nd'] ?>">
            <input id="credit" name="ma_cthd" type="hidden" class="custom-control-input"
                   value=" <?= $mahdct['ma_cthd'] ?>">
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


        </div>

        <!-- /.card-body -->

        <div class="d-grid">
            <div class="col-3   mb-3 ">
                <input class="btn btn-outline-primary btn-md  " name="themMoi" value="Thêm mới"
                       type="submit"></input>


                <a name="" id="" class="btn btn-outline-primary btn-md" href="index.php?page=dsKhachHang"
                   role="button">Danh sách</a>

            </div>
        </div>


    </form>

</div>


<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>

</html>