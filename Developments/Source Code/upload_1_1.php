<?php
$status = unlink('./img/Star 1.png');
if ($status){
    echo "File bị xóa thành công!";
} else {
    echo "Error: File không bị xóa.";
}
?>
$pcate = $_POST['cate'];
    $pname = $_POST['name'];
    $pdes = $_POST['des'];
    $pprice = $_POST['price'];
    $query1 = "update products set name='$pname',category_id='$pcate',description='$pdes',product_image='$pimg',price='$pprice' where product_id='$pid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.prochange.php?msgErr=Nothing to save!");
    else:
        header("location:admin.product.php?msgOK=Cập nhập sản phẩm thành công!");
    endif;