<?php
require_once "pdo.php";

function kh_insert(array $data)
{
    $conn = pdo_get_connection();

    $sql = "INSERT INTO khach_hang(ma_kh,ten_kh,email,mat_khau,hinh,gioi_tinh,kich_hoat, vai_tro) " .
        " VALUES(:ma_kh,:ten_kh,:email,:mat_khau,:hinh,:gioi_tinh,:kich_hoat, :vai_tro)";

    $statement = $conn->prepare($sql);

    $statement->execute($data);
}

function khach_hang_update($ma_kh, $ten_kh, $email, $mat_khau)
{
    $sql = "UPDATE khach_hang SET ten_kh=?,email=?,sdt=?,mat_khau=? WHERE ma_kh=?";
    pdo_execute($sql, $ten_kh, $email, $mat_khau, $ma_kh);
}

function khach_hang_select_all()
{
    $sql = "SELECT * FROM khach_hang";
    return pdo_query($sql);
}

function khach_hang_exist($ma_kh)
{
    $sql = "SELECT count(*) FROM khach_hang WHERE ma_kh = '$ma_kh=?'";
    return pdo_query_value($sql, $ma_kh) > 0;
}

function khach_hang_select_by_id($ten_kh)
{
    $sql = "SELECT * FROM khach_hang WHERE ten_kh=?";
    return pdo_query_one($sql, $ten_kh);
}

// function khach_hang_change_password($ma_kh, $mat_khau_moi){
//     $sql = "UPDATE khach_hang SET mat_khau=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau_moi, $ma_kh);
// }

// admin


function get()
{
    $conn = pdo_get_connection();
    $sql = "SELECT * FROM khach_hang";
    $statement = $conn->prepare($sql);
    $statement->execute([]);
    $kq = [];
    while (true) {
        $rowData = $statement->fetch();
        if ($rowData == false) {
            break;
        }
        $row = [
            'ma_kh' => $rowData['ma_kh'],
            'ten_kh' => $rowData['ten_kh'],
            'email' => $rowData['email'],
            'sdt' => $rowData['sdt'],
            'dia_chi' => $rowData['dia_chi'],
            'ngay_sinh' => $rowData['ngay_sinh'],
            'mat_khau' => $rowData['mat_khau'],
            'hinh' => $rowData['hinh'],
            'vai_tro' => $rowData['vai_tro'],
            'kich_hoat' => $rowData['kich_hoat'],

        ];

        array_push($kq, $row);
    }

    return $kq;
}

function khach_hang_insert($ma_nd, $ma_hh, $thanh_tien, $so_luong, $don_gia, $giam_gia, $hinh, $ten_hh, $ma_cthd, $ma_nv)
{

    $sql = "insert into khach_hang(ma_nd, ma_hh, thanh_tien, so_luong, don_gia, giam_gia, hinh, ten_hh, ma_cthd, ma_nv) 
    values(?,?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql, $ma_nd, $ma_hh, $thanh_tien, $so_luong, $don_gia, $giam_gia, $hinh, $ten_hh, $ma_cthd, $ma_nv);
}

function khachhang_update($ma_kh, $ten_kh, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $vai_tro, $kich_hoat)
{
    $sql = "UPDATE khach_hang SET ten_kh=?,email=?,sdt=?,dia_chi=?,ngay_sinh=?, mat_khau=?,hinh=?,vai_tro=?,kich_hoat=? WHERE ma_kh=?";
    pdo_execute($sql, $ten_kh, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $vai_tro, $kich_hoat, $ma_kh);
}

function loadone_khachhang($ma_kh)
{
    $sql = "select * from khach_hang where ma_kh=?";

    return pdo_query_one($sql, $ma_kh);
}

function khach_hang__select_all()
{
    $sql = "SELECT * FROM khach_hang";
    return pdo_query($sql);
}

function khach_hang_delete($ma_kh)
{
    $sql = "DELETE FROM khach_hang WHERE ma_kh=" . $ma_kh;
    pdo_execute($sql);
}

function loadall_khachhang()
{
    $sql = "select * from khach_hang order by ma_kh desc";
    $listKhachHang = pdo_query($sql);
    return $listKhachHang;
}


function ma_hdctLoad()
{
    $sql = "SELECT hdct.ma_cthd from hoa_don_chi_tiet hdct ";
    $stament = pdo_query($sql);
    return $stament;
}

function ma_ndLoad()
{
    $sql = "SELECT nd.ma_nd from nguoi_dung nd";
    $stm = pdo_query($sql);
    return $stm;
}

function ma_nvLoad()
{

    $sql = "SELECT nv.ma_nv from nhan_vien nv";
    $nvStm = pdo_query($sql);
    return $nvStm;
}