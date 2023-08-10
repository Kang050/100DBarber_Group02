
<!-- Top Bar Start -->
<div class="top-bar d-none d-md-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="top-bar-left">
                    <div class="text">
                        <h2>9:00 - 19:30</h2>
                        <p>Giờ mở cửa</p>
                    </div>
                    <div class="text">
                        <h2>0938707609</h2>
                        <p>Gọi để đặt lịch trực tiếp</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="top-bar-right">
                    <div class="social">
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-linkedin-in"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar End -->

<!-- Nav Bar Start -->
<div class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Barber <span>100D</span></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="index.php" class="nav-item nav-link">Trang chủ</a>
                <a href="about.php" class="nav-item nav-link">Về 100DBarber</a>
                <a href="service.php" class="nav-item nav-link">Dịch vụ</a>
                <a href="stylist.php" class="nav-item nav-link">Stylist</a>
                <a href="gallery.php" class="nav-item nav-link">Thư viện</a>
                <a href="shop.php" class="nav-item nav-link">Cửa hàng</a>              
                <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                <?php
                if (isset($_SESSION["sesAdmin"])):
                    echo '<a href="profile.php" class="nav-item nav-link login">' . $user . '</a>';
                    echo '<a href="cart.php" class="nav-item nav-link login" style="border-radius:15px;'
                . 'margin:0 5px 0 5px">Giỏ hàng: '.$countcartitem2.'</a>';
                    echo '<a href="logout.php" class="nav-item nav-link">Đăng xuất</a>';

                else:

                    echo'
                <a href="login.php" class="nav-item nav-link login">Đăng nhập</a>
                <a href="register.php" class="nav-item nav-link">Đăng Ký</a>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>