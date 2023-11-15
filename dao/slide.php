<?php
require_once 'pdo.php';
function slide_select_all()
{
    $sql = "SELECT * FROM slide";
    return pdo_query($sql);
}

function slide_select_show()
{
    $sql = "SELECT * FROM slide order by ngay_them desc limit 0,3";
    return pdo_query($sql);
}

function slide_delete($ma_slide)
{
    $sql = "DELETE FROM slide WHERE ma_slide = ?";
    pdo_execute($sql, $ma_slide);
}

function slide_insert($tieu_de, $noi_dung, $duong_dan, $hinh_anh)
{
    $sql = "INSERT INTO slide(tieu_de,noi_dung,duong_dan,hinh_anh) VALUES(?,?,?,?)";
    pdo_execute($sql, $tieu_de, $noi_dung, $duong_dan, $hinh_anh);
}

function loadone_slide($ma_slide)
{
    $sql = "select * from slide where ma_slide=" . $ma_slide;
    $slide = pdo_query_one($sql);
    return $slide;
}

function slide_update($tieu_de, $noi_dung, $duong_dan, $hinh_anh, $ma_slide)
{
    if ($hinh_anh != "")
        $sql = "UPDATE slide set tieu_de='" . $tieu_de . "', noi_dung='" . $noi_dung . "',duong_dan='" . $duong_dan . "',hinh_anh='" . $hinh_anh . "' where ma_slide=" . $ma_slide;
    else
        $sql = "UPDATE slide set tieu_de='" . $tieu_de . "', noi_dung='" . $noi_dung . "',duong_dan='" . $duong_dan . "' where ma_slide=" . $ma_slide;
    pdo_execute($sql);
}
// slideshow