<?php
include './Begin.php';

$querycartitem = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
$rscartitem = mysqli_query($conn, $querycartitem);
$countcartitem = mysqli_num_rows($rscartitem);
if ($countaddid == 0):
    $title = 'Chưa có';
else:
    $title = 'Chọn';
endif;
if ($countcard == 0):
    $title2 = 'Chưa có';
else:
    $title2 = 'Chọn';
endif;
if (isset($_POST['btnback'])):
    header("location:cart.php");
endif;
if (isset($_POST['btnaddadd'])):
    header("location:address.php?choice=1&back=order.php");
endif;
if (isset($_POST['btnaddcard'])):
    header("location:payment.php?choice=1&back=order.php");
endif;
if (isset($_POST['btnorder'])):
    $shipaddress = $_POST['address1'];
    if ($_POST['paymethod'] == '2'):
        $paymethod = 'COD';
    else:
        $paymethod = $_POST['card'];
    endif;
    $totall = $_POST['total'];
    $datetime1 = date('Y-m-d H:i:s');
    $queryaddorder = "insert into orders(client_id,shipping_address,total,payment_method,date_created) values('$fielduser[0]','$shipaddress','$totall','$paymethod','$datetime1')";
    $rsaddorder = mysqli_query($conn, $queryaddorder);
    $query2 = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
    $rs2 = mysqli_query($conn, $query2);
    $fields = mysqli_fetch_array($rs2);
    $orderid = $fields[0];
    $querycartitem1 = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
    $rscartitem1 = mysqli_query($conn, $querycartitem1);
    while ($fieldcartitem1 = mysqli_fetch_array($rscartitem1)) :
        $queryupdateqty = "insert into order_item(order_id,product_id,qty) values('$orderid','$fieldcartitem1[2]','$fieldcartitem1[3]')";
        $rsupdateqty = mysqli_query($conn, $queryupdateqty);
    endwhile;
    $querydelete = "delete from shopping_cart_item where cart_id='$fieldcart[0]'";
    $rsdelete = mysqli_query($conn, $querydelete);
    header("location:orderlist.php?msgOK=Đặt hàng thành công!");
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
                    <?php
                    if (isset($_GET['msgOK'])):
                        echo '<div class="alert alert-success">' . $_GET['msgOK'] . '</div>';
                    endif;
                    if (isset($_GET['msgErr'])):
                        echo '<div class="alert alert-danger">' . $_GET['msgErr'] . '</div>';
                    endif;
                    ?>
                    <h2>Hoàn tất thông tin đặt hàng của bạn</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <form method="post" novalidate="novalidate">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th >Tên khách hàng</th>
                                        <td ><?= $user ?></td>
                                    </tr>
                                    <tr>
                                        <th rowspan=2>Địa chỉ giao hàng:</th>
                                        <td>
                                            <div class='control-group'>
                                                <select id='address' name='address1' onchange="check1()" class='form-control' style='border: 2px solid #1d2434;margin-top:10px;margin-bottom:10px'>
                                                    <option value="no" selected disabled><?= $title ?> địa chỉ</option>
                                                    <?php
                                                    while ($fieldaddid2 = mysqli_fetch_array($rsaddid)) :
                                                        ?>
                                                        <option value='<?= $fieldaddid2[3] ?>, <?= $fieldaddid2[2] ?>'><?= $fieldaddid2[3] ?>, <?= $fieldaddid2[2] ?></option>
                                                        <?php
                                                    endwhile;
                                                    ?> 
                                                </select>
                                            </div>
                                            <button class="btndg" name="btnaddadd" type="submit" id="Buttondg" >Thêm địa chỉ</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='width:60%' >

                                        </td>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Phương thức thanh toán:</th>
                                        <td>
                                            <input onchange="checkpay(2)" type="radio" id="paymethod" name="paymethod" checked style="margin-right:10px" value="2">Thanh toán tại nhà</input>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>                                                
                                                <input onchange="checkpay(1)" type="radio" id="paymethod" name="paymethod" style="margin-right:10px" value="1">Thanh toán trực tuyến
                                                <div class='control-group'>
                                                    <select disabled id='card' name='card' onchange="check2()" class='form-control' style='border: 2px solid #1d2434;margin-top:10px;margin-bottom:10px'>
                                                        <option value="no" selected disabled><?= $title2 ?> phương thức thanh toán</option>
                                                        <?php
                                                        while ($fieldcard = mysqli_fetch_array($rscard)) :
                                                            ?>
                                                            <option value='<?= $fieldcard[2] ?>, <?= $fieldcard[3] ?>'><?= $fieldcard[2] ?>, <?= $fieldcard[3] ?></option>
                                                            <?php
                                                        endwhile;
                                                        ?> 
                                                    </select>
                                                </div>
                                                <button class="btndg" name="btnaddcard" type="submit" id="btnaddcard" disabled >Thêm thẻ ngân hàng</button>
                                                </input>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>  
                                <tfoot id="payment">

                                    </foot>
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
                                                <p id="totalall" "><?= $totalall ?>.000 VNĐ</p>
                                                <input type="hidden" name="total" value="<?= $totalall ?>"></input>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan=4>
                                            <div class="row justify-content-end" >
                                                <button class="btnp" name="btnback" type="submit" id="Button">Trở lại giỏ hàng</button>
                                                <button  class="btnp" name="btnorder" type="submit" id="Button1" disabled>Đặt hàng</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
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
            .btnp:disabled,
            .btndg:disabled {
                opacity:0.6;
            }
            th{
                text-align: center;
            }
            #Button1:disabled {
                color: #D5B981;
                background: #1d2434;
                opacity:0.5;
            }
        </style>
        <script>
            function checkpay(r) {
                if (r === 1) {
                    document.getElementById('btnaddcard').disabled = false;
                    document.getElementById('card').disabled = false;

                } else {
                    document.getElementById('btnaddcard').disabled = true;
                    document.getElementById('card').disabled = true;
                }
            }
            function check1() {
                var card = document.getElementById("card").value;
                var paymethod = document.getElementById('paymethod').value;
                if ((paymethod === "2") || !(card === "no")) {
                    document.getElementById("Button1").disabled = false;
                }
            }
            function check2() {
                var card = document.getElementById("card").value;
                var address = document.getElementById("address").value;
                if (!(address === "no")) {
                    document.getElementById("Button1").disabled = false;
                }
            }
        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
