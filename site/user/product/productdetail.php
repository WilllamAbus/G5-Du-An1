<div class="container-fluid pb-5">
    <?php
    $ma_hh = '';
    if (isset($_GET['ma_hh'])) {
        extract($_REQUEST);
        $ma_hh = $_GET['ma_hh'];

        $product = san_pham_select_by_id($ma_hh);
        hang_hoa_tang_so_luot_xem($ma_hh);
        if (($product) == true) {

            extract($product);
            echo '
<div class="row px-xl-5">
<div class="col-lg-5 mb-30">
    <div id="product-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner bg-light">
            <div class="carousel-item active p-lg-4">
                <img style="max-width: 70%; max-height: 120vh; margin: 0; " class=" rounded-4 fit"
                    src="../controller/hinh/' . $hinh . '" alt="">
            </div>

        </div>
        <!-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
        <i class="fa fa-2x fa-angle-left text-dark"></i>
    </a>
    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
        <i class="fa fa-2x fa-angle-right text-dark"></i>
    </a> -->
    </div>
</div>

<div class="col-lg-7 h-auto mb-30">
    <div class="h-100 bg-light p-30">
        <h3>
            ' . $ten_hh . '
        </h3>
        <div class="d-flex mb-3">
            <div class="text-primary mr-2">
                <small class="fas fa-star"></small>
                <small class="fas fa-star"></small>
                <small class="fas fa-star"></small>
                <small class="fas fa-star-half-alt"></small>
                <small class="far fa-star"></small>
            </div>
            <small class="pt-1">(' . $so_luot_xem . ')
            </small>
        </div>
        <h3 class="font-weight-semi-bold mb-4">
        ' . number_format($giam_gia) . ' %
        
        </h3>
        <h3 class="font-weight-semi-bold mb-4">
        ' . number_format($don_gia) . ' đ
            
        </h3>
        <p class="mb-4"> Sự lựa chọn của tác giả về 100 cuốn sách phi hư cấu hay nhất
            bằng tiếng Anh kéo dài 400 năm. Mỗi mục có một bài phê bình hai trang của cuốn sách trong câu hỏi.
        </p>
        </p>

      
        
<form action="index.php?page=giohang" method="post">
    <div class="d-flex align-items-center mb-4 pt-2" name="soluong">
    <p>Số Lượng:  <input type="number" id="number" name="soluong" value="1" min="0" max="10" /> </p><br>
        </div>
       
        
     
        <input type="hidden" name="mahh" value="' . $ma_hh . '">
        <input type="hidden" name="tenhh" value="' . $ten_hh . '">
        <input type="hidden" name="dongia" value="' . $don_gia . '">   
        <input type="hidden" name="hinh" value="' . $hinh . '">
        <input type="hidden" name="giamgia" value="' . $giam_gia . '">
        <input type="submit" name="addcart"   class="btn btn-warning shadow-0" value="Thêm vào giỏ hàng">
        </form>
    </div>
   
        <!-- <div class="d-flex pt-2">
        <strong class="text-dark mr-2">Share on:</strong>
        <div class="d-inline-flex">
            <a class="text-dark px-2" href="">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-dark px-2" href="">
                <i class="fab fa-pinterest"></i>
            </a>
        </div>
    </div> -->
    </div>
</div>
</div>

';


        }
    };
    ?>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Mô Tả Sản
                        Phẩm</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Giới thiệu về tác giả</h4>
                        <p>Malcolm Gladwell là tác giả của năm cuốn sách bán chạy nhất của New York Times:
                            The Tipping Point, Blink, Outliers, What the Dog Saw, và David và Goliath</p>
                        <p> Anh ấy cũng là người đồng sáng lập của Pushkin Industries, một công ty nội dung âm thanh sản
                            xuất podcast Lịch sử xét lại, xem xét lại những điều vừa bị bỏ qua và hiểu lầm, và Broken
                            Record, nơi anh ấy, Rick Rubin và Bruce Headlam phỏng vấn các nhạc sĩ trên nhiều lĩnh vực
                            khác nhau. thể loại. Gladwell đã được đưa vào danh sách 100 người có ảnh hưởng nhất của Time
                            và được giới thiệu
                            là một trong những Nhà tư tưởng toàn cầu hàng đầu của Chính sách đối ngoại.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active " data-toggle="tab" href="#tab-pane-1">Bình Luận</a>
                </div>
                <div class="tab-content">


                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <h4 class="mb-4">Danh Sách Bình Luận</h4>
                                <div class="media mb-4">
                                    <img src="./user/style/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                        style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum
                                            et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <!-- <h4 class="mb-4">Bình Luận</h4> -->
                                <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                                <script>
                                    $(document).ready(function () {
                                        $("#binhLuan").load("user/binhLuan/binhLuanForm.php", { ma_hh: <?= $ma_hh ?> });
                                    });
                                </script> -->


                                <div class="commented-section mt-2">
                                    <!-- <div class="d-flex flex-row align-items-center commented-user">
                  <h5 class="mr-2">Le A</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">
                  </span>
                </div> -->
                                    <div class="comment-text-sm" id="binhLuan">
                                        <iframe src="user/binhLuan/binhLuanForm.php?ma_hh=<?= $_GET['ma_hh'] ?>"
                                                frameborder="0" width="1270px" height="400px"></iframe>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Sản phẩm liên quan-->
<!-- <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản Phẩm Liên Quan</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./user/style/img/product-1.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./user/style/img/product-2.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./user/style/img/product-3.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./user/style/img/product-4.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="./user/style/img/product-5.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


<style>
    .picture {
        height: 340px;
    }
</style>