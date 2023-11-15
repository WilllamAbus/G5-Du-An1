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

function order_detail_data($ma_hd, $ma_hh, $don_gia, $so_luong, $giam_gia, $thanh_tien, $hinh)
{
    $conn = pdo_get_connection();
    $thanh_tien = str_replace(',', '', $thanh_tien);
    $sql = "INSERT INTO hoa_don_chi_tiet(ma_hd,ma_hh,don_gia,so_luong,giam_gia,thanh_tien,hinh ) " .
        " VALUES(:ma_hd,:ma_hh,:don_gia,:so_luong,:giam_gia,:thanh_tien, :hinh)";
    $statement = $conn->prepare($sql);

    $statement->bindParam(":ma_hd", $ma_hd);
    $statement->bindParam(":ma_hh", $ma_hh);
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

?>