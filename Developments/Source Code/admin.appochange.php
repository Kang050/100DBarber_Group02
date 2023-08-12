<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (isset($_GET['id'])):
    $appoid = $_GET['id'];
    $proid = $_GET['proid'];
    $queryappoid = "select * from appointments where appointment_id='$appoid'";
    $rsappoid = mysqli_query($conn, $queryappoid);
    $fieldappoid = mysqli_fetch_array($rsappoid);
    $aid = $fieldappoid[0];
    $adate = $fieldappoid[1];
    $acli = $fieldappoid[2];
    $aem = $fieldappoid[3];
    $astart = $fieldappoid[4];
    $aend = $fieldappoid[5];
    $astatus = $fieldappoid[6];
    $areason = $fieldappoid[7];
    $aser = $fieldappoid[8];
    $querycli = "select * from clients where client_id='$acli'";
    $rscli = mysqli_query($conn, $querycli);
    $fieldcli = mysqli_fetch_array($rscli);
    $queryappname = "select first_name,last_name from employees where employee_id='$aem'";
    $rsappname = mysqli_query($conn, $queryappname);
    $fieldappname = mysqli_fetch_array($rsappname);
    $querysername = "select service_name from services where service_id='$aser'";
    $rssername = mysqli_query($conn, $querysername);
    $fieldsername = mysqli_fetch_array($rssername);
endif;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main_1.php'; ?>

        <!-- Single Page Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Đơn đặt dịch vụ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Đơn đặt dịch vụ</a>
                        <a href=''>Chi tiết đơn dịch vụ</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="single">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Thông tin đơn dịch vụ</h2>
                </div>
                <form  method="post" id="Form" novalidate="novalidate"  >
                    <div class="row justify-content-center">

                        <div class="col-4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th >Tên khách hàng</th>
                                        <td ><?= $fieldcli[2] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày đặt:</th>
                                        <td><?= $adate ?></td>
                                    </tr>
                                </tbody>  
                            </table>
                        </div>
                        <div class="col-4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Dịch vụ:</th>
                                        <td ><?= $fieldsername[0] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Stylist:</th>
                                        <td><?= $fieldappname[0] ?> <?= $fieldappname[1] ?></td>
                                    </tr>
                                </tbody>  
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th >Giờ bắt đầu:</th>
                                        <td ><?= $astart ?></td>
                                    </tr>
                                    <tr>
                                        <th>Giờ kết thúc:</th>
                                        <td><?= $aend ?></td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <?php
                                        switch ($astatus):
                                            case "0":
                                                echo "<td>Chưa hoàn thành</td>";
                                                break;
                                            case "1":
                                                echo "<td>Đã hoàn thành</td>";
                                                break;
                                            case "2":
                                                echo "<td>Đã huỷ</td>";
                                                break;
                                            case "3":
                                                echo "<td>Đang tiến hành</td>";
                                                break;
                                        endswitch;
                                        ?>
                                    </tr>   
                                    <?php
                                    if($astatus==="2"):
                                    ?>
                                    <tr>
                                        <th>Lý do</th>
                                        <td><?=$areason?></td>
                                    </tr>
                                    <?php
                                    endif;
                                    ?>
                                </tbody>  
                            </table>
                        </div>
                        <div class="row justify-content-center col-12">
                            <button class="btnp" type="button" onclick="location.href = 'admin.appointment.php?proid=<?= $proid ?>'" style="">Quay lại</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- Single Page End -->
        <style>
            .btnp {
                padding: 15px 30px;

                font-size: 16px;
                font-weight: 600;
                letter-spacing: 1px;
                color: #1d2434;
                background: none;
                border: 2px solid #1d2434;
                border-radius: 0;
                transition: .3s;
            }

            .btnp:hover {
                color: #D5B981;
                background: #1d2434;
            }
        </style>
        <!-- Footer Start -->
        <?php include './Foot_1.php'; ?>
    </body>
</html>
