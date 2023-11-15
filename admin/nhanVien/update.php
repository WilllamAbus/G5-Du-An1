<?php

if (is_array($employee)) {
    extract($employee);
}
$hinhpath = "../controller/hinh/users/" . $hinh;
if (is_file($hinhpath)) {
    $hinh = "<img src='" . $hinhpath . "' height='80' width='150'>";
} else {
    $hinh = "no photo";
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
        <h3 class="card-title">QUẢN LÝ NHÂN VIÊN</h3>

    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php


    ?>


    <form method="post" action="index.php?page=update_nv" enctype="multipart/form-data">


        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Mã Nhân Viên</label>
                <input type="text" class="form-control" name="ma_nv" value="<?= $ma_nv ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Nhân Viên</label>
                <input type="text" name="ten_nv" value="<?= $ten_nv ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $email ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Số Điện Thoại</label>
                <input value="<?= $sdt ?>" type="number" name="sdt" class="form-control">
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input value="<?= $dia_chi ?>" type="text" name="dia_chi" class="form-control">
            </div>
            <div class="form-group">
                <label>Ngày Sinh</label>
                <input value="<?= $ngay_sinh ?>" type="date" name="ngay_sinh" class="form-control">
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input value="<?= $mat_khau ?>" type="password" name="mat_khau" class="form-control">
            </div>
            <div class="form-group">
                <label>Hình</label>
                <p><?= $hinh ?></p>
                <input class="form-control" type="file" name="hinh"/>
            </div>
            <div class="form-group">
                <label>Vai trò</label>
                <div>
                    <label><input <?= !$vai_tro ? 'checked' : '' ?> name="vai_tro" value="1" type="radio">Nhân
                        viên</label>
                    <label><input <?= $vai_tro ? 'checked' : '' ?> name="vai_tro" value="0" type="radio">Khách
                        hàng</label>
                </div>
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <div>
                    <label><input <?= !$gioi_tinh ? 'checked' : '' ?> name="gioi_tinh" value="1"
                                                                      type="radio">Nam</label>
                    <label><input <?= $gioi_tinh ? 'checked' : '' ?> name="gioi_tinh" value="0" type="radio">Nữ</label>
                </div>
            </div>
            <div class="form-group">
                <label>Kích hoạt</label>
                <div>
                    <label><input <?= !$kich_hoat ? 'checked' : '' ?> name="kich_hoat" value="0" type="radio">Vô hiệu
                        hóa</label>
                    <label><input <?= $kich_hoat ? 'checked' : '' ?> name="kich_hoat" value="1" type="radio">Kích
                        hoạt</label>
                </div>

                <?php
                if (isset($thongbao) && ($thongbao != ""))
                    echo $thongbao;
                ?>
            </div>


            <div class="d-grid">
                <div class="col-3   mb-3 ">
                    <input class="btn btn-outline-primary btn-md  " name="updateNV" value="Cập nhật"
                           type="submit"></input>

                    <input class="btn btn-outline-primary btn-md  " value="Nhập lại"
                           type="submit"></input>

                    <a name="" id="" class="btn btn-outline-primary btn-md" href="index.php?page=dsNhanVien"
                       role="button">Danh sách</a>

                </div>
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

