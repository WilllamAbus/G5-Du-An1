<?php
require_once 'pdo.php';

function thong_ke_binh_luan()
{
    $sql = "SELECT hh.ma_hh, hh.ten_hh,"
        . " COUNT(*) so_luong,"
        . " MIN(bl.ngay_lap) cu_nhat,"
        . " MAX(bl.ngay_lap) moi_nhat"
        . " FROM binh_luan bl "
        . " JOIN hang_hoa hh ON hh.ma_hh=bl.ma_hh "
        . " GROUP BY hh.ma_hh, hh.ten_hh"
        . " HAVING so_luong > 0";
    return pdo_query($sql);
}

function thong_ke_doanh_thu_by_hang_hoa()
{
    $sql = "SELECT hh.ma_hh, hh.ten_hh,"
        . " COUNT(*) so_luong,"
        . " SUM(hdct.thanh_tien) thanh_tien"
        . " FROM hoa_don_chi_tiet hdct "
        . " JOIN hang_hoa hh ON hh.ma_hh=hdct.ma_hh "
        . " GROUP BY hh.ma_hh, hh.ten_hh"
        . " HAVING so_luong > 0";
    return pdo_query($sql);
}

function thong_ke_doanh_thu_theo_thang($ngay_lap)
{
    $sql = "SELECT SUM(tong_tien) tong_tien FROM hoa_don WHERE ngay_lap >" . $ngay_lap;
    return pdo_query($sql);
}

function thong_ke_hang_hoa()
{
    $sql = "SELECT lo.ma_loai, lo.ten_loai,"
        . " COUNT(*) so_luong,"
        . " MIN(hh.don_gia) gia_min,"
        . " MAX(hh.don_gia) gia_max,"
        . " AVG(hh.don_gia) gia_avg"
        . " FROM hang_hoa hh "
        . " JOIN loai_hang lo ON lo.ma_loai=hh.ma_loai "
        . " GROUP BY lo.ma_loai, lo.ten_loai";
    return pdo_query($sql);
}

