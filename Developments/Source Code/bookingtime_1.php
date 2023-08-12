<?php
include './Begin.php';
$emid = $_GET['id'];
$day = $_GET['day'];
$service = $_GET['service'];

$queryserid = "SELECT * FROM services where service_id='$service'";
$rsserid = mysqli_query($conn, $queryserid);
$fieldserid = mysqli_fetch_array($rsserid);

$queryemid = "SELECT * FROM employees where employee_id='$emid'";
$rsemid = mysqli_query($conn, $queryemid);
$fieldemid = mysqli_fetch_array($rsemid);

$queryhour = "SELECT * FROM employee_shift where employee_id='$emid' and date='$day'";
$rshour = mysqli_query($conn, $queryhour);

if (isset($_POST['btnSubmit'])):
    $client = $_SESSION["sesAdmin"];
    $time = $_POST['shift'];
    $timeplus = '+' . (string) $fieldserid[4] . ' minutes';
    $newtime = strtotime($timeplus, strtotime($time));
    $newtime = date('H:i:s', $newtime);
    $starttime = $day . ' ' . $time;
    $endtime = $day . ' ' . $newtime;
    $queryappointments = "INSERT into appointments(date_created,client_id ,employee_id,start_time,end_time_expected,service_id)
            values('$datetime','$client','$emid','$starttime','$endtime','$service')";
    $rsappointments = mysqli_query($conn, $queryappointments);
    if ($rsappointments):
        $queryemsta = "update  employee_shift set status='1' where  employee_id='$emid' and date='$day' and time='$time'";
        $rsemsta = mysqli_query($conn, $queryemsta);
        header("location:index.php?msgOK=Đặt lịch thành công!");
    else:
        header("location:index.php?msgErr=Đặt lịch không thành công!");
    endif;
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
                        <a href="">Đặt giờ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="register" style="margin-bottom: 90px;">
            <div class="container-fluid">
                <div class="container">


                    <div class="register-form">
                        <div id="success">
                            <div class="section-header text-center">
                                <h2>Dịch vụ và stylist bạn đã chọn</h2>
                                <p style="margin-top:20px">Các lịch hẹn trễ quá 15 phút sẽ bị tự động huỷ mong quý khách thông cảm và vui lòng đến đúng giờ</p>
                            </div>
                        </div>
                        <form  method="post" id="Form" novalidate="novalidate">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6">
                                    <div class="service">
                                        <div class="service-item">
                                            <div class="service-img">
                                                <img src="./img/<?= $fieldserid[5] ?>" alt="Image">
                                            </div>
                                            <h3><?= $fieldserid[1] ?></h3>
                                            <div class="bottom-sec">
                                                <h1><?= $fieldserid[3] ?></h1>
                                            </div>
                                            <p><?= $fieldserid[2] ?></p>
                                            <p>Thời gian: <?= $fieldserid[4] ?> phút</p>
                                        </div>               
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1">
                                    <div class="team">
                                        <img src="img/icon.png" width="50px" height="50px" style="margin-bottom: auto;margin-top: auto" alt="alt"/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="team">
                                        <div class="team-item">
                                            <div class="team-img">
                                                <img src="img/<?= $fieldemid[5] ?>" alt="Team Image">
                                            </div>
                                            <div class="team-text">
                                                <h2><?= $fieldemid[1] ?> <?= $fieldemid[2] ?></h2>
                                                <p>Master Barber</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="control-group">
                                        <label for="address">Chọn giờ cắt:</label>
                                        <ul id="shift" name="shift" onchange="check()" class="form-control" style="border: 2px solid #1d2434;margin-bottom:20px" required>
                                            
                                            <?php
                                            while ($fieldhour = mysqli_fetch_array($rshour)) :
                                                $shiftdate = $fieldhour[2] . ' ' . $fieldhour[1];

                                                if (strtotime($shiftdate) < strtotime($datetime)):
                                                    ?>
                                            <li>
                                                <span disabled> <?= $fieldhour[1] ?><span class="sr-only">(current)</span></span> 
                                            </li>
                                                    <?php
                                                else:
                                                    if (!($fieldhour[3] == 1)):
                                                        ?>
                                            <li>
                                                <span value="<?= $fieldhour[1] ?>" > <?= $fieldhour[1] ?><span class="sr-only">(current)</span></span> 
                                            </li>
                                                        <?php
                                                    else:
                                                        ?>
                                            <li>
                                                <span value="<?= $fieldhour[1] ?>" disabled > <?= $fieldhour[1] ?><span class="sr-only">(current)</span></span> 
                                            </li>
                                                   
                                                    <?php
                                                    endif;
                                                endif;
                                            endwhile;
                                            ?> 
                                        </ul>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn" type="button" onclick="quay_lai_trang_truoc()" style="margin-right: 10px">Quay lại</button>
                                        <button class="btn" name="btnSubmit" disabled type="submit" id="Button" style="margin-left: 10px">Đặt lịch</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Single Page End -->
    <script>
        function quay_lai_trang_truoc() {
            history.back();
        }
        function check() {
                var shift = document.getElementById("shift").value;
                if (!(shift==="no") ) {
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
