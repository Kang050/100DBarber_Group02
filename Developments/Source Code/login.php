<?php
include_once './Begin.php';

if (isset($_POST["btnSubmit"])) {
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $query = "select client_id from clients where phone_number='$phone' and password='$password'";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0):
        $field = mysqli_fetch_array($rs);
        $user = $field[0];
        $_SESSION["sesAdmin"] = $user;
        header("Location:index.php?msgOK=Đăng nhập thành công!");
    else:
        header("location:login.php?msgErr=Sai số điện thoại hoặc mật khẩu!");

    endif;
}
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
                        <h2>Đăng nhập</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="register" style="margin-bottom: 90px;">
            <div class="container-fluid">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <?php
                            if (isset($_GET['msgErr'])):
                                echo '<div class="alert alert-danger">' . $_GET['msgErr'] . '</div>';
                            endif;
                            ?>
                            <div class="register-form">
                                <div id="success"></div>
                                <form method="post" id="Form" novalidate="novalidate">
                                    <div class="control-group">
                                        <div class="control-group">
                                            <label for="phone">Số điện thoại:</label>
                                            <input type="tel" pattern="0[0-9]{9,10}" class="form-control" id="phone" name="phone"
                                                   placeholder="Số điện thoại mã vùng Việt Nam(bắt đầu bằng số 0)"
                                                   required="required"
                                                   data-validation-required-message="Vui lòng nhập số điện thoại của bạn"
                                                   data-validation-pattern-message="Số điện thoại chỉ chứa 10 hoặc 11 chữ số" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="password">Mật khẩu:</label>
                                            <input type="password" pattern="[a-zA-Z0-9]{8,}" onkeyup="checkPass();"
                                                   class="form-control" id="password" name="password"
                                                   placeholder="8 ký tự trở lên bao gồm chữ thường, chữ hoa và chữ số"
                                                   required="required"
                                                   data-validation-required-message="Vui lòng nhập mật khẩu của bạn"
                                                   data-validation-pattern-message="Sai định dạng" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div>
                                            <button class="btn" type="submit" id="login" name="btnSubmit">Đăng nhập</button>
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
