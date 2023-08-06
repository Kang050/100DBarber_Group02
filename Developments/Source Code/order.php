<?php
include './Begin.php';

$querycartitem = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
$rscartitem = mysqli_query($conn, $querycartitem);
$countcartitem = mysqli_num_rows($rscartitem);
if (isset($_POST['btnback'])):
    header("location:shop.php");
endif;
if (isset($_POST['btnorder'])):
    header("location:order.php");
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
                        <h2>Giỏ hàng</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Giỏ hàng</a>
                        <a href="">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Single Page Start -->
        <div class="single">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Hoàn tất thông tin đặt hàng của bạn</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <form method="post">
                                <tbody>
                                    <tr>
                                        <th >Tên khách hàng</th>
                                        <td ><?= $user ?></td>
                                    </tr>
                                    <tr>
                                        <th rowspan=2>Địa chỉ giao hàng:</th>
                                        <td>
                                            <div>                                                
                                                <input onchange="checkaddress(1)" type="radio" name="addresschoice" >Địa chỉ đã đăng ký</input>
                                                <input onchange="checkaddress(2)" type="radio" name="addresschoice"  >Thêm địa chỉ mới</input>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width:60%' >
                                            <div id="addressseleted">
                                                <div class='control-group'>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th rowspan=2>Phương thức thanh toán:</th>
                                        <td>
                                            <div>                                                
                                                <input onchange="checkpay(1)" type="radio" name="paymethod" value="1" >Thanh toán tại nhà</input>
                                                <input onchange="checkpay(2)" type="radio" name="paymethod" value="2" >Thanh toán trực tuyến</input>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="payment">
                                        
                                    </tr>
                                </tbody>                           
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr style="text-align: center">
                                    <th style="width:50%">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                </tr>
                            </thead>
                            <form method="post">
                                <tbody>
                                    <?php
                                    if ($countcartitem > 0):
                                        $totalall = 0;
                                        while ($fieldcartitem = mysqli_fetch_array($rscartitem)) :
                                            $queryproduct2 = "SELECT * FROM products where product_id='$fieldcartitem[2]'";
                                            $rsproduct2 = mysqli_query($conn, $queryproduct2);
                                            $fieldproduct2 = mysqli_fetch_array($rsproduct2);
                                            $total = (int) $fieldcartitem[3] * (int) $fieldproduct2[5];
                                            $totalall += $total;
                                            ?>
                                            <tr>
                                                <td><?= $fieldproduct2[2] ?></td>
                                                <td style="text-align:right" id="price<?= $fieldproduct2[0] ?>"><?= $fieldproduct2[5] ?> VNĐ</td>
                                                <td style="text-align:center"><?= $fieldcartitem[3] ?></td>
                                                <td style="text-align:right;font-weight: bold" id="total<?= $fieldproduct2[0] ?>"><?= $total ?>.000 VNĐ</td>
                                            </tr>
                                            <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <div class="row justify-content-center" style="font-weight:bold">
                                                Tổng tiền:
                                            </div>
                                        </td>
                                        <td colspan=3  >
                                            <div  style="text-align:right;font-weight:bold;color:red" >
                                                <p id="totalall"><?= $totalall ?>.000 VNĐ</p>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=4>
                                            <div class="row justify-content-end" >
                                                <button class="btnp" name="btnback" type="submit" id="Button">Trở lại giỏ hàng</button>
                                                <button  class="btnp" name="btnorder" type="submit" id="Button">Đặt hàng</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Single Page End -->
        <style>
            .btnp {
                padding: 15px 30px;
                margin: 10px 20px 10px 0px;
                font-size: 16px;
                font-weight: 600;
                letter-spacing: 1px;
                color: #1d2434;
                background: none;
                border: 2px solid #1d2434;
                border-radius: 0;
                transition: .3s;
            }

            .btnp:hover {
                color: #D5B981;
                background: #1d2434;
            }
            .btndg {
                padding: 7px 20px;
                margin-top:2px;
                margin-left:12px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 1px;
                color: #1d2434;
                background: none;
                border: 2px solid #1d2434;
                border-radius: 0;
                transition: .3s;
            }

            .btndg:hover {
                color: #D5B981;
                background: #1d2434;
            }
            th{
                text-align: center;
            }
        </style>
        <script>
            function checkaddress(r) {

                if (r === 2) {
                    var data = "<div class='control-group'>"
                            + "<label for='province'>Tỉnh:</label>"
                            + "<input style='border: 2px solid #1d2434;margin-bottom:20px type='text' class='form-control' \n\
     id='province' name='province' required='required' placeholder='Tỉnh của bạn'\n\
 data-validation-required-message='Vui lòng nhập tỉnh của bạn' />"
                            + "<p class='help-block text-danger'></p></div>"
                            + "<div class='control-group'>"
                            + "<label for='address'>Địa chỉ:</label>"
                            + "<input style='border: 2px solid #1d2434;margin-bottom:20px type='text' class='form-control' id='address' name='address' required='required' placeholder='Địa chỉ của bạn' data-validation-required-message='Vui lòng nhập địa chỉ của bạn' />"
                            + "<p class='help-block text-danger'></p></div>";
                    document.getElementById('addressseleted').innerHTML = data;
                } else if (r === 1) {
                    var data = "<div class='control-group'>"
                            + "<label for='province'>Chọn địa chỉ:</label>"
                            + "<select id='address' name='address' class='form-control' style='border: 2px solid #1d2434;margin-bottom:20px'>"
                            + "<?php while ($fieldaddid2 = mysqli_fetch_array($rsaddid)) : ?>"
                                + "<option value='<?= $fieldaddid2[0] ?>'><?= $fieldaddid2[3] ?>, <?= $fieldaddid2[2] ?></option>"
                                + "<?php endwhile; ?> </select></div>";
                    document.getElementById('addressseleted').innerHTML = data;
                }
            }

        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
