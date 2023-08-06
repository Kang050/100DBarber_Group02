<?php
include './Begin.php';

$queryappid = "select * from appointments where client_id='$id'";
$rsappid = mysqli_query($conn, $queryappid);
$countappid = mysqli_num_rows($rsappid);
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
                        <h2>Hồ sơ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Hồ sơ</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Single Page Start -->
        <div class="single">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Thông tin khách hàng</h2>
                    <p style="margin-top:20px">Thông tin cá nhân</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <td><?= $fielduser[2] ?></td>

                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $fielduser[1] ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td><?= $fielduser[3] ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td style="font-style:italic">
                                        <a class="btn" href="booking.php">Cập nhập thông tin</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mật Khẩu</th>
                                    <td>********</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td style="font-style:italic">
                                        <a class="btn" href="booking.php">Đổi mật khẩu</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="section-header text-center">
                            <p>Danh sách địa chỉ đăng ký</p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Tỉnh</th>
                                    <th>Địa chỉ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($countaddid == 0):
                                    echo 'Không có địa chỉ nào!';
                                else:
                                    $dem = 1;
                                    while ($fieldaddid = mysqli_fetch_array($rsaddid)) :
                                        ?>
                                        <tr>
                                            <td><?= $dem ?></td>
                                            <td><?= $fieldaddid[2] ?></td>
                                            <td><?= $fieldaddid[3] ?></td>
                                            <td style="font-style:italic">
                                                <a class="btn" href="booking.php">Cập nhập địa chỉ</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $dem++;
                                    endwhile;
                                endif;
                                ?>           
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="font-style:italic">
                                        <a class="btn" href="booking.php">Thêm địa chỉ mới</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="section-header text-center">
                    <h2>Dịch vụ đã đặt</h2>
                    <p style="margin-top:20px">Danh sách lịch hẹn trong khoảng từ hôm nay đến 5 ngày nữa</p>
                    <p>Các lịch hẹn trễ quá 15 phút sẽ bị tự động huỷ mong quý khách thông cảm và vui lòng đến đúng giờ</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Ngày đặt</th>
                                    <th>Stylist</th>
                                    <th>Dịch vụ</th>
                                    <th>Giờ bắt đầu</th>
                                    <th>Giờ kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Lý do</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($countappid == 0):
                                    echo 'Không có lịch đặt nào!';
                                else:
                                    $dem = 1;
                                    while ($fieldappid = mysqli_fetch_array($rsappid)) :
                                        $bookdate = date('Y-m-d', strtotime($fieldappid[4]));
                                        if (strtotime($bookdate) >= strtotime($date)):
                                            ?>
                                            <tr>
                                                <td><?= $dem ?></td>
                                                <td><?= $fieldappid[1] ?></td>
                                                <?php
                                                $queryappname = "select first_name,last_name from employees where employee_id='$fieldappid[3]'";
                                                $rsappname = mysqli_query($conn, $queryappname);
                                                $fieldappname = mysqli_fetch_array($rsappname);
                                                ?>
                                                <td><?= $fieldappname[0] . ' ' . $fieldappname[1] ?></td>
                                                <?php
                                                $querysername = "select service_name from services where service_id='$fieldappid[8]'";
                                                $rssername = mysqli_query($conn, $querysername);
                                                $fieldsername = mysqli_fetch_array($rssername);
                                                ?>
                                                <td><?= $fieldsername[0] ?></td>
                                                <td><?= $fieldappid[4] ?></td>
                                                <td><?= $fieldappid[5] ?></td>
                                                <?php
                                                switch ($fieldappid[6]):
                                                    case "0":
                                                        echo "<td>Chưa hoàn thành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        echo
                                                        "<td style='font-style:italic'><a class='btn' "
                                                        . "href='booking.php'>Sửa</a></td>";
                                                        echo "<td style='font-style:italic'>
                                                    <a class='btn' href='booking.php'>Huỷ</a>
                                                </td> ";
                                                        break;
                                                    case "1":
                                                        echo "<td>Đã hoàn thành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                    case "2":
                                                        echo "<td>Đã huỷ</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                    case "3":
                                                        echo "<td>Đang tiến hành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                endswitch;
                                                ?>
                                            </tr>
                                            <?php
                                            $dem++;
                                        endif;
                                    endwhile;
                                endif;
                                ?>           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Page End -->

        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
