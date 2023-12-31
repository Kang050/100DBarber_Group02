<?php
include_once './Begin.php';
if (isset($_POST['btnSubmit'])):
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $mes = '';
    $password = $_POST['password'];
    $querycheck = "select * from clients where phone_number='$phone'";
    $rscheck = mysqli_query($conn, $querycheck);
    $countcheck = mysqli_num_rows($rscheck);
    $querycheck2 = "select * from clients where client_email='$email'";
    $rscheck2 = mysqli_query($conn, $querycheck2);
    $countcheck2 = mysqli_num_rows($rscheck2);
    if ($countcheck > 0):
        $mes = $mes . 'Số điện thoại đã được đăng ký! ';
    endif;
    if ($countcheck2 > 0):
        $mes = $mes . 'Email đã được đăng ký! ';
    endif;
    if ($mes == ''):

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
    else:
        header("location:register.php?msgErr=$mes");
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
                                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="checkPass();" name="password"
                                               class="form-control" id="password"
                                               placeholder="Mật khẩu của bạn"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập mật khẩu của bạn"
                                               data-validation-pattern-message="Phải chứa ít nhất một số và một chữ hoa và một chữ thường và ít nhất 8 ký tự trở lên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="password">Xác nhận mật khẩu:</label>
                                        <input type="password" class="form-control" onchange="checkPass();" id="confirm"
                                               placeholder="Nhập lại mật khẩu của bạn" required="required"
                                               data-validation-required-message="Vui lòng nhập lại đúng mật khẩu của bạn" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">                                
                                        <label for="province">Chọn tỉnh/tp:</label>
                                        <select class="form-control" onchange="checkPass();" id="province" name="province" >
                                            <option value="no">chọn tỉnh/thành phố</option>
                                            <?php
                                            while ($fieldcity = mysqli_fetch_array($rscity)) :
                                                ?>
                                                <option value="<?= $fieldcity[1] ?>"><?= $fieldcity[1] ?></option>
                                                <?php
                                            endwhile;
                                            ?> 
                                        </select>
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
                                        <button disabled class="btn" name="btnSubmit" type="submit" id="Button">Đăng ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page End -->
        <style>
            #Button:disabled {
                color: #D5B981;
                background: #1d2434;
                opacity:0.5;
            }
        </style>
        <script>
            function checkPass() {
                var pass = document.getElementById("password").value;
                var rpass = document.getElementById("confirm").value;
                var province = document.getElementById("province").value;
                if ((pass = rpass) && (province != "no")) {
                    document.getElementById("Button").disabled = false;
                } else {
                    document.getElementById("Button").disabled = true;
                }
            }
        </script>
        <script>


        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
