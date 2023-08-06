<?php
include_once './Begin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main.php'; ?>

        <!-- Single Page Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Dịch vụ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Dịch vụ</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>Các gói dịch vụ của chúng tôi</p>
                    <h2>Chọn gói dịch vụ dành cho bạn</h2>
                </div>
                <div class="row">
                    <?php
                    while ($fieldservice = mysqli_fetch_array($rsservice)) :
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="<?= $fieldservice[5] ?>" alt="Image">
                                </div>
                                <h3><?= $fieldservice[1] ?></h3>
                                <div class="bottom-sec">
                                    <h1><?= $fieldservice[3] ?></h1>
                                </div>
                                <p><?= $fieldservice[2] ?></p>
                                <p>Thời gian: <?= $fieldservice[4] ?> phút</p>
                                <a class="btn" href="booking.php?id=<?= $fieldservice[0] ?>">Đặt dịch vụ</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>                   
                </div>
            </div>
        </div>
        <!-- Single Page End -->

        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
