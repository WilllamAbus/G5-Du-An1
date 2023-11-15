<?php
require_once "pdo.php";
function binh_luan_insert($ma_kh, $ma_hh, $noi_dung, $ngay_lap)
{
    $sql = "INSERT INTO binh_luan(ma_kh, ma_hh, noi_dung, ngay_lap) 
                VALUES (:ma_kh,:ma_hh,:noi_dung,:ngay_lap)";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_lap);
}

function binh_luan_delete($ma_bl)
{
    $sql = "DELETE FROM binh_luan WHERE ma_bl=?";
    pdo_execute($sql, $ma_bl);
}

function binh_luan_select_all()
{
    $sql = "SELECT * FROM binh_luan bl ORDER BY ngay_lap DESC";
    return pdo_query($sql);
}

function binh_luan_select_by_ma_hang_hoa($ma_hh)
{
    $sql = "SELECT b.*, h.ten_hh, ph.phan_hoi, ph.ma_bl as ma_blph FROM binh_luan b 
    JOIN hang_hoa h ON h.ma_hh=b.ma_hh
    JOIN phan_hoi_binh_luan ph 
    GROUP BY b.ma_bl
    HAVING b.ma_hh= $ma_hh ORDER BY ngay_lap DESC
    ";
    return pdo_query($sql);
}


function binh_luan_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl)
{
    $sql = "UPDATE binh_luan SET ma_kh=?,ma_hh=?,noi_dung=?,ngay_bl=? WHERE ma_bl=?";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
}

function binh_luanDelete($ma_bl)
{
    $sql = "DELETE FROM binh_luan WHERE ma_bl=?";
    if (is_array($ma_bl)) {
        foreach ($ma_bl as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $ma_bl);
    }
}

function loadall_binhluan()
{
    $sql = "select * from binh_luan order by ma_bl desc";
    $listBinhLuan = pdo_query($sql);
    return $listBinhLuan;
}

function binh_luan_select_by_id($ma_bl)
{
    $sql = "SELECT * FROM binh_luan WHERE ma_bl=?";
    return pdo_query_one($sql, $ma_bl);
}

function binh_luan_exist($ma_bl)
{
    $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}

//-------------------------------//
function binh_luan_select_by_hang_hoa($ma_hh)
{
    $sql = "SELECT b.*, h.ten_hh FROM binh_luan b 
    JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_lap DESC";
    return pdo_query($sql, $ma_hh);
}