<?php
include './Begin.php';

if (isset($_GET['id'])):
    $deleteid = $_GET['id'];
    $querydeleteid = "delete from shopping_cart_item where product_id='$deleteid'";
    $rsdeleteid = mysqli_query($conn, $querydeleteid);
    header("location:cart.php?msgOK=Đã xoá sản phẩm ra khỏi giỏ hàng!");
endif;
$querycartitem = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
$rscartitem = mysqli_query($conn, $querycartitem);
$countcartitem = mysqli_num_rows($rscartitem);

if (isset($_POST['btnback'])):
    $querycartitem1 = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
    $rscartitem1 = mysqli_query($conn, $querycartitem1);
    while ($fieldcartitem1 = mysqli_fetch_array($rscartitem1)) :
        $s = 'newqty' . $fieldcartitem1[2];
        if (isset($_COOKIE[$s])):
            $newqtypro = $_COOKIE[$s];
            setcookie($s, "", time() - 3600);
            $queryupdateqty = "update shopping_cart_item set qty='$newqtypro' where id='$fieldcartitem1[0]'";
            $rsupdateqty = mysqli_query($conn, $queryupdateqty);
        endif;
    endwhile;
    header("location:shop.php?msgOK=Đã lưu thông tin giỏ hàng!");
endif;
if (isset($_POST['btnorder'])):
    $querycartitem1 = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
    $rscartitem1 = mysqli_query($conn, $querycartitem1);
    while ($fieldcartitem1 = mysqli_fetch_array($rscartitem1)) :
        $s = 'newqty' . $fieldcartitem1[2];
        if (isset($_COOKIE[$s])):
            $newqtypro = $_COOKIE[$s];
            setcookie($s, "", time() - 3600);
            $queryupdateqty = "update shopping_cart_item set qty='$newqtypro' where id='$fieldcartitem1[0]'";
            $rsupdateqty = mysqli_query($conn, $queryupdateqty);
        endif;
    endwhile;
    header("location:order.php?msgOK=Đã lưu thông tin giỏ hàng!");
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
                    <h2>Danh sách sản phẩm đã chọn</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php
                        if ($countcartitem > 0):
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="width:50%">Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Tạm tính</th>
                                    </tr>
                                </thead>
                                <form method="post" novalidate="">
                                    <tbody>
                                        <?php
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
                                                <td class="">
                                                    <div class="row justify-content-center"
                                                         <div  class="buttons_added">
                                                            <input class="minus is-form" type="button" name="min" value="-" onclick="minus('<?= $fieldproduct2[0] ?>', '<?= $fieldcartitem[1] ?>')">
                                                            <input aria-label="quantity" class="input-qty" id="input-qty<?= $fieldproduct2[0]
                                            ?>"  max="10" min="1" name="qty" type="number" value="<?= $fieldcartitem[3] ?>">
                                                            <input class="plus is-form" type="button" name="plu" value="+" onclick="plus('<?= $fieldproduct2[0] ?>', '<?= $fieldcartitem[1] ?>')">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align:right;font-weight: bold" id="total<?= $fieldproduct2[0] ?>"><?= $total ?>.000 VNĐ</td>
                                                <td><a style="font-style: italic" href="cart.php?id=<?= $fieldproduct2[0] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá sản phẩm này ra khỏi giỏ hàng?')">Xoá</a></td>
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
                                                    <p id="totalall"><?= $totalall ?>.000 VNĐ</p>
                                                </div>

                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan=4>
                                                <div class="row justify-content-end" >
                                                    <button class="btnp" name="btnback" type="submit" id="Button">Mua thêm</button>
                                                    <button  class="btnp" name="btnorder" type="submit" id="Button">Đặt hàng</button>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </form>
                            </table>
                            <?php
                        else:
                            ?>
                        <h5 style="text-align: center;color:gray">Chưa có sản phẩm nào</h5>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- Single Page End -->
        <style>

            .buttons_added {
                opacity:1;
                display:inline-block;
                display:-ms-inline-flexbox;
                display:inline-flex;
                white-space:nowrap;
                vertical-align:top;
            }
            .is-form {
                overflow:hidden;
                position:relative;
                background-color:#f9f9f9;
                height:2.2rem;
                width:1.9rem;
                padding:0;
                text-shadow:1px 1px 1px #fff;
                border:1px solid #ddd;
            }
            .is-form:focus,.input-text:focus {
                outline:none;
            }
            .is-form.minus {
                border-radius:4px 0 0 4px;
            }
            .is-form.plus {
                border-radius:0 4px 4px 0;
            }
            .input-qty {
                background-color:#fff;
                height:2.2rem;
                text-align:center;
                font-size:1rem;
                display:inline-block;
                vertical-align:top;
                margin:0;
                border-top:1px solid #ddd;
                border-bottom:1px solid #ddd;
                border-left:0;
                border-right:0;
                padding:0;
            }
            .input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
                -webkit-appearance:none;
                margin:0;
            }
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

        </style>
        <script>
            function minus(r, i) {
                var t = 'total' + r;
                var k = 'input-qty' + r;
                var h = 'price' + r;
                var qty = document.getElementById(k);
                if (parseInt(qty.value) > 1) {
                    qty.value = parseInt(qty.value) - 1;
                    document.getElementById(t).innerHTML = parseInt(qty.value) * parseInt(document.getElementById(h).innerHTML) + '.000 VNĐ';
                    document.getElementById('totalall').innerHTML = parseInt(document.getElementById('totalall').innerHTML) - parseInt(document.getElementById(h).innerHTML) + '.000 VNĐ';
                    document.cookie = "newqty" + r + "=" + qty.value;
                }
            }
            function plus(r, i) {
                var t = 'total' + r;
                var k = 'input-qty' + r;
                var h = 'price' + r;
                var qty = document.getElementById(k);
                qty.value = parseInt(qty.value) + 1;
                document.getElementById(t).innerHTML = parseInt(qty.value) * parseInt(document.getElementById(h).innerHTML) + '.000 VNĐ';
                document.getElementById('totalall').innerHTML = parseInt(document.getElementById('totalall').innerHTML) + parseInt(document.getElementById(h).innerHTML) + '.000 VNĐ';
                document.cookie = "newqty" + r + "=" + qty.value;
            }
        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
