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
        <div class="hero">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="hero-text">
                            <?php
                            if (isset($_GET['msgOK'])):
                                echo '<div class="alert alert-success">' . $_GET['msgOK'] . '</div>';
                            endif;
                            ?>
                            <h1>Vì bạn xứng đáng có một đầu tóc đẹp</h1>
                            <p>
                                Đến với chúng tôi để trải nghiệm dịch vụ cắt tóc tận tình và chuyên nghiệp nhất
                            </p>
                            <a class="btn" href="booking.php">Đặt lịch ngay</a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-none d-md-block">
                        <div class="hero-image">
                            <img src="img/hero.png" alt="Hero Image">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-play" data-toggle="modal" data-src="img/video.mp4" data-target="#videoModal">
                    <span></span>
                </button>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="img/video.mp4" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->


        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6">
                        <div class="about-img">
                            <img src="img/about.jpg" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="section-header text-left">
                            <p>Về chúng tôi</p>
                            <h2>8 năm kinh nghiệm</h2>
                        </div>
                        <div class="about-text">
                            <p>
                                100D Barber Shop được thành lập vào tháng 05/2015, với cửa hàng đầu tiên tại số 79 Nguyễn Sơn Hà, Quận 3,
                                TP. Hồ Chí Minh. 
                            </p>
                            <p>   
                                Sau 5 năm, con số này đã lên tới 26 chi nhánh, trải dài từ Bắc tới Nam, 
                                đặc biệt là chi nhánh tại Singapore, trở thành địa điểm yêu thích của phái mạnh đến và định hình phong cách.
                            </p>
                            <a class="btn" href="about.php">Xem tiếp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


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
                                    <h1><?= $fieldservice[3] ?> VNĐ</h1>
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
        <!-- Service End -->


        


        <!-- Team Start -->
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <p>Đội ngũ stylist</p>
                    <h2>Gặp gỡ stylist đến từ nước ngoài</h2>
                </div>
                <div class="row">
                    <?php
                    while ($fieldemployee = mysqli_fetch_array($rsemployees)) :
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <a href="employee.php?id=<?= $fieldemployee[0] ?>" >
                                    <div class="team-img">
                                        <img src="img/<?= $fieldemployee[5] ?>" alt="Team Image">
                                    </div>
                                    <div class="team-text">
                                        <h2><?= $fieldemployee[1] ?> <?= $fieldemployee[2] ?></h2>
                                        <p>Master Barber</p>
                                        <?php
                                        if ($fieldemployee[6] > 0):
                                            $score1 = round((int) $fieldemployee[7] / (int) $fieldemployee[6], 2);
                                        else:
                                            $score1 = 0;
                                        endif;
                                        ?>
                                        <h2 style="margin-top:10px">
                                            <?= $score1 ?> / 5
                                            <img src="img/star.jpg" style="width:25px;height:25px;margin-top:-7px;margin-left: 5px;margin-right:5px" alt="alt"/> 
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>    
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Contact Start -->
        <div class="section-header text-center" style="margin-top: 90px;">
            <p>Liên hệ</p>
            <h2>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi</h2>
        </div>
        <div class="contact" style="margin-bottom: 90px;">
            <div class="container-fluid">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <div class="contact-form">
                                <div id="success"></div>
                                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                    <div class="control-group">
                                        <input type="text" class="form-control" id="name" placeholder="Tên của bạn" required="required" data-validation-required-message="Hãy nhập tên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email của bạn" required="required" data-validation-required-message="Hãy nhập email" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="text" class="form-control" id="subject" placeholder="Tiêu đề" required="required" data-validation-required-message="Hãy nhập tiêu đề" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <textarea class="form-control" id="message" placeholder="Lời nhắn" required="required" data-validation-required-message="Hãy nhập lời nhắn"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn" type="submit" id="sendMessageButton">Gửi lời nhắn</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


        <!-- Blog Start -->
        <div class="blog">
            <div class="container">
                <div class="section-header text-center">
                    <p>Hẹn gặp lại</p>
                    <h2>Cảm ơn bạn đã ghé thăm chúng tôi</h2>
                </div>
                
            </div>
        </div>
        <!-- Single Page End -->


        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
