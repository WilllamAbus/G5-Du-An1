<?php
function nhan_vien_select_by_id($ma_nv)
{
    $sql = "SELECT * FROM nhan_vien WHERE ma_nv=?";
    return pdo_query_one($sql, $ma_nv);
}

require_once "pdo.php";

// function get() {
//     $conn = pdo_get_connection();
//     $sql = "SELECT * FROM nhan_vien";  
//     $statement = $conn->prepare($sql);   
//     $statement->execute([]);
//     $kq = [];
//     while(true) {      
//         $rowData = $statement->fetch();
//         if ($rowData == false) {
//             break;
//         }
//         $row = [          
//             'ma_nv' => $rowData['ma_nv'],
//             'ten_nv' => $rowData['ten_nv'],
//             'email' => $rowData['email'],
//             'sdt' => $rowData['sdt'],
//             'dia_chi' => $rowData['dia_chi'],
//             'ngay_sinh' => $rowData['ngay_sinh'],
//             'mat_khau' => $rowData['mat_khau'],                
//             'hinh' => $rowData['hinh'],
//             'gioi_tinh' => $rowData['gioi_tinh'],
//             'kich_hoat' => $rowData['kich_hoat'],
//             'vai_tro' => $rowData['vai_tro'],
//         ];

//         array_push($kq, $row);
//     }

//     return $kq;
// }

function nhan_vien_insert($ma_nv, $ten_nv, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $gioi_tinh, $kich_hoat, $vai_tro)
{

    $sql = "insert into nhan_vien(ma_nv, ten_nv, email,  sdt , dia_chi , ngay_sinh ,mat_khau, hinh, gioi_tinh, kich_hoat, vai_tro)
     values(?,?,?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql, $ma_nv, $ten_nv, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $gioi_tinh == 1, $kich_hoat == 1, $vai_tro == 1);
}

function nhanvien_update($ma_nv, $ten_nv, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $gioi_tinh, $kich_hoat, $vai_tro)
{
    $sql = "UPDATE nhan_vien SET ten_nv=?,email=?,sdt=?,dia_chi=?,ngay_sinh=?, mat_khau=?,hinh=?,gioi_tinh=?,kich_hoat=?,vai_tro=? WHERE ma_nv=?";
    pdo_execute($sql, $ma_nv, $ten_nv, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $gioi_tinh == 0, $kich_hoat == 0, $vai_tro == 0);
}

function loadone_nhanvien($ma_nv)
{
    $sql = "SELECT * FROM nhan_vien WHERE ma_nv REGEXP '^NV\\d{4}$' OR ma_nv = '" . $ma_nv . "'";

    $res = pdo_query_one($sql);
    return $res;
}

function loadone_NV($ma_nv)
{
    $sql = "select * from hang_hoa where ma_hh =" . $ma_nv;
    $res = pdo_query_one($sql);
    return $res;
}

function nhan_vien__select_all()
{
    $sql = "SELECT * FROM nhan_vien";
    return pdo_query($sql);
}

// function nhan_vien_delete($ma_nv){
//     $sql = "DELETE FROM NhanVien
//     WHERE LEFT(ma_nv, 1) LIKE '[a-z]'";
//         pdo_execute($sql, $ma_nv);
// }

// function delete_nhanvien($ma_nv){
//     $sql="delete from loai_hang where ma_loai=".$ma_nv;
//     pdo_execute($sql);
// }
function loadall_nhanvien()
{
    $sql = "select * from nhan_vien order by ma_nv desc";
    $listNhanVien = pdo_query($sql);
    return $listNhanVien;
}


function delete_nhanvien($ma_nv)
{


    // Lấy dữ liệu của nhân viên cần xóa
    $sql = "SELECT * FROM nhan_vien WHERE ma_nv LIKE '^[a-zA-Z]%' AND ma_nv = '$ma_nv'";


    // Xóa nhân viên
    $sql = "DELETE FROM nhan_vien WHERE ma_nv = '$ma_nv'";

    pdo_execute($sql, $ma_nv);

}

function update_nhanVien($ma_nv, $ten_nv, $email, $sdt, $dia_chi, $ngay_sinh, $mat_khau, $hinh, $gioi_tinh, $kich_hoat, $vai_tro)
{

    if ($hinh != "") {

        $sql = "UPDATE nhan_vien 
        set 
      
        ten_nv='" . $ten_nv . "',
        email='" . $email . "',
        sdt='" . $sdt . "',
        dia_chi='" . $dia_chi . "',
        ngay_sinh='" . $ngay_sinh . "',
        mat_khau='" . $mat_khau . "',
        gioi_tinh='" . $gioi_tinh . "',
        kich_hoat='" . $kich_hoat . "',
        vai_tro='" . $vai_tro . "',
         hinh='" . $hinh . "' 
         where ma_nv REGEXP '^NV\\d{4}$' OR ma_nv = '" . $ma_nv . "'";
    } else {

        $sql = "UPDATE nhan_vien 
    set
     ten_nv='" . $ten_nv . "',
     email='" . $email . "',
     sdt='" . $sdt . "',
     dia_chi='" . $dia_chi . "',
     ngay_sinh='" . $ngay_sinh . "',
     mat_khau='" . $mat_khau . "',
     gioi_tinh='" . $gioi_tinh . "',
     kich_hoat='" . $kich_hoat . "',
     vai_tro='" . $vai_tro . "',
      hinh='" . $hinh . "' 
    where ma_nv REGEXP '^NV\\d{4}$' OR ma_nv = '" . $ma_nv . "'";
    }

    pdo_execute($sql);
}

?>