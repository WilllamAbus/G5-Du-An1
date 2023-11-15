<?php

function phan_hoi_binh_luan_insert($ma_bl, $ma_nv, $ma_hh, $phan_hoi, $ngay_them)
{
    $conn = pdo_get_connection();
    $sql = "INSERT INTO phan_hoi_binh_luan(ma_bl,ma_nv,ma_hh,phan_hoi,ngay_them) VALUES (:ma_bl, :ma_nv,:ma_hh, :phan_hoi, :ngay_them)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":ma_bl", $ma_bl);
    $stmt->bindParam(":ma_nv", $ma_nv);
    $stmt->bindParam(":ma_hh", $ma_hh);
    $stmt->bindParam(":phan_hoi", $phan_hoi);
    $stmt->bindParam(":ngay_them", $ngay_them);

    $stmt->execute();

}

function binh_luan_nv()
{
    $sql = "SELECT * FROM phan_hoi_binh_luan";
    return pdo_query($sql);
}

function phanHBL_insert($ma_bl, $ma_nv, $phan_hoi, $ngay_them)
{
    $sql = "INSERT INTO phan_hoi_binh_luan(ma_bl,ma_nv,phan_hoi,ngay_them) VALUES (?,?,?,?)";
    pdo_execute($sql, $ma_bl, $ma_nv, $phan_hoi, $ngay_them);
}