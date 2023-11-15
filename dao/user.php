<?php

function user_insert($ten_nd, $email, $mat_khau)
{

    $conn = pdo_get_connection();
    // Thêm bình luận vào cơ sở dữ liệu
    $sql = "INSERT INTO nguoi_dung ( ten_nd, email, mat_khau) VALUES (:ten_nd, :email, :mat_khau)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":ten_nd", $ten_nd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":mat_khau", $mat_khau);
    $stmt->execute();
}

function Userinsert($ten_nd, $email, $sdt, $mat_khau)
{

    $sql = "insert into khach_hang( ten_nd, email,  mat_khau) 
    values(:ten_nd, :email, :sdt, :mat_khau)";
    pdo_execute($sql, $ten_nd, $email, $sdt, $mat_khau);
}

//  function u_serInsert ($ten_nd, $email, $sdt, $mat_khau){
//     $sql = "INSERT INTO binh_luan (ten_nd, email, sdt, mat_khau) VALUES (:ten_nd, :email, :sdt, :mat_khau)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(":ten_nd", $ten_nd);
//     $stmt->bindParam(":email", $email);
//     $stmt->bindParam(":sdt", $sdt);
//     $stmt->bindParam(":mat_khau", $mat_khau);

//     $stmt->execute();
//  }


function user_update($ma_kh, $ten_nd, $mat_khau, $email)
{
    $sql = "UPDATE khach_hang SET ten_kh=?,mat_khau=?,email=?  WHERE ma_kh=?";
    pdo_execute($sql, $ma_kh, $ten_nd, $mat_khau, $email);
}

function check_user($ten_nv, $email, $mat_khau)
{
    $sql = "SELECT * FROM nhan_vien WHERE ten_nv=? and email=?  and mat_khau=?";
    return pdo_query_one($sql, $ten_nv, $email, $mat_khau);
}

function validate_user($ten_nd, $email, $mat_khau)
{
    $sql = "SELECT * FROM nguoi_dung WHERE ten_nd=? and email=?  and mat_khau=?";
    return pdo_query_one($sql, $ten_nd, $email, $mat_khau);
}

function check_register($ten_kh, $email, $mat_khau)
{
    $sql = "SELECT * FROM khach_hang WHERE ten_kh=?and email=? and mat_khau=?";

    pdo_query_one($sql);

}

function check_forgot($email)
{
    $sql = "SELECT * FROM khach_hang WHERE  email=?";
    $forget = pdo_query_one($sql, $email);
    return $forget;

}


function get_user($ma_kh)
{
    $sql = "select *  from khach_hang where id=?";
    return pdo_query_one($sql, $ma_kh);
}


// function khach_hang_select_by_id($ma_kh){
//     $sql = "SELECT * FROM khach_hang WHERE ma_kh=?";
//     return pdo_query_one($sql, $ma_kh);
// }

function khach_hang_change_password($ten_kh, $newPass)
{
    $sql = "UPDATE khach_hang SET mat_khau=? WHERE ten_kh=?";
    pdo_execute($sql, $newPass, $ten_kh);
}