<?php
include_once './Begin.php';

$name = $fielduser[2];
$email = $fielduser[1];
$phone = $fielduser[3];

if (isset($_POST['btnupdate'])):
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $query1 = "update clients set name='$name',client_email='$email',phone_number='$phone' where client_id='$fielduser[0]'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:changinfo.php?msgErr=Nothing to save!");
    else:
        header("location:profile.php?msgOK=Cập nhập thông tin cá nhân thành công!");
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
                        <a href="">Cập nhật thông tin cá nhân</a>
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
                                        <label for="name">Tên:</label>
                                        <input type="text" class="form-control" id="name" name="name" required="required"
                                               placeholder="Tên của bạn" value="<?= $name ?>"
                                               data-validation-required-message="Vui lòng nhập tên của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="email">Email:</label>
                                        <input type="text" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" 
                                               placeholder="Email của bạn" value="<?= $email ?>"
                                               class="form-control" id="email" name="email" required="required"
                                               data-validation-required-message="Vui lòng nhập mail của bạn"
                                               data-validation-pattern-message="Sai định dạng mail"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="phone">Số điện thoại:</label>
                                        <input type="tel" pattern="0[0-9]{9,10}" class="form-control" id="phone" name="phone"
                                               placeholder="Số điện thoại mã vùng Việt Nam(bắt đầu bằng số 0)"
                                               required="required" value="<?= $phone ?>"
                                               data-validation-required-message="Vui lòng nhập số điện thoại của bạn"
                                               data-validation-pattern-message="Số điện thoại chỉ chứa 10 hoặc 11 chữ số" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="row justify-content-center">
                                        <input type="hidden" name="form1" id="ok" />
                                        <button class="btn" name="btnupdate" type="submit" id="Button">Cập nhật</button>
                                    </div>
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
