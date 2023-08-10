<?php
include './Begin.php';
if($id==null):
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

                        <div class="col-md-6">
                            <div class="register-form">
                                <div id="success"></div>
                                <form  method="post" id="Form" novalidate="novalidate">
                                    <div class="control-group">
                                        <label for="name">Chọn dịch vụ:</label>
                                        <select id="service" onchange="check()" name="service" class="form-control" style="border: 2px solid #1d2434;margin-bottom:20px">
                                            <option value="no" >Chọn dịch vụ</option>
                                            <?php
                                            while ($fieldservice = mysqli_fetch_array($rsservice)) :
                                                ?>
                                                <option value="<?= $fieldservice[0] ?>"><?= $fieldservice[1] ?></option>
                                                <?php
                                            endwhile;
                                            ?> 
                                        </select>
                                    </div>

                                    <div class="control-group">
                                        <label for="province">Chọn stylist:</label>
                                        <select id="stylist" onchange="check()" name="stylist" class="form-control" style="border: 2px solid #1d2434;margin-bottom:20px">
                                            <option value="no" >Chọn stylist</option>
                                            <?php
                                            while ($fieldemployee = mysqli_fetch_array($rsemployees)) :
                                                ?>
                                                <option value="<?= $fieldemployee[0] ?>"><?= $fieldemployee[1] ?> <?= $fieldemployee[2] ?></option>
                                                <?php
                                            endwhile;
                                            ?> 
                                        </select>
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

        <script>
            function check() {
                var stylist = document.getElementById("stylist").value;
                var day = document.getElementById("day").value;
                var service = document.getElementById("service").value;
                if (!(stylist==="no") && !(day==="no") && !(service==="no")) {
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
