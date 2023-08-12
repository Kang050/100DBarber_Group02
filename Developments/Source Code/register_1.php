<?php
include_once './Begin.php';
if (isset($_POST['btnSubmit'])):
    
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
                                <form method="post" novalidate="novalidate">
                            <div class='control-group'>"
                            + "<label for='province'>Ngân hàng:</label>"
                            + "<input style='border: 2px solid #1d2434;margin-bottom:20px' type='text' class='form-control' \n\
     id='province' name='bank' required='required' placeholder='Ngân hàng phát hành thẻ' data-validation-required-message='Vui lòng nhập ngân hàng của bạn'/>"
                            + "<p class='help-block text-danger'></p></div>"
                            + "<div class='control-group'>"
                            + "<label for='address'>Số thẻ:</label>"
                            + "<input style='border: 2px solid #1d2434;margin-bottom:20px' type='text' class='form-control' id='address' name='banknum' required='required' placeholder='Số thẻ cúa bạn' data-validation-required-message='Vui lòng nhập số thẻ của bạn' />"
                            + "<p class='help-block text-danger'></p></div>"
                            + "<div class='control-group'>"
                            + "<label for='address'>Ngày hết hạn:</label>"
                            + "<input style='border: 2px solid #1d2434;margin-bottom:20px' type='text' class='form-control' id='address' name='bankdate' required='required' placeholder='Ngày hết hạn thẻ cúa bạn' data-validation-required-message='Vui lòng nhập ngày hết hạn thẻ của bạn' />"
                            + "<p class='help-block text-danger'></p></div>";
                                
                                
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
