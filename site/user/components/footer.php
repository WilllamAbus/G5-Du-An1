<footer class="sec-6">
    <div class="backtop" onclick="btnBackTop()">
        <span>Trở lại phía trên</span>
    </div>
</footer>
<div class="container-fluid  text-secondary mt-5 pt-5 bg-darkPP">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-2 col-md-12 mb-5 pr-3 pr-xl-5">
            <h6 class="text-secondary text-uppercase mb-3"> Biết về chúng tôi</h6>
            <p class="mb-2"><a>Về chúng tôi</a></p>
            <p class="mb-2"><a>Blog</a></p>
            <p class="mb-2"><a>Khuyến mãi</a></p>
            <p class="mb-2"><a>Quà tặng</a></p>
            <p class="mb-2"><a>Sự kiện mua sắm</a></p>
        </div>
        <div class="col-lg-2 col-md-12 mb-5 pr-3 pr-xl-5">
            <h6 class="text-secondary text-uppercase mb-3">Kiếm tiền với chúng tôi</h6>
            <p class="mb-2"><a>Affiliate</a></p>
            <p class="mb-2"><a>Thanh toán</a></p>
            <p class="mb-2"><a>Quảng cáo</a></p>

            <p class="mb-2"><a>Vận chuyển</a></p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">

                <div class="col-md-4 mb-5">
                    <h6 class="text-secondary text-uppercase mb-4">Hãy để chúng tôi giúp bạn</h6>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2 " href="#" style="text-decoration: none;">Tài khoản của bạn</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Liên hệ với chúng tôi</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;"> Chăm Sóc Khách Hàng</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Quyền riêng tư</a>

                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h6 class="text-secondary text-uppercase mb-4">Chính Sách</h6>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Chính Sách Hoàn Trả</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Chính Sách Thanh Toán</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Chính Sách Bảo Mật</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Diều Khoản Giao Dịch</a>
                        <a class="text-secondary mb-2" href="#" style="text-decoration: none;">Chính Sách Khách Hàng</a>

                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h6 class="text-secondary text-uppercase mb-4">Góp Ý & Hỏi Đáp</h6>

                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập Email Của Bạn">
                            <div class="input-group-append">
                                <button class="btn btn-primary">GỬI</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Theo Dõi Các Nền Tảng</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div> -->
</div>

<style>
    .bg-darkPP {
        background-color: #2C0425;
    }

    .sec-6 {
        position: relative;
        top: 50px;
    }

    .footer {
        width: 1480px;
        height: 435px;
        transition: all 0.2s;
        position: relative;
        /* top: -1000px; */
    }

    .backtop {
        text-align: center;
        height: 50px;
        background-color: #31052a;
        padding: 10px;
        bottom: 500px;
        color: white;
    }

    .backtop span {
        font-weight: bold;
        font-size: 22px;
    }

    .backtop:hover {
        background-color: #5a024c;
    }
</style>

<script>
    function btnBackTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    }
</script>