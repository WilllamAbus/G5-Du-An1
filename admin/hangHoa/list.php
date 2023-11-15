<?


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>

<body>
<style>
    .picture {
        width: 200px;
        height: 300px;
    }
</style>

<section class="content">
    <div class="container-fluid">

        <?php

        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH HÀNG HÓA</h3>
                    </div>
                    <form action="index.php?page=listProduct" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" name="inputProduct" class="form-control"
                                       placeholder="nhập tên sản phẩm cần tìm">
                            </div>
                            <select name="ma_loai" class="form-control select2">
                                <option value="0" selected>Tất cả</option>
                                <?php
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $ma_loai . '">' . $ten_loai . '</option>';
                                }
                                ?>
                            </select>

                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="searchList" value="Tìm kiếm">
                            </div>
                        </div>
                    </form>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>MÃ HH</th>
                                <th>TÊN HH</th>
                                <th>ĐƠN GIÁ</th>
                                <th>GIẢM GIÁ</th>
                                <th>HÌNH</th>
                                <th>ĐẶC BIỆT</th>
                                <th>NGÀY NHẬP</th>
                                <th>MÔ TẢ</th>
                                <th>LƯỢT XEM</th>

                                <th>CHỨC NĂNG</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($listProduct as $sanpham) {
                                extract($sanpham);
                                $suasp = "index.php?page=suasp&ma_hh=" . $ma_hh;
                                $xoasp = "index.php?page=xoasp&ma_hh=" . $ma_hh;

                                // $hinhpath="./controller/hinh/hangHoa/".$hinh;
                                // if(is_file($hinhpath)){
                                //     $hinh="<img src='".$hinhpath."' height='90'>";
                                // }else{
                                //     $hinh="no photo";
                                // }

                                echo '<tr>
                                                       
                                                            <td>' . $ma_hh . '</td>
                                                            <td>' . $ten_hh . '</td>
                                                            <td>' . number_format($don_gia) . '</td>
                                                            <td>' . $giam_gia . '</td>
                                                            <td> <img src="../controller/hinh/hangHoa/' . $hinh . '" width = "90px">  </td>
                                                           
                                                            <td>' . $dac_biet . '</td>
                                                            <td>' . $ngay_nhap . '</td>
                                                            <td>' . $mo_ta . '</td>
                                                            <td>' . $so_luot_xem . '</td>
                                                            <td>
                                                            <a href="' . $suasp . '"><input class="btn btn-primary" type="button" value="Sửa"></a> 
                                                            <a href="' . $xoasp . '"><input class="btn btn-primary" type="button" value="Xóa"></a>
                                                           
                                                            </td>
                                          
                                                            
                                                        </tr>';
                            }


                            ?>


                            </tbody>

                        </table>
                        <tr>

                            <th colspan="6">
                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Chọn
                                    tất cả
                                </button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Bỏ
                                    chọn
                                    tất cả
                                </button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Xóa
                                    các
                                    mục chọn
                                </button>

                                <a>
                                    <button class="btn btn-outline-primary btn-md " type="submit"> Nhập thêm
                                    </button>
                                </a>
                            </th>
                        </tr>
                        <nav aria-label="Page navigation example d-block">

                            <?php
                            $LIMIT = 3;
                            $num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
                            $connect = pdo_get_connection();
                            $sqlCount = "SELECT COUNT(*) as count FROM loai_hang";

                            $count = $connect->query($sqlCount);
                            $countRes = $count->fetch();
                            $totalPages = ceil(($countRes['count'] / $LIMIT));
                            echo '  <ul class="pagination justify-content-end p-3">';
                            for ($index = 1; $index <= $totalPages; $index++) {
                                $active = ($num == $index) ? ' active' : '';
                                echo '  <li class="page-item ' . $active . '">
                                              <a class="page-link" href="index.php?page=listProduct&page_num=' . $index . '">' . $index . '</a>
                                              </li>';
                            }

                            echo ' </ul>';


                            ?>


                        </nav>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>

