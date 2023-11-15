<?php


function chi_tiet_don_hang($ma_hd)
{
    $sql = "SELECT * FROM hoa_don_chi_tiet WHERE ma_hd=?";
    return pdo_query($sql, $ma_hd);
}

function don_hang_select_all()
{
    $sql = "SELECT * FROM hoa_don dh ORDER BY ngay_lap DESC";
    return pdo_query($sql);
}

function don_hang_delete($ma_hd)
{
    $sql = "DELETE FROM hoa_don WHERE ma_hd = ?";
    pdo_execute($sql, $ma_hd);
}

function don_hang_update_total_dang_dong_goi($ma_hd, $ma_nv)
{
    $sql = "UPDATE hoa_don SET tinh_trang = 1, ma_nv =? WHERE ma_hd = ?";
    pdo_execute($sql, $ma_nv, $ma_hd);
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

function order_data(array $order_data)
{
    $conn = pdo_get_connection();
    $sql = "INSERT INTO hoa_don(ma_hd,ma_kh,ten_kh,dia_chi,sdt,ngay_lap,pttt,tong_tien) " .
        " VALUES(:ma_hd,:ma_kh,:ten_kh,:dia_chi,:sdt,:ngay_lap,:pttt,:tong_tien)";
    $statement = $conn->prepare($sql);
    $statement->execute($order_data);
}

function order_detail_data(array $order_detail_data)
{
    $conn = pdo_get_connection();
    $sql = "INSERT INTO hoa_don_chi_tiet(ma_hd,ma_hh,size,don_gia,so_luong,giam_gia,thanh_tien ) " .
        " VALUES(:ma_hd,:ma_hh,:size,:don_gia,:so_luong,:giam_gia,:thanh_tien)";
    $statement = $conn->prepare($sql);
    $statement->execute($order_detail_data);
}

function update_order_customer($ma_hd, $ten_kh, $dia_chi, $sdt)
{
    $sql = "UPDATE hoa_don SET ten_kh=?, dia_chi=?, sdt=? WHERE ma_hd = $ma_hd";
    pdo_execute($sql, $ten_kh, $dia_chi, $sdt);
}

?>