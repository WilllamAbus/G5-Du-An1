<?
session_start();
include "../../../dao/pdo.php";
include "../../../dao/binh-luan.php";


$ma_hh = $_REQUEST['ma_hh'];
$listBinhLuan = loadall_binhluan();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php
foreach ($listBinhLuan as $binhLuan) {
    extract($binhLuan);
    echo '
      
     
          
          <div class="card text-center">
  <div class="card-header">
  ' . $ma_bl . '
  </div>
  <div class="card-body">
    <h5 class="card-title">Bình luận</h5>
    <p class="card-text">' . $noi_dung . '</p>
    <p class="card-text ">' . $ma_nd . '</p>
    <p class="card-text ">' . $ngay_lap . '</p>
    <a href="#" class="btn btn-primary">Trả lời</a>
  </div>

</div>
          ';
}
?>


<form action="binhLuanForm.php" method="post" class="d-flex flex-row add-comment-section mt-4 mb-4">
    <?
    if (isset($_COOKIE['ma_nd'])) {
        // extract($_COOKIE['ma_nd']);

        ?>
        <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/qdiP4DB.jpg" width="38">
        <input type="hidden" name="ma_hh" value="<?= $ma_hh ?>">

        <input type="text" class="form-control mr-3" placeholder="Add comment" name="noi_dung">
        <input class="btn btn-primary" name="guiBinhLuan" type="submit" value="Bình luận">
        <?
    } else {

        ?>
        <a href="index.php?page=login" style="text-decoration: none; color: blue;"></a>Đăng nhập để bình luận</a>
        <?
    }
    ?>

</form>

<?php
if (isset($_POST['guiBinhLuan']) && $_POST['guiBinhLuan']) {
    $noi_dung = $_POST['noi_dung'];
    $ma_hh = $_POST['ma_hh'];
    // Check if the `ma_kh` key exists in the `$_COOKIE['user']` array
    $ma_nd = $_COOKIE['ma_nd'];


    $ngay_lap = date('d/m/Y h:i:sa ');
    // binh_luan_insert($ma_hh, $ma_kh, $noi_dung, $ngay_lap);
    $conn = pdo_get_connection();
    $sql = "INSERT INTO binh_luan (ma_nd, ma_hh, noi_dung, ngay_lap) VALUES (:ma_nd, :ma_hh, :noi_dung, :ngay_lap)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":ma_nd", $ma_nd);
    $stmt->bindParam(":ma_hh", $ma_hh);
    $stmt->bindParam(":noi_dung", $noi_dung);
    $stmt->bindParam(":ngay_lap", $ngay_lap);

    $stmt->execute();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    // Thêm bình luận vào cơ sở dữ liệu


}

?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>