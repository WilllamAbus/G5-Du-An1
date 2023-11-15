<?php
require_once 'pdo.php';

/**
 * Thêm loại mới
 * @param String $ten_loai là tên loại
 * @throws PDOException lỗi thêm mới
 */
function loai_insert($ten_loai)
{
    $sql = "INSERT INTO loai_hang(ten_loai) VALUES(?)";
    pdo_execute($sql, $ten_loai);

}

/**
 * Cập nhật tên loại
 * @param int $ma_loai là mã loại cần cập nhật
 * @param String $ten_loai là tên loại mới
 * @throws PDOException lỗi cập nhật
 */
function loai_update($ma_loai, $ten_loai)
{
    $sql = "UPDATE loai_hang SET ten_loai=? WHERE ma_loai=?";
    pdo_execute($sql, $ten_loai, $ma_loai);
}

function loai_count($ten_loai)
{
    $sql = "SELECT COUNT(*) FROM loai_hang WHERE ten_loai = ten_loai";
    $sqlCount = pdo_execute($sql, $ten_loai);
    return $sqlCount > 0;
}

/**
 * Xóa một hoặc nhiều loại
 * @param mix $ma_loai là mã loại hoặc mảng mã loại
 * @throws PDOException lỗi xóa
 */
function loai_delete($ma_loai)
{
    $sql = "DELETE FROM loai_hang WHERE ma_loai=?";
    if (is_array($ma_loai)) {
        foreach ($ma_loai as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $ma_loai);
    }
}

/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function loai_select_all()
{
    $sql = "SELECT * FROM loai_hang";
    return pdo_query($sql);
}

/**
 * Truy vấn một loại theo mã
 * @param int $ma_loai là mã loại cần truy vấn
 * @return array mảng chứa thông tin của một loại
 * @throws PDOException lỗi truy vấn
 */
function loai_select_by_id($ma_loai)
{
    $sql = "SELECT * FROM loai_hang WHERE ma_loai=? ";
    return pdo_query_one($sql, $ma_loai);
}

/**
 * Kiểm tra sự tồn tại của một loại
 * @param int $ma_loai là mã loại cần kiểm tra
 * @return boolean có tồn tại hay không
 * @throws PDOException lỗi truy vấn
 */
function loai_exist($ten_loai)
{
    $sql = "SELECT count(*) FROM loai_hang WHERE ten_loai=?";
    $sqlCount = pdo_query_value($sql, $ten_loai) > 0;
    return $sqlCount;
}


function loadall_danhmuc()
{

    // $LIMIT = 2;
    // $num = isset($_GET['page_num']) ? intval($_GET['page_num']) :1;
    // $offset = ($num - 1) * $LIMIT;

    $sql = "select * from loai_hang order by ma_loai desc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}


function delete_danhmuc($ma_loai)
{
    $sql = "delete from loai_hang where ma_loai=" . $ma_loai;
    pdo_execute($sql);
}


function insert_danhmuc($ten_loai)
{
    $sql = "insert into loai_hang(ten_loai) values('$ten_loai')";
    pdo_execute($sql);
}


function loadone_danhmuc($ma_loai)
{
    $sql = "select * from loai_hang where ma_loai=" . $ma_loai;
    $dm = pdo_query_one($sql);
    return $dm;
}

function search_loai($ma_loai)
{
    if ($ma_loai > 0) {
        $sql = "select * from loai_hang where ma_loai=" . $ma_loai;
        $dm = pdo_query_one($sql);
        extract($dm);
        return $dm;
    } else {
        return "";
    }

}

function update_danhmuc($ma_loai, $ten_loai)
{
    $sql = "update loai_hang set ten_loai='" . $ten_loai . "' where ma_loai=" . $ma_loai;
    pdo_execute($sql);
}

function loai_hang_select_by_id($ma_loai)
{
    $sql = "SELECT * FROM loai_hang WHERE ma_loai=?";
    return pdo_query_one($sql, $ma_loai);
}

function loai_hang_select_page()
{
    $LIMIT = 2;
    $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
    $offset = ($num - 1) * $LIMIT;


    $sql = "SELECT * FROM loai_hang ORDER BY ma_loai LIMIT $offset , $LIMIT";
    $result = pdo_query($sql);
    return $result;
}


function loai_hang_pagination()
{

    if (!isset($_SESSION['page_no'])) {
        $_SESSION['page_no'] = 0;
    }
    if (!isset($_SESSION['page_count'])) {
        $row_count = pdo_query_value("SELECT count(*) FROM hang_hoa");
        $_SESSION['page_count'] = ceil($row_count / 10);
    }
    if (exist_param("page_no")) {
        $_SESSION['page_no'] = $_REQUEST['page_no'];
    }
    if ($_SESSION['page_no'] < 0) {
        $_SESSION['page_no'] = $_SESSION['page_count'] - 1;
    }
    if ($_SESSION['page_no'] >= $_SESSION['page_count']) {
        $_SESSION['page_no'] = 0;
    }
}