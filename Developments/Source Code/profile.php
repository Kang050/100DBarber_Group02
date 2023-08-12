<?php
include './Begin.php';

if (isset($_GET['cardid'])):
    $delcardid = $_GET['cardid'];
    $querydelcardid = "delete from client_credit_card_info where id='$delcardid'";
    $rsdelcardid = mysqli_query($conn, $querydelcardid);
    header("location:profile.php?msgOK=Xoá phương thức thanh toán thành công!");
endif;
if (isset($_GET['addressid'])):
    $deladdid = $_GET['addressid'];
    $querydeladdid = "delete from addresses where address_id='$deladdid'";
    $rsdeladdid = mysqli_query($conn, $querydeladdid);
    header("location:profile.php?msgOK=Xoá địa chỉ thành công!");
endif;
$queryappid = "select * from appointments where client_id='$id'";
$rsappid = mysqli_query($conn, $queryappid);
$countappid = mysqli_num_rows($rsappid);

$queryorderid = "select * from orders where client_id='$id'";
$rsorderid = mysqli_query($conn, $queryorderid);
$countorderid = mysqli_num_rows($rsorderid);
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
                    <?php
                    if (isset($_GET['msgOK'])):
                        echo '<div class="alert alert-success">' . $_GET['msgOK'] . '</div>';
                    endif;
                    if (isset($_GET['msgErr'])):
                        echo '<div class="alert alert-danger">' . $_GET['msgErr'] . '</div>';
                    endif;
                    ?>
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
                                        <a  href="changeinfo.php">Cập nhập thông tin</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mật Khẩu</th>
                                    <td>********</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td style="font-style:italic">
                                        <a  href="changepass.php">Đổi mật khẩu</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <div class="section-header text-center">
                            <p>Danh sách phương thức thanh toán đăng ký</p>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Ngân hàng phát hành</th>
                                    <th>Số thẻ</th>
                                    <th>Thời hạn</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($countcard == 0):
                                    echo 'Không có phương thức thanh toán nào!';
                                else:
                                    $dem = 1;
                                    while ($fieldcard = mysqli_fetch_array($rscard)) :
                                        ?>
                                        <tr>
                                            <td><?= $dem ?></td>
                                            <td><?= $fieldcard[2] ?></td>
                                            <td><?= $fieldcard[3] ?></td>
                                            <td><?= $fieldcard[4] ?></td>
                                            <td>
                                                <a style="font-style: italic" href="payment.php?choice=2&back=profile.php&id=<?= $fieldcard[0] ?>" >Cập nhập</a> |
                                                <a style="font-style: italic" href="profile.php?cardid=<?= $fieldcard[0] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá phương thức thanh toán này?')">Xoá</a>
                                            </td>
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
                                    <td>
                                        <a style="font-style: italic" href="payment.php?choice=1&back=profile.php" >Thêm phương thức thanh toán</a></td>
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
                                            <td>
                                                <a style="font-style: italic" href="address.php?choice=2&back=profile.php&id=<?= $fieldaddid[0] ?>" >Cập nhập địa chỉ</a> |
                                                <a style="font-style: italic" href="profile.php?addressid=<?= $fieldaddid[0] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá địa chỉ này?')">Xoá</a>
                                            </td>
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
                                    <td>
                                        <a style="font-style: italic" href="address.php?choice=1&back=profile.php" >Thêm địa chỉ</a></td>
                                    </td>
                                </tr>

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
