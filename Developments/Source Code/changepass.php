<?php
include_once './Begin.php';

if (isset($_POST['btnupdate'])):
    $passold = $_POST['passwordold'];
    if ($passold != $fielduser[4]):
        header("location:changepass.php?msgErr=Mật khẩu hiện tại của bạn không đúng!");
    else:
        $pass = $_POST['password'];
        $query1 = "update clients set password='$pass' where client_id='$fielduser[0]'";
        $rs1 = mysqli_query($conn, $query1);
        if (!$rs1):
            header("location:changinfo.php?msgErr=Nothing to save!");
        else:
            header("location:profile.php?msgOK=Cập nhập mật khẩu mới thành công!");
        endif;
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
                        <a href="">Cập nhật mật khẩu</a>
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
                            if (isset($_GET['msgOK'])):
                                echo '<div class="alert alert-success">' . $_GET['msgOK'] . '</div>';
                            endif;
                            if (isset($_GET['msgErr'])):
                                echo '<div class="alert alert-danger">' . $_GET['msgErr'] . '</div>';
                            endif;
                            ?>
                            <div class="register-form">
                                <div id="success"></div>
                                <form  method="post" id="Form" novalidate="novalidate">
                                    <div class="control-group">
                                        <label for="password">Mật khẩu hiện tại:</label>
                                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  name="passwordold"
                                               class="form-control" 
                                               placeholder="Mật khẩu hiện tại của bạn"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập mật khẩu hiện tại của bạn"
                                               data-validation-pattern-message="Phải chứa ít nhất một số và một chữ hoa và một chữ thường và ít nhất 8 ký tự trở lên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="password">Mật khẩu mới:</label>
                                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" name="password"
                                               class="form-control" id="password"
                                               placeholder="Mật khẩu mới bạn muốn đổi"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập mật khẩu mới bạn muốn đổi"
                                               data-validation-pattern-message="Phải chứa ít nhất một số và một chữ hoa và một chữ thường và ít nhất 8 ký tự trở lên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="password">Xác nhận mật khẩu:</label>
                                        <input type="password" class="form-control" onkeyup="checkPass();" id="confirm" 
                                               placeholder="Nhập lại mật khẩu của bạn" required="required"
                                               data-validation-required-message="Vui lòng nhập lại đúng mật khẩu của bạn" />
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
    <script>
        function checkPass() {
            var pass = document.getElementById("password").value;
            var rpass = document.getElementById("confirm").value;
            if (pass != rpass) {
                document.getElementById("Button").disabled = true;

            } else {
                document.getElementById("Button").disabled = false;
            }
        }
    </script>
    <!-- Footer Start -->
    <?php include './Foot.php'; ?>
</body>
</html>
