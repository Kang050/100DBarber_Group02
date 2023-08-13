<?php
include_once './Begin.php';
$choice = $_GET['choice'];
$back = $_GET['back'];
if ($choice == '1'):
    $title = 'Thêm';
    $province = '';
    $address = '';
else:
    $title = "Cập nhập";
    $addid = $_GET['id'];
    $queryidadd = "select * from addresses where address_id='$addid'";
    $rsidadd = mysqli_query($conn, $queryidadd);
    $fieldidadd = mysqli_fetch_array($rsidadd);
    $province = $fieldidadd[2];
    $address = $fieldidadd[3];
endif;
if (isset($_POST['btnadd'])):
    $province = $_POST['province'];
    $address = $_POST['address'];
    $query1 = "INSERT into addresses(client_id,province,address) values('$fielduser[0]','$province','$address')";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:address.php?msgErr=Nothing to save!");
    else:
        header("location:$back?msgOK=Thêm địa chỉ thành công!");
    endif;
endif;
if (isset($_POST['btnupdate'])):
    $province = $_POST['province'];
    $address = $_POST['address'];
    $query1 = "update addresses set province='$province',address='$address' where address_id='$addid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:address.php?msgErr=Nothing to save!");
    else:
        header("location:$back?msgOK=Cập nhập địa chỉ thành công!");
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
                        <h2>Đăng ký</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href=""><?= $title ?> địa chỉ</a>
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
                                        <label for="province">Tỉnh:</label>
                                        <input type="text" class="form-control" id="province" name="province" value="<?= $province ?>"
                                               required="required"
                                               placeholder="Tỉnh của bạn"
                                               data-validation-required-message="Vui lòng nhập tỉnh của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= $address ?>"
                                               required="required"
                                               placeholder="Địa chỉ của bạn"
                                               data-validation-required-message="Vui lòng nhập địa chỉ của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <input type="hidden" name="form1" id="ok" />
                                    <?php
                                    if ($choice == '1'):
                                        ?>
                                        <button class="btn" name="btnadd" type="submit" id="Button">Thêm địa chỉ</button>
                                        <?php
                                    else:
                                        ?>
                                        <button class="btn" name="btnupdate" type="submit" id="Button">Cập nhập</button>
                                    <?php
                                    endif;
                                    ?>
                            </div>
                            </form>
                        </div>
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
