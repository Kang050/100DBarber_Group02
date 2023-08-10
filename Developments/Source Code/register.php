<?php
include_once './Begin.php';
if (isset($_POST['btnSubmit'])):
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $query = "INSERT into clients(client_email,name,phone_number,password) values('$email','$name','$phone','$password')";
    $rs = mysqli_query($conn, $query);
    if ($rs):
        $query2 = "SELECT client_id FROM clients ORDER BY client_id DESC LIMIT 1";
        $rs2 = mysqli_query($conn, $query2);
        $fields = mysqli_fetch_array($rs2);
        $id = $fields[0];
        $queryaddcart = "INSERT into shopping_cart(client_id) values('$id')";
        $rsaddcart = mysqli_query($conn, $queryaddcart);
        $province = $_POST['province'];
        $address = $_POST['address'];
        $query1 = "INSERT into addresses(client_id,province,address) values('$id','$province','$address')";
        $rs1 = mysqli_query($conn, $query1);
        if (!$rs1):
            header("location:register.php?msgErr=Nothing to save!");
        else:
            $_SESSION["sesAdmin"] = $id;
            header("location:index.php?msgOK=Đăng ký thành công!");
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
                        <a href="">Đăng ký</a>
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
                                               placeholder="Tên của bạn"
                                               data-validation-required-message="Vui lòng nhập tên của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="email">Email:</label>
                                        <input type="text" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" 
                                               placeholder="Email của bạn"
                                               class="form-control" id="email" name="email" required="required"
                                               data-validation-required-message="Vui lòng nhập mail của bạn"
                                               data-validation-pattern-message="Sai định dạng mail"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
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
                                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" name="password"
                                               class="form-control" id="password"
                                               placeholder="Mật khẩu của bạn"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập mật khẩu của bạn"
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
                                    <div class="control-group">
                                        <label for="province">Tỉnh:</label>
                                        <input type="text" class="form-control" id="province" name="province"
                                               required="required"
                                               placeholder="Tỉnh của bạn"
                                               data-validation-required-message="Vui lòng nhập tỉnh của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               required="required"
                                               placeholder="Địa chỉ của bạn"
                                               data-validation-required-message="Vui lòng nhập địa chỉ của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="row justify-content-center">
                                        <input type="hidden" name="form1" id="ok" />
                                        <button class="btn" name="btnSubmit" type="submit" id="Button">Đăng ký</button>
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
