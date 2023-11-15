<?

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// if ($_SERVER["REQUEST_METHOD"] === "POST") {

//     // Lấy thông tin từ form
//     $id = isset($_POST["id"]) ? $_POST["id"] : '';
//     $tenSP = isset($_POST["tenSP"]) ? $_POST["tenSP"] : '';
//     $gia = isset($_POST["gia"]) ? $_POST["gia"] : '';
//     $status = isset($_POST["status"]) ? $_POST["status"] : '';
//     $tacGia = isset($_POST["tacGia"]) ? $_POST["tacGia"] : '';
//     $catID = isset($_POST["category"]) ? $_POST["category"] : '';
//     $soLuong = isset($_POST["qty"]) ? $_POST["qty"] : '';

//     // Kiểm tra tính hợp lệ của các trường
//     $errors = array();

//     if (empty($id)) {
//         $errors= "Vui lòng nhập mã sản phẩm.";
//     } elseif (empty($tenSP)) {
//         $errors['tenSp'] = "Vui lòng nhập tên sản phẩm.";
//     } elseif (empty($gia)) {
//         $errors['gia'] = "Vui lòng nhập giá sản phẩm.";
//     } elseif (empty($soLuong)) {
//         $errors['qty'] = "Vui lòng nhập số lượng sản phẩm.";
//     } elseif (empty($status)) {
//         $errors['status'] = "Vui lòng chọn tình trạng sản phẩm.";
//     } elseif (empty($tacGia)) {
//         $errors['tacGia'] = "Vui lòng nhập tác giả.";
//     } elseif (empty($catID)) {
//         $errors['category'] = "Vui lòng nhập danh mục.";
//     }

//     if (isset($_FILES['upload'])) {
//         foreach ($_FILES['upload'] as $itemImg) {
//             if (empty($itemImg)) {
//                 $errorsImg = true;
//                 break;
//             }
//         }
//     }

//     if (isset($_FILES['upload']) && is_array($_FILES['upload']['tmp_name'])) {


//         $images = array();

//         for ($i = 0; $i < sizeof($_FILES['upload']['name']); $i++) {
//             $arrayItem = array(
//                 "name" => $_FILES['upload']['name'][$i],
//                 "type" => $_FILES['upload']['type'][$i],
//                 "tmp_name" => $_FILES['upload']['tmp_name'][$i],
//                 "error" => $_FILES['upload']['error'][$i],
//                 "size" => $_FILES['upload']['size'][$i],
//             );
//             array_push($images, $arrayItem);
//         }


//         if (sizeof($errors) == 0) {
//             $insertProducts = "INSERT INTO  products (id, cat_id, name, price, qty , trangThai) 
//             VALUES('".$id."','".$catID."', '".$tenSP."', '".$gia."', '".$soLuong."','".$status."')";
//             $resPro = $connect->query($insertProducts);

//             // echo $insertProducts;
//             // echo '<br>';
//             // print_r($images);
//             if ($resPro) {
//                 // $prodID = $connect->insert_id;
//                 // echo $prodID;
//                 $target_directory = 'hinh/';
//                 $uploadError = false;
//                 foreach ($images as $item) {
//                     $file = $item['tmp_name'];
//                     $error = $item['error'];
//                     $name = microtime(true) * 1000;
//                     $path = $target_directory . $name . '.jpg';
//                     if ($error == 0) {
//                         if (move_uploaded_file($file, $path)) {
//                             $insertImg = "INSERT INTO images (product_id, path) VALUES(".$id.",'".$name.".jpg')";
//                             $connect->query($insertImg);

//                         } else {
//                             $uploadError = true;

//                         }
//                     } else {
//                         $uploadError = true;

//                     }
//                     sleep(0.1);
//                 }
//                 if ($uploadError) {
//                     // echo "<script type='text/javascript'>alert('Đã có lỗi xảy ra');</script>";
//                     echo $error;
//                 } else {
//                     echo "<script type='text/javascript'>alert('Thêm sản phẩm thành công');</script>";
//                 //   hiển thi ra url images
//                     // $prodID = $connect->insert_id;
//                     $selectImages = "SELECT path FROM images WHERE product_id = ".$prodID;
//                     $resultImages = $connect->query($selectImages);
//                     while ($row = $resultImages->fetch_assoc()) {
//                         echo "Image URL: " . $target_directory . $row['path'] . "<br>";
//                     }
//                 }
//             } else {
//                 echo "<script type='text/javascript'>alert('Đã có lỗi xảy ra');</script>";

//             }
//         } 


//     }


// }
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
    <!-- /.card-header -->
    <!-- form start -->
    <?


    ?>

    <form method="post" action="index.php?page=update_kh" enctype="multipart/form-data">
        <?php
        // extract($dskhachhang);
        ?>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Mã Khách Hàng</label>
                <input type="text" class="form-control" name="ma_kh" value="<?= $ma_kh ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên Khách Hàng</label>
                <input type="text" name="ten_kh" value="<?= $ten_kh ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input value="<?= $email ?>" type="email" name="email" class="form-control">
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
                <label>mật khẩu</label>
                <input value="<?= $mat_khau ?>" type="password" name="mat_khau" class="form-control">
            </div>
            <div class="form-group">
                <label>Avatar</label>
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
                    <input class="btn btn-outline-primary btn-md  " name="updateKhachHang" value="Cập nhật"
                           type="submit"></input>

                    <input class="btn btn-outline-primary btn-md  " value="Nhập lại"
                           type="submit"></input>

                    <a name="" id="" class="btn btn-outline-primary btn-md" href="index.php?page=listdanhmuc"
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

