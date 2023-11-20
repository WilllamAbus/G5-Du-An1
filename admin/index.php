<?php
session_start();

?>

<?php
include_once("../common/global.php");
include_once("../dao/pdo.php");

include_once("../dao/loai.php");
include_once("../dao/hang-hoa.php");
include_once("../dao/khach-hang.php");
include_once "../dao/thong-ke.php";
include_once "../dao/nhan_vien.php";
include_once "../dao/phan-hoi-binh-luan.php  ";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminBible | Dashboard</title>
    <link rel="stylesheet" href="../controller/hinh/users/
  <!-- Google Font: Source Sans Pro -->
  <link rel=" stylesheet
    "
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">


<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php
    include "template/header.php";

    include "template/slidebar.php";
    ?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <?php
                extract($_REQUEST);
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    switch ($page) {
                        case "dashboard":
                            include("dashboard.php");
                            break;

                        case "addProduct":
                            check_login();
                            if (exist_param('themMoi')) {

                                $ten_hh = $_POST['ten_hh'];
                                $don_gia = $_POST['don_gia'];
                                $giam_gia = $_POST['giam_gia'];
                                $ma_loai = $_POST['ma_loai'];
                                $mo_ta = $_POST['mo_ta'];
                                $ngay_nhap = $_POST['ngay_nhap'];
                                $so_luong = $_POST['so_luong'];
                                $hinh = $_FILES['hinh']['name'];
                                $target_dir = "../controller/hinh/hangHoa/";
                                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                                $conn = pdo_get_connection();


                                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                                    echo "The file  has been uploaded.";
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }

                                $errors = array();

                                if (empty($ten_hh)) {
                                    $errors['ten_hh'] = 'Tên hàng hóa không được để trống';
                                } elseif (strlen($ten_hh) < 5) {
                                    $errors['ten_hh'] = 'Tên hàng hóa phải có độ dài tối thiểu là 5 ký tự';
                                } elseif (strlen($ten_hh) > 255) {
                                    $errors['ten_hh'] = 'Tên hàng hóa phải có độ dài tối đa là 255 ký tự';
                                }

                                if (empty($don_gia)) {
                                    $errors['don_gia'] = 'Đơn giá không được để trống';
                                } elseif ($don_gia < 0) {
                                    $errors['don_gia'] = 'Đơn giá không được nhỏ hơn 0';
                                }

                                if (empty($giam_gia)) {
                                    $errors['giam_gia'] = 'Giảm giá không được để trống';
                                } elseif ($giam_gia < 0 || $giam_gia > 1) {
                                    $errors['giam_gia'] = 'Giảm giá phải là số từ 0 đến 1';
                                }

                                if (empty($ngay_nhap)) {
                                    $errors['ngay_nhap'] = 'Ngày nhập không được để trống';
                                } else {
                                    $ngay_nhap = date('Y-m-d', strtotime($ngay_nhap));
                                    if (strtotime($ngay_nhap) > time()) {
                                        $errors['ngay_nhap'] = 'Ngày nhập phải trước ngày hiện tại';
                                    }
                                }

                                if (count($errors) > 0) {
                                    $thongbao = implode('<br>', $errors);
                                } else {
                                    $sql = "INSERT INTO hang_hoa(ten_hh, don_gia, giam_gia, hinh, ma_loai, ngay_nhap, so_luong, mo_ta) 
                      VALUES (:ten_hh, :don_gia, :giam_gia, :hinh, :ma_loai, :ngay_nhap, :so_luong, :mo_ta)";

                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':ten_hh', $ten_hh);
                                    $stmt->bindParam(':don_gia', $don_gia);
                                    $stmt->bindParam(':giam_gia', $giam_gia);
                                    $stmt->bindParam(':so_luong', $so_luong);
                                    $stmt->bindParam(':hinh', $hinh);
                                    $stmt->bindParam(':ma_loai', $ma_loai);
                                    $stmt->bindParam(':ngay_nhap', $ngay_nhap);
                                    $stmt->bindParam(':mo_ta', $mo_ta);

                                    $stmt->execute();
                                    $thongbao = "Thêm thành công";
                                }

                            }


                            $listdanhmuc = loadall_danhmuc();
                            include "hangHoa/pikTem.php";
                            break;

                        case 'listProduct':

                            if (isset($_POST['searchList']) && ($_POST['searchList'])) {
                                $inputProduct = $_POST['inputProduct'];
                                $ma_loai = $_POST['ma_loai'];
                            } else {
                                $inputProduct = '';
                                $ma_loai = 0;
                            }
                            $listdanhmuc = loadall_danhmuc();
                            $listProduct = loadall_sanpham($inputProduct, $ma_loai);
                            include "hangHoa/list.php";
                            break;
                        // -------------------END DANH SÁCH SẢN PHẨM-------------------//

                        case 'xoasp':

                            if (isset($_GET['ma_hh']) && ($_GET['ma_hh'] > 0)) {

                                delete_sanpham($_GET['ma_hh']);
                            }
                            $listProduct = loadall_sanpham();
                            include "hangHoa/list.php";
                            break;
                        // -----------------END XÓA SẢN PHẨM--------------------------

                        case 'suasp':
                            if (isset($_GET['ma_hh']) && ($_GET['ma_hh'] > 0)) {
                                $sanpham = loadone_sanpham($_GET['ma_hh']);
                            }
                            $listdanhmuc = loadall_danhmuc();
                            include "hangHoa/update.php";
                            break;
                        // ---------------END lẤY SẢN PHẨM CẦN SỬA--------------------//
                        case 'updateProduct':

                            if (exist_param('updateProduct')) {
                                $ma_hh = $_POST['ma_hh'];
                                $ten_hh = $_POST['ten_hh'];
                                $don_gia = $_POST['don_gia'];
                                $giam_gia = $_POST['giam_gia'];
                                $mo_ta = $_POST['mo_ta'];
                                $ngay_nhap = $_POST['ngay_nhap'];
                                $dac_biet = $_POST['dac_biet'];
                                $so_luot_xem = $_POST['so_luot_xem'];
                                $hinh = $_FILES['hinh']['name'];
                                $target_dir = "../controller/hinh/hangHoa/";
                                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                                $conn = pdo_get_connection();


                                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                                    echo "The file  has been uploaded.";
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }
                                update_sanpham($ma_hh, $ten_hh, $don_gia, $giam_gia, $mo_ta, $ngay_nhap, $dac_biet, $so_luot_xem, $hinh);
                                $thongbao = "Cập nhật thành công";
                            }
                            $listdanhmuc = loadall_danhmuc();
                            $listProduct = loadall_sanpham();
                            include("hangHoa/list.php");
                            break;


                        case "addCategories":
                            if (isset($_POST['themMoi']) && $_POST['themMoi']) {

                                $ten_loai = isset($_POST["ten_loai"]) ? $_POST["ten_loai"] : '';
                                $errors = array();
                                if (empty($ten_loai)) {
                                    $errors['ten_loai'] = 'Tên loại không được để trống';
                                }
                                if (loai_exist($ten_loai)) {
                                    $errors['ten_loai'] = 'Tên loại đẵ tồn tại';
                                }
                                if (!isset($errors['ten_loai'])) {
                                    $ten_loai = $_POST['ten_loai'];
                                    insert_danhmuc($ten_loai);
                                    $thongbao = "Thêm thành công";
                                }

                            }
                            include("loaiHang/categories.php");
                            break;

                        // -------------------------------THÊM DANH MỤC============================
                        case 'listdanhmuc':

                            $listdanhmuc = loai_hang_select_page();
                            include("loaiHang/list.php");
                            break;

                        //   // // -------------END DANH SÁCH DANH MỤC
                        case 'xoadanhmuc':

                            if (isset($_GET['ma_loai']) && ($_GET['ma_loai'] > 0)) {
                                delete_danhmuc($_GET['ma_loai']);
                            }
                            $listdanhmuc = loadall_danhmuc();
                            include("./loaiHang/list.php");
                            break;
                        //   // //--------------------END XOA DANH MUC

                        case 'suadanhmuc':
                            if (isset($_GET['ma_loai']) && ($_GET['ma_loai'] > 0)) {
                                $dm = loadone_danhmuc($_GET['ma_loai']);
                            }

                            include("loaiHang/update.php");
                            break;
                        case 'updatedm':
                            if (isset($_POST['capNhat']) && ($_POST['capNhat'])) {
                                $ten_loai = $_POST['ten_loai'];
                                $ma_loai = $_POST['ma_loai'];
                                update_danhmuc($ma_loai, $ten_loai);
                                $thongbao = "Cập nhật thành công";
                            }
                            $listdanhmuc = loadall_danhmuc();
                            include("loaiHang/list.php");
                            break;
                        //   // //------------KẾT THÚC DANH SÁCH DANH MỤC------------------------------------

                        case 'dsKhachHang':
                            $listKhachHang = loadall_khachhang();
                            include("khachHang/list.php");
                            break;
                        case "customer":


                        include("khachHang/customer.php");
                            break;
                        case 'xoakh':


                            if (isset($_GET['ma_kh']) && ($_GET['ma_kh'] > 0)) {
                                khach_hang_delete($_GET['ma_kh']);
                            }
                            $listKhachHang = loadall_khachhang();

                            include("khachHang/list.php");
                            break;

                        case 'suakh':

                            if (isset($_GET['ma_kh']) && ($_GET['ma_kh'] > 0)) {
                                $dskhachhang = loadone_khachhang($_GET['ma_kh']);
                            }


                            //   //   //     var_dump($dskhachhang); die();
                            include("khachHang/update.php");
                            break;

                        case 'update_kh':


                            if (exist_param('updateKhachHang')) {
                                $ma_kh = $_POST['ma_kh'];
                                $ten_kh = $_POST['ten_kh'];
                                $email = $_POST['email'];
                                $dia_chi = $_POST['dia_chi'];
                                $ngay_sinh = $_POST['ngay_sinh'];
                                $mat_khau = $_POST['mat_khau'];
                                $kich_hoat = $_POST['kich_hoat'];
                                $sđt = $_POST['sdt'];

                                $vai_tro = $_POST['vai_tro'];
                                $hinh = $_FILES['hinh']['name'];
                                $hinh = $_FILES['hinh']['name'];
                                $target_dir = "../controller/hinh/users/";
                                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                                move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file);
                                // var_dump($hinh);die;
                                khachhang_update($ma_kh, $ten_kh, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $vai_tro, $kich_hoat);
                                $thongbao = "Cập nhật thành công";
                            }
                            $listKhachHang = loadall_khachhang();
                            include("khachHang/list.php");
                            break;
                        //   // // end khach hang
                        case "membered":
                            if (exist_param('themMoi')) {
                                $ma_nv = $_POST['ma_nv'];
                                $ten_nv = $_POST['ten_nv'];
                                $email = $_POST['email'];
                                $dia_chi = $_POST['dia_chi'];
                                $ngay_sinh = $_POST['ngay_sinh'];
                                $mat_khau = $_POST['mat_khau'];
                                $kich_hoat = $_POST['kich_hoat'];
                                $sđt = $_POST['sdt'];
                                $vai_tro = $_POST['vai_tro'];
                                $gioi_tinh = $_POST['gioi_tinh'];
                                $hinh = $_FILES['hinh']['name'];
                                $target_dir = "../controller/hinh/users/";
                                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                                $conn = pdo_get_connection();


                                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                                    echo "The file  has been uploaded.";
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }

                                $errors = array();

                                if (empty($ma_nv)) {
                                    $errors['ma_nv'] = 'Tên nhân viên không được để trống';
                                } elseif (strlen($ma_nv) < 6) {
                                    $errors['ma_nv'] = 'Tên nhân viên phải có độ dài tối thiểu là 6 ký tự';
                                } elseif (!preg_match('/[NV]/', $ma_nv)) {
                                    $errors['ma_nv'] = 'Mã Nhân Viên phải có kí tự NV phía trước số';
                                }

                                if (empty($ten_nv)) {
                                    $errors['ten_nv'] = 'Tên nhân viên không được để trống';
                                } elseif (strlen($ten_nv) < 8) {
                                    $errors['ten_nv'] = 'Tên nhân viên phải có độ dài tối thiểu là 8 ký tự';
                                }

                                if (empty($mat_khau)) {
                                    $errors['mat_khau'] = 'Mật khẩu không được để trống';
                                } elseif (strlen($mat_khau) < 8) {
                                    $errors['mat_khau'] = 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự';
                                } elseif (!preg_match('/[A-Z]/', $mat_khau) && !preg_match('/[a-z]/', $mat_khau) && !preg_match('/\[@\#</span>%^&*()_+|~=`{}:"<>?,.]/', $mat_khau)) {
                                    $errors['mat_khau'] = 'Mật khẩu phải chứa ít nhất một ký tự in hoa, một ký tự in thường, một ký tự số và một ký tự đặc biệt';
                                }

                                if (empty($email)) {
                                    $errors['email'] = 'Email không được để trống';
                                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $errors['email'] = 'Email không đúng định dạng';
                                }

                                if (empty($sđt)) {
                                    $errors['sđt'] = 'Số điện thoại không được để trống';
                                }


                                if (empty($ngay_sinh)) {
                                    $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
                                }

                                if (count($errors) > 0) {
                                    $thongbao = implode('<br>', $errors);
                                } else {
                                    nhan_vien_insert(
                                        $ma_nv,
                                        $ten_nv,
                                        $email,
                                        $sđt,
                                        $dia_chi,
                                        $ngay_sinh,
                                        $mat_khau,
                                        $hinh,
                                        $vai_tro,
                                        $kich_hoat,
                                        $gioi_tinh
                                    );
                                    $thongbao = "Thêm thành công";
                                }

                                //   //     // $sql="insert into khach_hang(ma_kh, ten_kh, email,  sdt , dia_chi , ngay_sinh ,mat_khau, hinh, vai_tro, kich_hoat)
                                //   //     // values(:ma_kh,:ten_kh,:email,:sđt,?,?,?,?,?,?)";

                            }
                            include("nhanVien/member.php");
                            break;

                        case 'dsNhanVien':
                            $listNhanVien = loadall_nhanvien();
                            include("nhanVien/list.php");
                            break;
                        case 'xoanv':


                            if (isset($_GET['ma_nv']) && ($_GET['ma_nv'])) {
                                delete_nhanvien($_GET['ma_nv']);

                            }
                            $listNhanVien = loadall_nhanvien();

                            include("nhanVien/list.php");
                            break;

                        case 'suanv':

                            if (isset($_GET['ma_nv']) && ($_GET['ma_nv'])) {

                                $employee = loadone_nhanvien($_GET['ma_nv']);

                            }

                            // Get employee data


                            // Display employee information in the form

                            //   //   //     var_dump($dskhachhang); die();
                            include("nhanVien/update.php");
                            break;

                        case 'update_nv':


                            if (isset($_POST['updateNV']) && ($_POST['updateNV'])) {
                                $ma_nv = $_POST['ma_nv'];
                                $ten_nv = $_POST['ten_nv'];
                                $email = $_POST['email'];
                                $dia_chi = $_POST['dia_chi'];
                                $ngay_sinh = $_POST['ngay_sinh'];
                                $mat_khau = $_POST['mat_khau'];
                                $kich_hoat = $_POST['kich_hoat'];
                                $sdt = $_POST['sdt'];
                                $gioi_tinh = $_POST['gioi_tinh'];
                                $vai_tro = $_POST['vai_tro'];

                                $hinh = $_FILES['hinh']['name'];
                                $target_dir = "../controller/hinh/users/";
                                $target_file = $target_dir . basename($_FILES["hinh"]["name"]);
                                if (move_uploaded_file($_FILES["hinh"]["tmp_name"], $target_file)) {
                                    echo "The file  has been uploaded.";
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }
                                // var_dump($hinh);die;
                                update_nhanVien(
                                    $ma_nv,
                                    $ten_nv,
                                    $email,
                                    $sdt,
                                    $dia_chi,
                                    $ngay_sinh,
                                    $mat_khau,
                                    $hinh,
                                    $vai_tro,
                                    $kich_hoat,
                                    $gioi_tinh
                                );
                                $thongbao = '<script>alert("Cập nhật thành công")</script>';
                            }
                            $listNhanVien = loadall_nhanvien();
                            include("nhanVien/list.php");
                            break;
                        case 'thong-ke':

                            include_once "../dao/thong-ke.php";
                            //   //   // $list_statistics_month =thong_ke_doanh_thu_thang();
                            //   //   // // dd($list_statistics_month);
                            $listthongke = thong_ke_doanh_thu_by_hang_hoa();

                            include "thongKe/list.php";
                            break;
                        case 'staticsChart':

                            include_once "../dao/thong-ke.php";
                            //   //   // $list_statistics_products = thong_ke_hang_hoa();
                            //   //   // $list_statistics_month =thong_ke_doanh_thu_thang();
                            //   //   // // dd($list_statistics_month);
                            $listthongke = thong_ke_doanh_thu_by_hang_hoa();
                            include "thongKe/staticChart.php";


                            break;

                        //   // //*********************************THỐNG KÊ*************************************** */
                        case 'dsbinhluan':

                            include_once "../dao/thong-ke.php";
                            include_once "../dao/binh-luan.php";
                            $items = thong_ke_binh_luan();
                            include "binhLuan/list.php";
                            break;
                        case 'chi-tiet-binh-luan':

                            include_once "../dao/binh-luan.php";
                            if (isset($_GET["ma_hh"])) {
                                $items = binh_luan_select_by_hang_hoa($ma_hh);
                                if (count($items) == 0) {
                                    $items = thong_ke_binh_luan();
                                    include "binhLuan/list.php";
                                } else {
                                    include "binhLuan/detail.php";
                                }
                            } else {
                                $items = thong_ke_binh_luan();
                                include "binhLuan/list.php";
                            }
                            break;
                        case 'xoa-binh-luan':

                            include_once "../dao/thong-ke.php";
                            include_once "../dao/binh-luan.php";
                            if (isset($_GET["ma_bl"])) {
                                try {
                                    binh_luan_delete($ma_bl);
                                    $MESSAGE = "Xóa thành công!";
                                } catch (Exception $exc) {
                                    $MESSAGE = "Xóa thất bại!";
                                }
                            }
                            $items = thong_ke_binh_luan();
                            include "binhLuan/list.php";
                            break;
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                        case 'phan-hoi-binh-luan':

                            // extract($_REQUEST);
                            if (exist_param('phanHoiBL')) {
                                $ma_bl = $_POST['ma_bl'];
                                $ma_hh = $_POST['ma_hh'];
                                $phan_hoi = $_POST['phan_hoi'];
                                $ma_nv = $_COOKIE['user_admin'];
                                $ngay_them = date_create()->format('Y-m-d H:i:s');
                                phan_hoi_binh_luan_insert($ma_bl, $ma_nv, $ma_hh, $phan_hoi, $ngay_them);
                            } else {
                                echo "<script>alert('Phản hồi không thành công')</script>";
                            }
                            $items = thong_ke_binh_luan();
                            // $ma_hh = '';
                            // if (isset($_GET['ma_hh'])) {
                            //     extract($_REQUEST);
                            //     $ma_hh = $_GET['ma_hh'];


                            //   }else{

                            //   }


                            include "binhLuan/list.php";
                            break;
                        case "logout":
                            include("logout.php");
                            break;
                        default:
                            include "template/home.php";
                            break;
                    }
                } else {
                    include "template/home.php";
                }

                ?>


            </div>
        </div>
    </div>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">


                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <h1 class="m-0">Dashboard</h1> -->
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <p>

                            </p>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include("template/footer.php");
?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>