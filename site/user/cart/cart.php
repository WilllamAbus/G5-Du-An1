<!-- <script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
</script> -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Giảm giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng Tiền</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                <?
                $tong = 0;
                $i = 0;
                $ship = 30000;
                $tongthanhtoan = 0;
                $giam_gia=0;
                foreach ($_SESSION['mycart'] as $cart) {

                    $thanhtien = $giam_gia > 0 ? ($cart[2] * $cart[4]) * ($giam_gia = (100 - $cart[5]) / 100) : $cart[2] * $cart[4];
                    $tong = $tong + $thanhtien;
                    $tongthanhtoan = $ship + $tong;
                    echo '
                    <tr>
                    <td class="align-middle"><img  src="../controller/hinh/' . $cart[3] . '"alt="" style="width: 50px;"></td>
                    <td class="align-middle">
                    ' . $cart[1] . '
                </td>
                    <td class="align-middle">' . number_format($cart[2]) . ' VNĐ</td>
                    <td class="align-middle">' . $cart[5] . ' %</td>
                    <td class="align-middle">
                        ' . $cart[4] . '
                    </td>
                    <td class="align-middle">' . number_format($thanhtien) . ' VNĐ</td>
                    <td class="align-middle">
                    <a href="index.php?page=xoacart&idcart=' . $i . '">  Xóa
                    </a>
                  </td>
                </tr>



                
                    ';
                    $i = $i + 1;
                }

                ?>


                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
        <div class="input-group">
                    <input type="hidden" class="form-control border-0 p-4" placeholder="Nhập Mã Giảm Giá">
                    <div class="input-group-append">

                    </div>
                </div>
            <!-- <form class="mb-30" action="#">
                <div class="input-group">
                    <div  class="form-control border-0 p-4" ></div>
                    <div class="input-group-append">
                        <button class="btn btn-primary"><a href="index.php?page=checkorder" style="color:black;">Đơn Hàng Của Bạn</a></button>
                    </div>
                </div>
            </form> -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Tổng Giỏ Hàng</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tổng Tiền Sản Phẩm</h6>
                        <h6><?= number_format($tong,) ?> VNĐ</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Tiền Ship</h6>
                        <h6 class="font-weight-medium"><?= number_format($ship,) ?> VNĐ</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Tổng Tiền</h5>
                        <h5><?= number_format($tongthanhtoan,) ?> VNĐ</h5>
                    </div>
                    <?
                    if ($tongthanhtoan == 0) {
                        echo 'Giỏ Hàng Rỗng';
                    } else {
                        echo ' <a class="thanhtoan" href="index.php?page=checkout"> <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Thanh Toán</button></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .thanhtoan {

        color: black;

    }

    .thanhtoan:hover {

        text-decoration: none;
        color: white;
    }
</style>