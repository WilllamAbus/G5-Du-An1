<?

?>
<div class="container-fluid">
    <div class="py-5 text-center">
        <h2>ĐƠN HÀNG CỦA BẠN</h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Giá</th>
                        <th>Giảm giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?
                  
                    foreach ($dshd as $hd) {
                       
                        echo '
                    <tr>
                    <td> <img src="../controller/hinh/' . $hinh . '" width = "90px">  </td>
                    <td class="align-middle">' . $dia_chi . ' </td>

                    <td class="align-middle">
                    ' . $sdt . '
                </td>
                    <td class="align-middle">' . number_format($tongtien, ) . ' VNĐ</td>
                  
                    <td class="align-middle">
                        ' . $cart[4] . '
                    </td>
                    <td class="align-middle">' . number_format($thanhtien) . ' VNĐ</td>
                    <td class="align-middle text-success">Người Gửi Đang Chuẩn Bị Hàng</td>
                  
                    <td class="align-middle">
                    <a href="index.php?page=xoacart&idcart=' . $i . '">  Hủy Đơn</a>
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
            <!-- <div class="input-group">
                    <input type="hidden" class="form-control border-0 p-4" placeholder="Nhập Mã Giảm Giá">
                    <div class="input-group-append">
                    <h5 class="section-title position-relative text-uppercase mb-3">  <a href="index.php?page=checkorder"  class="bg-secondary pr-3">Đơn hàng của bạn</a>
            </h5>
                    </div>
                </div> -->
            <form class="mb-30" action="index.php?page=checkout">
                <!-- <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Nhập Mã Giảm Giá">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Nhập</button>
                    </div>
                </div> -->
            </form>
            <!-- <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Tổng Giỏ Hàng</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Tổng Tiền Sản Phẩm</h6>
                    
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Tiền Ship</h6>
                     
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Tổng Tiền</h5>
                       
                    </div>
             
                </div>
            </div> -->
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