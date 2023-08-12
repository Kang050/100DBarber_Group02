<?php
include './Begin.php';
if ($id == null):
    header("location:login.php?msgErr=Bạn cần đăng nhập trước khi đi đặt dịch vụ!");
endif;
if (isset($_POST['btnSubmit'])):
    $service = $_POST['service'];
    $emid = $_POST['stylist'];
    $day = $_POST['day'];
    header("location:bookingtime.php?service=$service&id=$emid&day=$day");
endif;
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
                        <h2>Đặt dịch vụ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Đặt dịch vụ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="register" style="margin-bottom: 90px;">
            <div class="container-fluid">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-12">
                            <div class="register-form">
                                <div id="success"></div>
                                <form  method="post" id="Form" novalidate="novalidate">
                                    <div class="service">
                                        <div class="container">
                                            <div class="row">
                                                <?php
                                                while ($fieldservice = mysqli_fetch_array($rsservice)) :
                                                    ?>
                                                    <div class="col-lg-4 col-md-6" >
                                                        <div class="service-item" tabindex="-2">
                                                            <div class="service-img">
                                                                <img src="./img/<?= $fieldservice[5] ?>" alt="Image">
                                                            </div>
                                                            <h3><?= $fieldservice[1] ?></h3>
                                                            <div class="bottom-sec">
                                                                <h1><?= $fieldservice[3] ?> VNĐ</h1>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                ?>                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="team">
                                        <div class="container">
                                            <div class="row">
                                                <?php
                                                while ($fieldemployee = mysqli_fetch_array($rsemployees)) :
                                                    ?>
                                                    <div class="col-lg-3 col-md-6">
                                                        <div class="team-item" tabindex="-1">

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

                                                        </div>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                ?>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Chọn ngày cắt:</label>
                                        <select id="day" onchange="check()" name="day" class="form-control" style="border: 2px solid #1d2434;margin-bottom:20px">
                                            <option value="no" >Chọn ngày cắt</option>
                                            <?php
                                            $date1 = $date;
                                            while (strtotime($date1) < strtotime($newdate)):
                                                ?>
                                                <option value="<?= $date1 ?>"><?= $date1 ?></option>
                                                <?php
                                                $date1 = strtotime('+1 day', strtotime($date1));
                                                $date1 = date('Y-m-d', $date1);
                                            endwhile;
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn" disabled name="btnSubmit"  type="submit" id="Button">Tiếp theo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Single Page End -->
        <style>
            .team .team-item:focus .team-text {
                background: #D5B981;
            }


            .team .team-item:focus .team-img::after {
                border-color: #D5B981;
            }
            
            .service .service-item:focus  {
                background: #D5B981;
            }


            .team .team-item:focus .team-img::after {
                border-color: #D5B981;
            }
        </style>
        <script>
            function check() {
                var stylist = document.getElementById("stylist").value;
                var day = document.getElementById("day").value;
                var service = document.getElementById("service").value;
                if (!(stylist === "no") && !(day === "no") && !(service === "no")) {
                    document.getElementById("Button").disabled = false;
                } else {
                    document.getElementById("Button").disabled = true;
                }
            }
        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
