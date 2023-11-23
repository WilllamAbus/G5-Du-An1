<?php


function chi_tiet_don_hang($ma_hd){
    $sql = "SELECT * FROM hoa_don_chi_tiet WHERE ma_hd=".$ma_hd;
    $dshd =pdo_query_one($sql);
    return $dshd;
}
function don_hang($ten_nd){
    $sql = "SELECT * FROM hoa_don WHERE ten_nd=".$ten_nd;
    $dshd =pdo_query_one($sql);
    return $dshd;
}

function don_hang_select_all()
{
    $LIMIT = 3;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;
    $sql = "select * from hoa_don where 1";
    $sql .= " order by ma_hd desc limit $offset, $LIMIT";
    $dshh = pdo_query($sql);
    return $dshh;
}
function don_hang_delete($ma_hd)
{
    $sql = "DELETE FROM hoa_don WHERE ma_hd = ? ";
    pdo_execute($sql, $ma_hd);
}

function don_hang_update_total_dang_dong_goi($ma_hd)
{
    $sql = "UPDATE hoa_don SET tinh_trang = 1 WHERE ma_hd = ?";
    pdo_execute($sql,  $ma_hd);
}

function don_hang_update_total_dang_giao_hang($ma_hd)
{
    $sql = "UPDATE hoa_don SET tinh_trang = 2 WHERE ma_hd = ?";
    pdo_execute($sql, $ma_hd);
}

function don_hang_update_total_da_giao_hang($ma_hd)
{
    $sql = "UPDATE hoa_don SET tinh_trang = 3 WHERE ma_hd = ?";
    pdo_execute($sql, $ma_hd);
}

function don_hang_update_total_bi_huy($ma_hd)
{
    $sql = "UPDATE hoa_don SET tinh_trang = 4 WHERE ma_hd = ?";
    pdo_execute($sql, $ma_hd);
}

function order_data($ma_nd, $ten_nd, $dia_chi, $sdt, $ngay_lap, $pttt, $tong_tien)
{
    $conn = pdo_get_connection();
    $tong_tien = str_replace(',', '', $tong_tien);
    $sql = "INSERT INTO hoa_don(ma_nd,ten_nd,dia_chi,sdt,ngay_lap,pttt,tong_tien) " .
        " VALUES(:ma_nd,:ten_nd,:dia_chi,:sdt,:ngay_lap,:pttt,:tong_tien)";
    $statement = $conn->prepare($sql);

    $statement->bindParam(":ma_nd", $ma_nd);
    $statement->bindParam(":ten_nd", $ten_nd);
    $statement->bindParam(":dia_chi", $dia_chi);

    $statement->bindParam(":sdt", $sdt);
    $statement->bindParam(":pttt", $pttt);
    $statement->bindParam(":ngay_lap", $ngay_lap);
    $statement->bindParam(":tong_tien", $tong_tien);
    $statement->execute();
}

function order_detail_data($ma_hd, $ma_hh, $ten_hh, $don_gia, $so_luong, $giam_gia, $thanh_tien, $hinh)
{
    $conn = pdo_get_connection();
    $thanh_tien = str_replace(',', '', $thanh_tien);
    $sql = "INSERT INTO hoa_don_chi_tiet(ma_hd,ma_hh,ten_hh,don_gia,so_luong,giam_gia,thanh_tien,hinh ) " .
        " VALUES(:ma_hd,:ma_hh,:ten_hh,:don_gia,:so_luong,:giam_gia,:thanh_tien, :hinh)";
    $statement = $conn->prepare($sql);

    $statement->bindParam(":ma_hd", $ma_hd);
    $statement->bindParam(":ma_hh", $ma_hh);
    $statement->bindParam(":ten_hh", $ten_hh);
    $statement->bindParam(":don_gia", $don_gia);
    $statement->bindParam(":so_luong", $so_luong);
    $statement->bindParam(":giam_gia", $giam_gia);
    $statement->bindParam(":thanh_tien", $thanh_tien);
    $statement->bindParam(":hinh", $hinh);
    
    $statement->execute();
}

function update_order_customer($ma_hd, $ten_kh, $dia_chi, $sdt)
{
    $sql = "UPDATE hoa_don SET ten_kh=?, dia_chi=?, sdt=? WHERE ma_hd = $ma_hd";
    pdo_execute($sql, $ten_kh, $dia_chi, $sdt);
}
function ma_hdLoad()
{
    $sql = "SELECT hd.ma_hd from hoa_don hd ";
    $stament = pdo_query($sql);
    return $stament;
}

function hoa_don_select_hoa_don_chi_tiet($ma_hd)
{
    $sql = "SELECT b.*, h.ten_hh,h.ma_cthd , h.hinh, h.don_gia,h.so_luong,h.giam_gia,h.thanh_tien FROM hoa_don b 
    JOIN hoa_don_chi_tiet h ON h.ma_hd=b.ma_hd WHERE b.ma_hd=? ORDER BY ma_hd DESC";
    return pdo_query($sql, $ma_hd);
}


?>