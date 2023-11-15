<?php

function insert_sanpham($ten_hh, $don_gia, $giam_gia, $hinh, $mo_ta, $ngay_nhap, $dac_biet, $so_luong, $ma_loai)
{
    $sql = "insert into hang_hoa(ten_hh,don_gia,giam_gia,hinh,mo_ta,ngay_nhap,dac_biet,so_luong,ma_loai) values('$ten_hh','$don_gia','$giam_gia','$hinh','$mo_ta','$ngay_nhap','$dac_biet','$so_luong','$ma_loai')";
    pdo_execute($sql);
}

// function loadall_sanpham($kyw="",$ma_loai=0){
//     $sql="select * from hang_hoa where 1";
//     if($kyw!=""){
//         $sql.=" and ten_hh like '%".$kyw."%'";
//     }
//     if($ma_loai>0){
//         $sql.=" and ma_loai ='".$ma_loai."'";
//     }
//     $sql.=" order by ma_hh desc";
//     $listsanpham=pdo_query($sql);
//     return $listsanpham;
// }

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

function update_sanpham($ma_hh, $ten_hh, $don_gia, $giam_gia, $mo_ta, $ngay_nhap, $dac_biet, $so_luong, $hinh)
{
    if ($hinh != "")
        $sql = "UPDATE hang_hoa set ten_hh='" . $ten_hh . "', don_gia='" . $don_gia . "',giam_gia='" . $giam_gia . "',mo_ta='" . $mo_ta . "',ngay_nhap='" . $ngay_nhap . "',dac_biet='" . $dac_biet . "',so_luong='" . $so_luong . "',hinh='" . $hinh . "' where ma_hh=" . $ma_hh;
    else
        $sql = "UPDATE hang_hoa set ten_hh='" . $ten_hh . "', don_gia='" . $don_gia . "',giam_gia='" . $giam_gia . "',mo_ta='" . $mo_ta . "',ngay_nhap='" . $ngay_nhap . "',dac_biet='" . $dac_biet . "',so_luong='" . $so_luong . "'where ma_hh=" . $ma_hh;
    pdo_execute($sql);
}

function san_pham_select_by_loai($ma_loai)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_loai=?";
    return pdo_query($sql, $ma_loai);
}

function san_pham_select_trend()
{
    $sql = "SELECT * FROM hang_hoa WHERE so_luot_xem > 0 ORDER BY so_luot_xem DESC LIMIT 0, 10";
    return pdo_query($sql);
}

function san_pham_select_by_id($ma_hh)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_hh=?";
    return pdo_query_one($sql, $ma_hh);
}

function san_pham_detail($ma_hh)
{
    $sql = "SELECT * FROM hang_hoa h JOIN size s ON s.ma_hh=h.ma_hh HAVING h.ma_hh = ?";
    return pdo_query_one($sql, $ma_hh);
}

function san_pham_tang_luot_xem($ma_hh)
{
    $sql = "UPDATE hang_hoa SET luot_xem = luot_xem + 1 WHERE ma_hh=?";
    pdo_execute($sql, $ma_hh);
}

function san_pham_tang_so_luong($ma_hh)
{
    $sql = "UPDATE hang_hoa SET so_luong = so_luong + 1 WHERE ma_hh=?";
    pdo_execute($sql, $ma_hh);
}

function san_pham_giam_so_luong($ma_hh)
{
    $sql = "UPDATE hang_hoa SET so_luong = so_luong - 1 WHERE ma_hh=?";
    pdo_execute($sql, $ma_hh);
}

function san_pham_select_dac_biet()
{
    $sql = "SELECT * FROM hang_hoa WHERE dac_biet=0";
    return pdo_query($sql);
}

function san_pham_select_keyword($inputProduct)
{
    $sql = "SELECT * FROM hang_hoa hh "
        . " JOIN loai_hang lo ON lo.ma_loai=hh.ma_loai "
        . " WHERE ten_hh LIKE ? OR ten_loai LIKE ?";
    return pdo_query($sql, '%' . $inputProduct . '%', '%' . $inputProduct . '%');
}

function san_pham_select_by_filter_short($ma_loai)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_loai = ? ORDER BY don_gia ASC";
    return pdo_query($sql, $ma_loai);
}

function san_pham_select_by_filter_hight($ma_loai)
{
    $sql = "SELECT * FROM hang_hoa WHERE ma_loai = ? ORDER BY don_gia DESC";
    return pdo_query($sql, $ma_loai);
}

function san_pham_select_by_filter_size($size, $ma_loai)
{
    $sql = "SELECT * FROM hang_hoa hh JOIN size s ON s.ma_hh = hh.ma_hh WHERE s.size = '$size' AND s.ma_loai = $ma_loai";
    return pdo_query($sql);
}

?>