<?php

session_start();
include_once './DBConnect.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$newdate = strtotime('+5 day', strtotime($date));
$newdate = date('Y-m-d', $newdate);

$id = (string) $_SESSION["sesAdmin"];
$queryuser = "select * from clients where client_id='$id'";
$rsuser = mysqli_query($conn, $queryuser);
$fielduser = mysqli_fetch_array($rsuser);
$user = $fielduser[2];

$queryappoint = "select * from appointments";
$rsappoint = mysqli_query($conn, $queryappoint);
$countappoint = mysqli_num_rows($rsappoint);

$queryservice = "SELECT * FROM services";
$rsservice = mysqli_query($conn, $queryservice);

$querycountcart = "SELECT COUNT(id) AS NumberOfProducts FROM shopping_cart_item";
$rscountcart = mysqli_query($conn, $querycountcart);
$fieldcountcart = mysqli_fetch_array($rscountcart);

$querycart = "select * from shopping_cart where client_id='$id'";
$rscart = mysqli_query($conn, $querycart);
$fieldcart = mysqli_fetch_array($rscart);

$querycartitem2 = "select * from shopping_cart_item where cart_id='$fieldcart[0]'";
$rscartitem2 = mysqli_query($conn, $querycartitem2);
$countcartitem2 = mysqli_num_rows($rscartitem2);

$queryemployees = "SELECT * FROM employees";
$rsemployees = mysqli_query($conn, $queryemployees);

$querycate = "SELECT * FROM product_categories";
$rscate = mysqli_query($conn, $querycate);

$queryproduct = "SELECT * FROM products";
$rsproduct = mysqli_query($conn, $queryproduct);

$queryaddid = "select * from addresses where client_id='$id'";
$rsaddid = mysqli_query($conn, $queryaddid);
$countaddid = mysqli_num_rows($rsaddid);

while ($fieldappoint = mysqli_fetch_array($rsappoint)) :
    $datelate = strtotime('+15 minutes', strtotime($fieldappoint[4]));
    if (strtotime($datetime) > $datelate && $fieldappoint[6] == 0):
        $queryla = "update appointments set status='2',cancellation_reason='Quá giờ hẹn' where appointment_id='$fieldappoint[0]'";
        $rsla = mysqli_query($conn, $queryla);
    endif;
endwhile;

$queryes = "SELECT * from employee_shift where date='$newdate'";
$rses = mysqli_query($conn, $queryes);
if (!(mysqli_num_rows($rses) > 0)):
    $i = 1;
    while ($i <= 3) {
        for ($j = 9; $j <= 18; $j++) {
            $k = (string) $j . ':00:00';
            $queryes2 = "INSERT into employee_shift(employee_id,time,date) values('$i','$k','$newdate')";
            $rses2 = mysqli_query($conn, $queryes2);
        }
        $i = $i + 2;
    }
    $i = 2;
    while ($i <= 4) {
        for ($j = 9; $j <= 18; $j++) {
            $k = (string) $j . ':30:00';
            $queryes2 = "INSERT into employee_shift(employee_id,time,date) values('$i','$k','$newdate')";
            $rses2 = mysqli_query($conn, $queryes2);
        }
        $i = $i + 2;
    }
    $datem = strtotime('-1 day', strtotime($date));
    $datem = date('Y-m-d', $datem);
    $queryes2 = "Delete from employee_shift where date='$datem'";
    $rses2 = mysqli_query($conn, $queryes2);
endif;
