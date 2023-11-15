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
    <link rel="stylesheet" href="../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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


<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH LOẠI HÀNG</h3>
                    </div>
                    <!-- /.card-header -->
                    <?

                    ?>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="ma_loai" value="<?= $ma_loai ?>"></th>
                                <th>MÃ LOẠI</th>
                                <th>TÊN LOẠI</th>


                                <th>CHỨC NĂNG</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            foreach ($listdanhmuc as $danhmuc) {
                                extract($danhmuc);
                                $suadanhmuc = "index.php?page=suadanhmuc&ma_loai=" . $ma_loai;
                                $xoadanhmuc = "index.php?page=xoadanhmuc&ma_loai=" . $ma_loai;

                                echo '<tr>
                                        <th><input type="checkbox" name="ma_loai" value="<?=$ma_loai?>"></th>    
                                <td>' . $ma_loai . '</td>
                                <td>' . $ten_loai . '</td>
                                <td><a href="' . $suadanhmuc . '"><input class="btn btn-primary" type="button" value="Sửa"></a> <a href="' . $xoadanhmuc . '"><input class="btn btn-primary" type="button" value="Xóa"></a></td>
                            </tr>';
                            }
                            $i++;
                            ?>


                            </tbody>

                        </table>
                        <tr>

                            <th colspan="6">
                                <!-- <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Chọn
                                    tất cả</button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Bỏ
                                    chọn
                                    tất cả</button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Xóa
                                    các
                                    mục chọn</button> -->

                                <a name="" id="" class="btn btn-outline-primary btn-md"
                                   href="index.php?page=addCategories" role="button">Nhập thêm</a>
                            </th>
                        </tr>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">

                                <!-- <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li> -->
                                <?php
                                $LIMIT = 2;
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
                                              <a class="page-link" href="index.php?page=listdanhmuc&page_num=' . $index . '">' . $index . '</a>
                                              </li>';
                                }

                                echo ' </ul>';


                                ?>
                                <!-- <li class="page-item">
                                  <a class="page-link" href="#">Next</a>
                              </li> -->
                                <!-- <li class="page-item"><a class="page-link" href="#">1</a></li> -->

                                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li> -->
                                <!-- <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li> -->

                            </ul>
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
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
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