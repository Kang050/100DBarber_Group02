<?php
include_once './Begin.php';
$emid = $_GET['id'];
$queryemid2 = "SELECT * FROM employees where employee_id='$emid'";
$rsemid2 = mysqli_query($conn, $queryemid2);
$fieldemid2 = mysqli_fetch_array($rsemid2);

if ($fieldemid2[6] > 0):
    $score = round((int) $fieldemid2[7] / (int) $fieldemid2[6], 2);
else:
    $score = 0;
endif;
if (isset($_POST['btndg'])):
    if (!isset($_SESSION["sesAdmin"])):
        header("location:login.php?msgErr=Bạn cần đăng nhập trước khi đánh giá!");
    else:
        $check = $_POST['rating'];
        $newratecount = (int) $fieldemid2[6] + 1;
        $newscore = (int) $fieldemid2[7] + (int) $check;
        $queryra = "update employees set score='$newscore',rate_count='$newratecount' where employee_id='$emid'";
        $rsra = mysqli_query($conn, $queryra);
        header("location:employee.php?id=$emid&msgOK=Cảm ơn bạn đã đánh giá stylist!");
    endif;
endif;
if (isset($_POST['btnbuy'])):
    header("location:booking.php");

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

        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Stylist</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Stylist</a>
                        <a href=""><?= $fieldemid2[1] ?> <?= $fieldemid2[2] ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page Start -->
        <div class="portfolio">
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
                    <h2>Thông tin stylist</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <img style="border:solid 5px #1d2434;height:100%;width:100%" src="img/<?= $fieldemid2[5] ?>" alt="Blog">
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered" >

                            <tbody>
                                <tr>
                                    <th style="padding: 20px 20px 20px 20px"><h2 style="font-weight: bold"><?= $fieldemid2[1] ?> <?= $fieldemid2[2] ?></h2></th>
                                </tr>         
                                <tr>
                                    <td style="padding-left: 20px">
                                        <h4>
                                            <?= $score ?> / 5
                                            <img src="img/star.jpg" style="width:25px;height:25px;margin-top:-7px;margin-left: 5px;margin-right:5px" alt="alt"/> 
                                            | <?= $fieldemid2[6] ?> lượt đánh giá
                                        </h4>
                                    </td>
                                </tr>
                            <form method="post">
                                <tr>
                                    <td style="padding-left: 20px">
                                        <h5 style="font-weight: bold;margin-top: 4px;margin-right: 20px">Đánh giá: </h5>

                                        <div id="rating" style="margin-left:-5px">                                                
                                            <input onchange="checkstar()" type="radio" id="star5" name="rating" value="5" />
                                            <label class = "full" for="star5" title="Awesome - 5 stars"></label>

                                            <input onchange="checkstar()" type="radio" id="star4" name="rating" value="4" />
                                            <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input onchange="checkstar()" type="radio" id="star3" name="rating" value="3" />
                                            <label class = "full" for="star3" title="Meh - 3 stars"></label>

                                            <input onchange="checkstar()" type="radio" id="star2" name="rating" value="2" />
                                            <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input onchange="checkstar()" type="radio" id="star1" name="rating" value="1" />
                                            <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        </div>
                                        <button class="btndg" name="btndg" type="submit" id="Buttondg" disabled>Gửi đánh giá</button>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 20px">
                                        <h5 style="font-weight:bold;margin-top: 10px">
                                            Số điện thoại:   
                                        </h5>
                                        <h5 style="margin-top: 10px"><?= $fieldemid2[3] ?></h5>
                                    </td>
                                </tr> 
                                <tr>
                                    <td style="padding-left: 20px">
                                        <h5 style="font-weight:bold;margin-top: 10px">
                                            Email: 
                                        </h5>
                                        <h5 style="margin-top: 10px"><?= $fieldemid2[4] ?></h5>
                                    </td>
                                </tr> 
                                <tr>
                                    <td style="padding-left: 20px">
                                        <button class="btnp" name="btnbuy" type="submit" id="Button">Đặt lịch</button>
                                    </td>
                                </tr>  
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page End -->
        <style>
            @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
            /*reset css*/
            h1{
                font-size:1.5em;
                margin:10px;
            }
            /****** Style Star Rating Widget *****/
            #rating{
                border:none;
                float:left;
            }
            #rating>input{
                display:none;
            }/*ẩn input radio - vì chúng ta đã có label là GUI*/
            #rating>label:before{
                margin:5px;
                font-size:1.25em;
                font-family:FontAwesome;
                display:inline-block;
                content:"\f005";
            }/*1 ngôi sao*/
            #rating>label{
                color:#ddd;
                float:right;
            }/*float:right để lật ngược các ngôi sao lại đúng theo thứ tự trong thực tế*/
            /*thêm màu cho sao đã chọn và các ngôi sao phía trước*/
            #rating>input:checked~label,
            #rating:not(:checked)>label:hover,
            #rating:not(:checked)>label:hover~label{
                color:#FFD700;
            }
            /* Hover vào các sao phía trước ngôi sao đã chọn*/
            #rating>input:checked+label:hover,
            #rating>input:checked~label:hover,
            #rating>label:hover~input:checked~label,
            #rating>input:checked~label:hover~label{
                color:#FFED85;
            }

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
            .btndg:disabled {
                opacity:0.6;
            }

        </style>
        <script>
            function calcRate(r) {
                const f = ~~r, //Tương tự Math.floor(r)
                        id = 'star' + f;
                id && (document.getElementById(id).checked = !0);
            }
            function minus() {
                var qty = document.getElementById("input-qty");
                if (parseInt(qty.value) > 1) {
                    qty.value = parseInt(qty.value) - 1;
                }
            }
            function plus() {
                var qty = document.getElementById("input-qty");
                if (parseInt(qty.value) < 10) {
                    qty.value = parseInt(qty.value) + 1;
                }
            }
            function checkstar() {
                document.getElementById("Buttondg").disabled = false;
            }
        </script>

        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
