<?php
include_once './Begin.php';
$choice = $_GET['choice'];
$back = $_GET['back'];
if ($choice == '1'):
    $title = 'Thêm';
    $bank = '';
    $banknum = '';
    $bankex='';
else:
    $title = "Cập nhập";
    $bankid = $_GET['id'];
    $queryidbank = "select * from client_credit_card_info where id='$bankid'";
    $rsidbank = mysqli_query($conn, $queryidbank);
    $fieldidbank = mysqli_fetch_array($rsidbank);
    $bank = $fieldidbank[2];
    $banknum = $fieldidbank[3];
    $bankex=$fieldidbank[4];
endif;
if (isset($_POST['btnadd'])):
    $bank = $_POST['bank'];
    $banknum = $_POST['banknum'];
    $bankex = $_POST['bankex'];
    $query1 = "INSERT into client_credit_card_info(client_id,provider,card_number,expiry_date) values('$fielduser[0]','$bank','$banknum','$bankex')";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:address.php?msgErr=Nothing to save!");
    else:
        header("location:$back?msgOK=Thêm phương thức thanh toán thành công!");
    endif;
endif;
if (isset($_POST['btnupdate'])):
    $bank = $_POST['bank'];
    $banknum = $_POST['banknum'];
    $bankex = $_POST['bankex'];
    $query1 = "update client_credit_card_info set provider='$bank',card_number='$banknum',expiry_date='$bankex' where id='$bankid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:address.php?msgErr=Nothing to save!");
    else:
        header("location:$back?msgOK=Cập nhập phương thức thanh toán thành công!");
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
                        <a href=""><?= $title ?> phương thức thanh toán</a>
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
                                    <div class='control-group'>
                                        <label for='province'>Ngân hàng:</label>
                                        <input style='border: 2px solid #1d2434' type='text' class='form-control' value="<?=$bank?>"
                                               id='province' name='bank' required='required' placeholder='Ngân hàng phát hành thẻ' data-validation-required-message='Vui lòng nhập ngân hàng của bạn'/>
                                        <p class='help-block text-danger'></p>
                                    </div>
                                    <div class='control-group'>
                                        <label for='address'>Số thẻ:</label>
                                        <input style='border: 2px solid #1d2434' type='text' class='form-control' value="<?=$banknum?>"
                                               id='address' name='banknum' required='required' placeholder='Số thẻ cúa bạn' data-validation-required-message='Vui lòng nhập số thẻ của bạn' />
                                        <p class='help-block text-danger'></p>
                                    </div>
                                    <div class='control-group'>
                                        <label for='address'>Thời hạn:</label>
                                        <input style='border: 2px solid #1d2434' type='text' class='form-control' id='address' value="<?=$bankex?>"
                                               name='bankex' required='required' placeholder='Thời hạn hết hạn thẻ cúa bạn' data-validation-required-message='Vui lòng nhập ngày hết hạn thẻ của bạn' />
                                        <p class='help-block text-danger'></p>
                                    </div>
                                    <?php
                                    if ($choice == '1'):
                                        ?>
                                        <button class="btn" name="btnadd" type="submit" id="Button">Thêm</button>
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
