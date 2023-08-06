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
        <!-- Service End -->


        <!-- Pricing Start -->
        <div class="price">
            <div class="container">
                <div class="section-header text-center">
                    <p>Our Best Pricing</p>
                    <h2>We Provide Best Price in the City</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-1.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Hair Cut</h2>
                                <h3>$9.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-2.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Hair Wash</h2>
                                <h3>$10.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-3.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Hair Color</h2>
                                <h3>$11.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-4.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Hair Shave</h2>
                                <h3>$12.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-5.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Hair Straight</h2>
                                <h3>$13.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-6.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Facial</h2>
                                <h3>$14.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-7.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Shampoo</h2>
                                <h3>$15.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-8.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Beard Trim</h2>
                                <h3>$16.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-9.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Beard Shave</h2>
                                <h3>$17.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-10.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Wedding Cut</h2>
                                <h3>$18.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-11.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Clean Up</h2>
                                <h3>$19.99</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <img src="img/price-12.jpg" alt="Image">
                            </div>
                            <div class="price-text">
                                <h2>Massage</h2>
                                <h3>$20.99</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pricing End -->


        <!-- Testimonial Start -->
        <div class="testimonial">
            <div class="container">
                <div class="owl-carousel testimonials-carousel">
                    <div class="testimonial-item">
                        <img src="img/testimonial-1.jpg" alt="Image">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut mollis mauris. Vivamus egestas eleifend dui ac consequat. Fusce venenatis at lectus in malesuada. Suspendisse sit amet dolor et odio varius mattis.
                        </p>
                        <h2>Client Name</h2>
                        <h3>Profession</h3>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-2.jpg" alt="Image">
                        <p>
                            Phasellus pellentesque tempus pretium. Quisque in enim sit amet purus venenatis porttitor sed non velit. Vivamus vehicula finibus tortor. Aliquam vehicula molestie pulvinar. Sed varius libero in leo finibus, ac consectetur tortor rutrum.
                        </p>
                        <h2>Client Name</h2>
                        <h3>Profession</h3>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-3.jpg" alt="Image">
                        <p>
                            Sed in lectus eu eros tincidunt cursus. Aliquam eleifend velit nisl. Sed et posuere urna, ut vestibulum massa. Integer quis magna non enim luctus interdum. Phasellus sed eleifend erat. Aliquam ligula ex, semper vel tempor pellentesque, pretium eu nulla.
                        </p>
                        <h2>Client Name</h2>
                        <h3>Profession</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


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
                                <div class="team-img">
                                    <img src="<?= $fieldemployee[5] ?>" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2><?= $fieldemployee[1] ?> <?= $fieldemployee[2] ?></h2>
                                    <p>Master Barber</p>
                                </div>
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
                <div class="owl-carousel blog-carousel">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-1.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Hair Cut</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-2.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Beard Style</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-3.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Color & Wash</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-4.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Hair Cut</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-5.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Beard Style</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="img/blog-6.jpg" alt="Blog">
                        </div>
                        <div class="blog-meta">
                            <i class="fa fa-list-alt"></i>
                            <a href="">Color & Wash</a>
                            <i class="fa fa-calendar-alt"></i>
                            <p>01-Jan-2045</p>
                        </div>
                        <div class="blog-text">
                            <h2>Lorem ipsum dolor</h2>
                            <p>
                                Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor
                            </p>
                            <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page End -->


        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
