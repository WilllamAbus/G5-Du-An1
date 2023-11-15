<?


// if($res->num_rows > 0) {
//     while ($item= $res->fetch_assoc()) {
//         print_r($item);
//         echo "<br>";
//     }
// };


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
    .img-picture {
        width: 100px;
        height: 100px;
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
                        <h3 class="card-title">CHI TIẾT BÌNH LUẬN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Mã bình luận</th>
                                <th>Nội dung</th>
                                <th>Ngày bình luận</th>
                                <th>Người bình luận</th>
                                <th>Phản hồi</th>
                                <th>Chức năng</th>

                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            foreach ($items as $item) {
                                extract($item);
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="ma_bl[]" value="<?= $ma_bl ?>" id="">
                                        <?= $ma_bl ?>
                                    </td>

                                    <td>
                                        <?= $noi_dung ?>
                                    </td>
                                    <td>
                                        <?= $ngay_lap ?>
                                    </td>
                                    <td>
                                        <?= $ma_nd ?>
                                    </td>
                                    <td>
                                        <form action="index.php?page=phan-hoi-binh-luan&ma_bl=<?= $ma_bl ?>"
                                              method="post" class="form-reppy">
                                            <input type="hidden" name="ma_bl" value="<?= $ma_bl ?>">
                                            <input type="hidden" name="ma_hh" value="<?= $ma_hh ?>">

                                            <input type="text" name="phan_hoi" id="" class="form-control"
                                                   placeholder="Phản hồi">

                                            <input type="submit" name="phanHoiBL" id=""
                                                   class="btn-secondary col-md-3">
                                        </form>
                                    </td>
                                    <td>

                                        <button class="btn btn-default"><a
                                                    href="index.php?page=xoa-binh-luan&ma_bl=<?= $ma_bl ?>">Xóa</a>
                                        </button>

                                    </td>

                                    <!-- <a href="index.php?act=form-phan-hoi-binh-luan&ma_bl=">Phản hồi</a -->
                                </tr>

                                <?php

                            }
                            ?>


                            </tbody>


                        </table>

                        <tr>

                            <th colspan="4">
                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Chọn
                                    tất cả
                                </button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Bỏ chọn
                                    tất cả
                                </button>

                                <button class="btn btn-outline-primary btn-md  " name="addPro" type="submit">Xóa các
                                    mục chọn
                                </button>


                            </th>
                        </tr>


                        <nav aria-label="Page navigation example d-block">

                            <?php


                            ?>
                            <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->


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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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