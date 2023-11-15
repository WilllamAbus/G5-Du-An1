<?
include_once '../dao/loai.php';
?>
<style>
    #abc form input:hover {
        border-color: #FBEE2C;

    }
</style>
<link href="/your-path-to-fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="" style="text-decoration: none;">www.mossan.vn
                </a>

            </div>
        </div>

        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group">
                    <!-- <button type="submit" ></button> -->
                    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown"
                       style="text-decoration: none;">Xin chào,
                        <?php
                        if (isset($_COOKIE['ma_nd'])) {
                            echo $_COOKIE['ma_nd'];


                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="index.php?page=signup">Đăng Kí</a>
                        <a class="dropdown-item" href="index.php?page=signup">Thông tin tài khoản</a>
                        <!-- <button  type="button"></button> -->
                        <button class="dropdown-item" type="button"><a style="text-decoration: none; color: red;"
                                                                       href="index.php?page=logout">Đăng Xuất</a>
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                        style="padding-bottom: 2px;">5</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle"
                        style="padding-bottom: 2px;">0</span>
                </a>
            </div> -->
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-2">
            <a href="index.php?page=trangchu" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2 ground">MOS</span>
                <span class="h1 text-uppercase text-dark  px-2 ml-n1">SAN</span>
                <!-- <img src="img/logoweb.jpg"alt="no photo" width="100px"> -->
            </a>
        </div>
        <div class="col-6  text-left " id="abc">
            <form action="index.php?page=sanpham" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="inputProduct" placeholder="Tìm Kiếm Sản Phẩm...">
                    <div class="input-group-append" style="color:#FBEE2C;">
                        <span class="input-group-text bg-transparent text-primary">
                            <button type="submit" style="border:none; background-color: yellow;"> <i
                                        class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <div class="  text-right">
            <p class="m-3"><a href="index.php?page=login" style="text-decoration: none; color: black;">ĐĂNG NHẬP</a></p>

        </div>
        <div class="  text-right">
            <p class="m-3"><a href="index.php?page=update" style="text-decoration: none; color: black;">CẬP NHẬT</a></p>

        </div>
        <div class=" col-md-1">
            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                <a href="index.php?page=giohang" class="btn px-0 ml-3">
                    <span class="material-symbols-outlined" style="font-size: 41px; color: #FBEE2C;">
                        shopping_cart
                    </span>
                    <span class="badge border border-secondary rounded-circle"
                          style="padding-bottom: 2px; color: black; ">8</span>
                </a>
            </div>

        </div>

    </div>
</div>
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
               href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class=" m-0"><i class="fa fa-bars mr-2"></i>Danh Mục Sản Phẩm</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                 id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                <div class="navbar-nav w-100">
                    <!-- <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div> -->
                    <?
                    $listdanhmuc = loadall_danhmuc();
                    foreach ($listdanhmuc as $dm) {
                        extract($dm);
                        $link = "index.php?page=sanpham&maloai=" . $ma_loai;
                        echo ' <a href="' . $link . '" class="nav-item nav-link">' . $ten_loai . '</a>';
                    }
                    ?>

                    <!-- <a href="index.php?page=danhmuc" class="nav-item nav-link">Tài chính</a>
                    <a href="index.php?page=danhmuc" class="nav-item nav-link">Lập trình</a>
                    <a href="index.php?page=danhmuc" class="nav-item nav-link">Văn học</a>
                    <a href="index.php?page=danhmuc" class="nav-item nav-link">Tự nhiên</a> -->
                    <!-- <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a> -->
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg  navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php?page=trangchu" class="nav-item nav-link ">Trang Chủ</a>
                        <a href="index.php?page=sanpham" class="nav-item nav-link">Sản Phẩm</a>
                        <a href="#" class="nav-item nav-link">Chính Sách</a>
                        <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Chính Sách</a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="cart/cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Bài Viết</a>
                                </div>
                            </div> -->
                        <a href="#" class="nav-item nav-link">Liên Hệ</a>
                    </div>
                    <!-- <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="index.php?page=giohang" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                style="padding-bottom: 2px;">8</span>
                        </a>
                    </div> -->
                </div>
            </nav>
        </div>
    </div>
</div>