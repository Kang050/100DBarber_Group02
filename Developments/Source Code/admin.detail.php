<?php
include './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
$orderid = $_GET['id'];
$queryorder = "select * from orders where order_id='$orderid'";
$rsorder = mysqli_query($conn, $queryorder);
$fieldorder = mysqli_fetch_array($rsorder);

$queryorderitem = "select * from order_item where order_id='$orderid'";
$rsorderitem = mysqli_query($conn, $queryorderitem);
$countorderitem = mysqli_num_rows($rsorderitem);
$querycli2 = "SELECT * FROM clients where client_id='$fieldorder[1]'";
$rscli2 = mysqli_query($conn, $querycli2);
$fieldcli2 = mysqli_fetch_array($rscli2);
if (isset($_POST['btnupdate'])):
    $status = $_POST['status'];
    $query1 = "update orders set status='$status' where order_id='$orderid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.detail.php?id=$orderid&msgErr=Nothing to save!");
    else:
        header("location:admin.order.php?msgOK=Cập nhập đơn hàng thành công!");
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

        <?php include './Main_1.php'; ?>
        <!-- Single Page Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Đơn đặt hàng</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Đơn đặt hàng</a>
                        <a href="">Cập nhật đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Single Page Start -->
        <div class="single">
            <div class="container">
                <div class="section-header text-center">
                    <h2>Thông tin đơn hàng</h2>
                </div>
                <form  method="post" id="Form" novalidate="novalidate"  >
                    <div class="row justify-content-center">

                        <div class="col-5">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th >Tên khách hàng</th>
                                        <td ><?= $fieldcli2[2] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ giao hàng:</th>
                                        <td><?= $fieldorder[2] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phương thức thanh toán:</th>
                                        <td><?= $fieldorder[6] ?></td>
                                    </tr>   
                                </tbody>  
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th >Ngày đặt:</th>
                                        <td ><?= $fieldorder[7] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phương thức giao hàng:</th>
                                        <td><?= $fieldorder[3] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td style="width:50%">
                                            <div class="control-group">
                                                <input autofocus style='border: 2px solid #1d2434' type="text" class="form-control" id="address" name="status" value="<?= $fieldorder[5] ?>"
                                                       required="required"
                                                       data-validation-required-message="Vui lòng nhập trạng thái đơn hàng" />
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </td>
                                    </tr>   
                                </tbody>  
                            </table>
                        </div>
                        <div class="col-12 ">
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
                                    while ($fieldorderitem = mysqli_fetch_array($rsorderitem)) :
                                        $queryproduct2 = "SELECT * FROM products where product_id='$fieldorderitem[2]'";
                                        $rsproduct2 = mysqli_query($conn, $queryproduct2);
                                        $fieldproduct2 = mysqli_fetch_array($rsproduct2);
                                        $total = (int) $fieldorderitem[3] * (int) $fieldproduct2[5];
                                        ?>
                                        <tr>
                                            <td><?= $fieldproduct2[2] ?></td>
                                            <td style="text-align:right" id="price<?= $fieldproduct2[0] ?>"><?= $fieldproduct2[5] ?> VNĐ</td>
                                            <td style="text-align:center"><?= $fieldorderitem[3] ?></td>
                                            <td style="text-align:right;font-weight: bold" id="total<?= $fieldproduct2[0] ?>"><?= $total ?>.000 VNĐ</td>
                                        </tr>
                                        <?php
                                    endwhile;
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
                                                <p id="totalall" "><?= $fieldorder[4] ?> VNĐ</p>

                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btnp" name='btnupdate' type="submit"  >Cập nhật</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

        <!-- Single Page End -->
        <style>
            .btnp {
                padding: 15px 30px;
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
            .btndg:disabled {
                opacity:0.6;
            }
            th{
                text-align: center;
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
            function quay_lai_trang_truoc() {
                history.back();
            }
        </script>
        <!-- Footer Start -->
        <?php include './Foot_1.php'; ?>
    </body>
</html>
