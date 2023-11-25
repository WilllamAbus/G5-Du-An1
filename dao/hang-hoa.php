<?php
require_once 'pdo.php';

function hang_hoa_insert($ten_hh, $don_gia, $giam_gia, $hinh, $ma_loai, $ngay_nhap, $so_luong, $mo_ta)
{
    $sql = "INSERT INTO hang_hoa(ten_hh, don_gia, giam_gia, hinh, ma_loai,  ngay_nhap,so_luong, mo_ta) 
    VALUES (:ten_hh,:don_gia,:giam_gia,:hinh,:ma_loai, :ngay_nhap, :so_luong,:mo_ta)";


    pdo_execute($sql);
}

// function hang_hoa_update( $ma_hh, $ten_hh, $don_gia, $giam_gia, $hinh,  $mo_ta){
//     $sql = "UPDATE hang_hoa 
//     SET 
//     ma_hh=?,
//     ten_hh=?,
//     don_gia=?,
//     giam_gia=?,
//     hinh=?,
//     mo_ta=? WHERE ma_hh=?";
//     pdo_execute($sql, $ten_hh, $don_gia, $giam_gia, $hinh,   $mo_ta, $ma_hh);
// }

function hang_hoa_update($ma_hh, $ten_hh, $don_gia, $giam_gia, $hinh, $dac_biet, $ngay_nhap, $so_luot_xem, $mo_ta)
{
    $sql = "UPDATE hang_hoa 
    SET 
    ma_hh =:ma_hh,
    ten_hh=:ten_hh,
    don_gia=:don_gia,
    giam_gia=:giam_gia,
    hinh=:hinh,
    dac_biet=:dac_biet,
    ngay_nhap=:ngay_nhap,
    so_luot_xem=:so_luot_xem
    mo_ta=:mo_ta 
    WHERE ma_hh=:ma_hh";
    // $num_params = count(func_get_args());

    // // Check if the number of parameters matches the number of placeholders
    // if ($num_params != 6) {
    //     throw new PDOException('Invalid number of parameters');
    // }
    pdo_execute($sql, [
        ':ma_hh' => $ma_hh,
        ':ten_hh' => $ten_hh,
        ':don_gia' => $don_gia,
        ':giam_gia' => $giam_gia,
        ':hinh' => $hinh,
        ':dac_biet' => $dac_biet,
        'ngay_nhap' => $ngay_nhap,
        ':so_luot_xem' => $so_luot_xem,
        ':mo_ta' => $mo_ta]);
}

function hang_hoa_delete($ma_hh)
{
    $sql = "DELETE FROM hang_hoa WHERE  ma_hh=?";
    if (is_array($ma_hh)) {
        foreach ($ma_hh as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $ma_hh);
    }
}

function hang_hoa_select_all()
{
    $sql = "SELECT * FROM hang_hoa";
    return pdo_query($sql);
}

function hang_hoa_select_by_id($ma_hh)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_hh=?";
    return pdo_query_one($sql, $ma_hh);
}

function hang_hoa_exist($ma_hh)
{
    $sql = "SELECT count(*) FROM hang_hoa WHERE ma_hh=?";
    return pdo_query_value($sql, $ma_hh) > 0;
}

function hang_hoa_tang_so_luot_xem($ma_hh)
{
    $sql = "UPDATE hang_hoa SET so_luot_xem = so_luot_xem + 1 WHERE ma_hh=?";
    pdo_execute($sql, $ma_hh);
}

function hang_hoa_select_top10()
{
    $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
    return pdo_query($sql);
}

function hang_hoa_select_dac_biet()
{
    $sql = "SELECT * FROM hang_hoa WHERE dac_biet=1";
    return pdo_query($sql);
}

function hang_hoa_select_by_loai($ma_loai)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
    return pdo_query($sql, $ma_loai);
}
function load_hang_hoa_gia_thap_nhat($inputProduct = "", $ma_loai = 0 )
{
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = "select * from hang_hoa where 1";
    if ($inputProduct != "") {
        $sql .= " and ten_hh like '%" . $inputProduct . "%'";
    }
    if ($ma_loai > 0) {
        $sql .= " and ma_loai ='" . $ma_loai . "'";
    }
    $sql .= " order by don_gia asc limit $offset, $LIMIT";
    $listProduct = pdo_query($sql);
    return $listProduct;
}
function load_hang_hoa_gia_cao_nhat($inputProduct = "", $ma_loai = 0 )
{
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = "select * from hang_hoa where 1";
    if ($inputProduct != "") {
        $sql .= " and ten_hh like '%" . $inputProduct . "%'";
    }
    if ($ma_loai > 0) {
        $sql .= " and ma_loai ='" . $ma_loai . "'";
    }
    $sql .= " order by don_gia desc limit $offset, $LIMIT";
    $listProduct = pdo_query($sql);
    return $listProduct;
}
function load_hang_hoa_xep_hang($inputProduct = "", $ma_loai = 0 )
{
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = "select * from hang_hoa where 1";
    if ($inputProduct != "") {
        $sql .= " and ten_hh like '%" . $inputProduct . "%'";
    }
    if ($ma_loai > 0) {
        $sql .= " and ma_loai ='" . $ma_loai . "'";
    }
    $sql .= " order by so_luot_xem desc limit $offset, $LIMIT";
    $listProduct = pdo_query($sql);
    return $listProduct;
}
function load_hang_hoa_gia_0_100000($loc1 = "",$loc2 = "",$loc3 = "",$loc4 = "",$loc5 = "" )
{ 
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = " select * from hang_hoa where 1 ";
    if($loc1 !="" ){
        $sql .= " and don_gia  BETWEEN 0 AND 100000 ";
    }
    if($loc2 !="" ){
        $sql .= " and don_gia  BETWEEN 100000 AND 300000 ";
    }
    if($loc3 !="" ){
        $sql .= " and don_gia  BETWEEN 300000 AND 500000 ";
    }
    if($loc4 !="" ){
        $sql .= " and don_gia  BETWEEN 500000 AND 700000 ";
    }
    if($loc5 !="" ){
        $sql .= " and don_gia  > 700000  ";
    }

    $listProduct = pdo_query($sql);
    return $listProduct;
}
function load_hang_hoa_gia_10000_300000()
{
    $sql = " select * from hang_hoa where don_gia  BETWEEN 10000 AND 300000";   
    $listProduct = pdo_query($sql);
    return $listProduct;
}
function hang_hoa_select_keyword($keyword)
{
    $sql = "SELECT * FROM hang_hoa hh "
        . " JOIN loai lo ON lo.ma_loai=hh.ma_loai "
        . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
    return pdo_query($sql, '%' . $keyword . '%', '%' . $keyword . '%');
}

function hang_hoa_select_page()
{
    $LIMIT = 2;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;


    $sql = "SELECT * FROM loai_hang ORDER BY ma_loai LIMIT $offset , $LIMIT";
    $result = pdo_query($sql);
    return $result;
}

function hang_hoa_pagination()
{
    if (!isset($_SESSION['page_no'])) {
        $_SESSION['page_no'] = 0;
    }
    if (!isset($_SESSION['page_count'])) {
        $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
        $_SESSION['page_count'] = ceil($row_count / 9.0);
    }
    if (exist_param("page_no")) {
        $_SESSION['page_no'] = $_REQUEST['page_no'];
    }
    if ($_SESSION['page_no'] < 0) {
        $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
    }
    if ($_SESSION['page_no'] >= $_SESSION['page_count']) {
        $_SESSION['page_no'] = 0;
    }
    $offset = $_SESSION['page_no'] * 3;
    $sql = "SELECT * FROM hang_hoa ORDER BY ma_hh LIMIT " . $offset . ", 9";
    $result = pdo_query($sql);
    return $result;
}

function san_pham_select_trend()
{
    $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
    return pdo_query($sql);
}


function insert_sanpham($ten_hh, $don_gia, $giam_gia, $hinh, $mo_ta, $ngay_nhap, $dac_biet, $so_luot_xem, $ma_loai)
{
    $sql = "insert into hang_hoa(ten_hh,don_gia,giam_gia,hinh,mo_ta,ngay_nhap,dac_biet,so_luot_xem,ma_loai) 
    values('$ten_hh','$don_gia','$giam_gia','$hinh','$mo_ta','$ngay_nhap','$dac_biet',$so_luot_xem,'$ma_loai')";
    pdo_execute($sql);
}


function loadall_sanpham($inputProduct = "", $ma_loai = 0)
{
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = "select * from hang_hoa where 1";
    if ($inputProduct != "") {
        $sql .= " and ten_hh like '%" . $inputProduct . "%'";
    }
    if ($ma_loai > 0) {
        $sql .= " and ma_loai ='" . $ma_loai . "'";
    }
    $sql .= " order by ma_hh desc limit $offset, $LIMIT";
    $listProduct = pdo_query($sql);
    return $listProduct;
}


function san_pham_select_keyword($inputProduct)
{
    $sql = "SELECT * FROM hang_hoa hh "
        . " JOIN loai_hang lo ON lo.ma_loai=hh.ma_loai "
        . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
    return pdo_query($sql, '%' . $inputProduct . '%', '%' . $inputProduct . '%');
}

function delete_sanpham($ma_hh)
{
    $sql = "delete from hang_hoa where ma_hh=" . $ma_hh;
    pdo_execute($sql);
}


function loadone_sanpham($ma_hh)
{
    $sql = "select * from hang_hoa where ma_hh=" . $ma_hh;
    $sp = pdo_query_one($sql);
    return $sp;
}

function update_sanpham($ma_hh, $ten_hh, $don_gia, $giam_gia, $mo_ta, $ngay_nhap, $dac_biet, $so_luot_xem, $hinh)
{
    if ($hinh != "")
        $sql = "UPDATE hang_hoa 
    set 
    ten_hh='" . $ten_hh . "',
     don_gia='" . $don_gia . "',
     giam_gia='" . $giam_gia . "',
     mo_ta='" . $mo_ta . "',
     ngay_nhap='" . $ngay_nhap . "',
     dac_biet='" . $dac_biet . "',
     so_luot_xem='" . $so_luot_xem . "',
     hinh='" . $hinh . "' 
     where ma_hh=" . $ma_hh;
    else
        $sql = "UPDATE hang_hoa 
    set
     ten_hh='" . $ten_hh . "',
      don_gia='" . $don_gia . "',
      giam_gia='" . $giam_gia . "',
      mo_ta='" . $mo_ta . "',
      ngay_nhap='" . $ngay_nhap . "',
      dac_biet='" . $dac_biet . "',
      so_luot_xem='" . $so_luot_xem . "'
      where ma_hh=" . $ma_hh;
    pdo_execute($sql);
}


function san_pham_select_by_id($ma_hh)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_hh=?";
    return pdo_query_one($sql, $ma_hh);
}