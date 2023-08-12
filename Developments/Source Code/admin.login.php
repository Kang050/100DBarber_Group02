<?php
include_once './Begin_1.php';

if (isset($_POST["btnSubmit"])) {
    $username = $_POST["name"];
    $password = $_POST["password"];
    $query = "select admin_id  from barber_admin where username='$username' and password='$password'";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0):
        $field = mysqli_fetch_array($rs);
        $user = $field[0];
        $_SESSION["Admin"] = $user;
        header("Location:admin.index.php?msgOK=Đăng nhập thành công!");
    else:
        header("location:admin.login.php?msgErr=Sai tên đăng nhập hoặc mật khẩu!");

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

        <?php include './Main_1.php'; ?>

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
                                            <label for="address">Tên đăng nhập:</label>
                                            <input type="text" class="form-control" id="address" name="name" 
                                                   required="required"
                                                   placeholder="Tên đăng nhập của bạn"
                                                   data-validation-required-message="Vui lòng nhập họ tên nhân viên" />
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
                                        <div class="row justify-content-center">
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
        <?php include './Foot_1.php'; ?>
    </body>
</html>
