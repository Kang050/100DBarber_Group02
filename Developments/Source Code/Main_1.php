
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
        <a href="admin.index.php" class="navbar-brand">Barber <span>100D</span></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="admin.client.php" class="nav-item nav-link">Khách hàng</a>
                <a href="admin.employee.php" class="nav-item nav-link">Nhân viên</a>
                <a href="admin.service.php" class="nav-item nav-link">Dịch vụ</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sản phẩm</a>
                    <div class="dropdown-menu">
                        <a href="admin.cate.php" class="dropdown-item">Danh mục sản phẩm</a>
                        <a href="admin.product.php?caid=" class="dropdown-item">Danh sách sản phẩm</a>
                    </div>
                </div>
                <a href="admin.order.php?proid=" class="nav-item nav-link">Đơn đặt hàng</a>              
                <a href="admin.appointment.php?proid=" class="nav-item nav-link">Đơn đặt dịch vụ</a>
                <?php
                if (isset($_SESSION["Admin"])):
                    echo '<a href="" class="nav-item nav-link login">' . $user . '</a>';
                    echo '<a href="admin.logout.php" class="nav-item nav-link">Đăng xuất</a>';

                else:

                    echo'
                <a href="admin.login.php" class="nav-item nav-link login">Đăng nhập</a>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>