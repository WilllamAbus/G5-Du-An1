<?php
session_start();
ob_start();

include 'user/components/stylesshet.php';
include 'user/components/header.php';
require_once '../common/global.php';
include_once '../dao/hang-hoa.php';
include_once '../dao/loai.php';
include_once '../dao/user.php';
include_once '../dao/binh-luan.php';
include_once '../dao/phan-hoi-binh-luan.php';
include_once '../dao/pdo.php';
include_once '../dao/cart.php';
?>

<?
// include './account/changePass.php';
// include 'slider.php'; 
// include 'support.php'; 
// include 'category.php'; 
$hh = loadall_sanpham("", 0);
if (isset($_GET["page"])) {
    switch ($_GET["page"]) {
        case 'trangchu':
            include 'user/view/home.php';
            break;
        case 'sanpham':
            if (isset($_POST['inputProduct']) && ($_POST['inputProduct'])) {
                $inputProduct = $_POST['inputProduct'];
            } else {
                $inputProduct = " ";
            }
            if (isset($_GET['maloai']) && ($_GET['maloai'] > 0)) {
                $ma_loai = $_GET['maloai'];
            } else {
                $ma_loai = 0;

            }
            $hh = loadall_sanpham($inputProduct, $ma_loai);

            // $product = san_pham_select_trend();
            include 'user/product/product.php';
            break;

        case 'giohang':
            if (!isset($_COOKIE['ma_nd'])) {
                header('Location: index.php?page=login');
                exit();
            }
            if (!isset($_SESSION['mycart']))
                $_SESSION['mycart'] = [];
            if (isset($_POST['addcart']) && ($_POST['addcart'])) {
                $mahh = $_POST['mahh'];
                $tenhh = $_POST['tenhh'];
                $dongia = $_POST['dongia'];
                $hinh = $_POST['hinh'];
                $soluong = $_POST['soluong'];
                $giam_gia = $_POST['giamgia'];
                $fl = 0;
                for ($i = 0; $i < sizeof($_SESSION['mycart']); $i++) {
                    if ($_SESSION['mycart'][$i][1] == $tenhh) {
                        $fl = 1;
                        $soluongnew = $soluong + $_SESSION['mycart'][$i][4];
                        $_SESSION['mycart'][$i][4] = $soluongnew;
                        break;
                    }
                }
                if ($fl == 0) {

                    $hanghoa = [$mahh, $tenhh, $dongia, $hinh, $soluong, $giam_gia];
                    $_SESSION['mycart'][] = $hanghoa;
                }

            }
            include 'user/cart/cart.php';
            break;
        case 'xoacart':
            if (isset($_SESSION['mycart'])) {
                if (isset($_GET['idcart'])) {

                    array_splice($_SESSION['mycart'], $_GET['idcart'], 1);

                } else {
                    unset($_SESSION['cartmy']);
                }

                // if(count($_SESSION['cart'])>0) header('location: cart.php')  ;
                //    else  header('location: productPage.php');


            }
            include 'user/cart/cart.php';

            break;
        case 'checkout':
            include 'user/cart/checkout.php';
            break;
        case 'myorder':
            include 'user/cart/myorder.php';
            break;
            case 'huyhd':
                if (isset($_GET['ma_hd'])) {
                    $ma_hd = $_GET['ma_hd'];
                        don_hang_delete($ma_hd);
                }
                $dshd = don_hang_select_all();
                include 'user/cart/myorder.php';
                break;
            case 'myorderDetail':
                if (isset($_GET['ma_hd'])) {
                    $ma_hd = $_GET['ma_hd'];
                    $dshd = chi_tiet_don_hang($ma_hd);
                    include 'user/cart/myorderDetail.php';
                }
                break;
                case 'theogia':
                    if(isset($_POST['loc1']) && $_POST['loc1'] ){
                        $loc1 = $_POST['loc1'];
                        $hhtheogia = load_hang_hoa_gia_0_100000($loc1,$loc2 = "",$loc3 = "",$loc4 = "",$loc5 = "" );
                    }
                    if(isset($_POST['loc2']) && $_POST['loc2'] ){
                        $loc2 = $_POST['loc2'];
                        $hhtheogia = load_hang_hoa_gia_0_100000($loc1= "",$loc2 ,$loc3 = "",$loc4 = "",$loc5 = "" );
                    }
                    if(isset($_POST['loc3']) && $_POST['loc3'] ){
                        $loc3 = $_POST['loc3'];
                        $hhtheogia = load_hang_hoa_gia_0_100000($loc1= "",$loc2 = "",$loc3 ,$loc4 = "",$loc5 = "" );
                    }
                    if(isset($_POST['loc4']) && $_POST['loc4'] ){
                        $loc4= $_POST['loc4'];
                        $hhtheogia = load_hang_hoa_gia_0_100000($loc1= "",$loc2 = "",$loc3 = "",$loc4 ,$loc5 = "" );
                    }
                    if(isset($_POST['loc5']) && $_POST['loc5'] ){
                        $loc5 = $_POST['loc5'];
                        $hhtheogia = load_hang_hoa_gia_0_100000($loc1= "",$loc2 = "",$loc3 = "",$loc4 = "",$loc5  );
                    }
                    include 'user/product/load-theo-gia.php';
                    break;
        case 'orderComplete':
            include 'user/cart/orderComplete.php';
            break;
        case 'sanphamct':
            include 'user/product/productdetail.php';
            break;
        case 'danhmuc':
            $listdanhmuc = loadall_danhmuc();
            include 'user/category/category.php';
            break;
        case 'changePass':
            include './account/changePass.php';
            break;

        case 'login':
            include './account/login.php';
            break;
        case 'logout':
            include 'logOut.php';
            break;
        case 'process':
            include 'user/cart/processMoMo.php';
            break;
        case 'signup':
            include './account/signup.php';
            break;
        case 'update':
            include './account/update.php';
            break;
        case 'forgot':
            include './account/forgot.php';
            break;

        default:
            include 'user/view/home.php';
            break;
    }
} else {
    include 'user/view/home.php';
}
include 'user/components/footer.php';


ob_end_flush();
