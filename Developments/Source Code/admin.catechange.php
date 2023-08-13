<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (isset($_GET['cateid'])):
    $title = "Cập nhập";
    $cateid = $_GET['cateid'];
    $querycateid = "select * from product_categories where category_id='$cateid'";
    $rscateid = mysqli_query($conn, $querycateid);
    $fieldcateid = mysqli_fetch_array($rscateid);
    $caid = $fieldcateid[0];
    $caname = $fieldcateid[1];
else:
    $caid = 'Tự động tạo';
    $title = "Thêm";
    $caname = '';
endif;
if (isset($_POST['btnadd'])):
    $caname = $_POST['name'];
    $query1 = "INSERT into product_categories(category_name) values('$caname')";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.catechange.php?msgErr=Nothing to save!");
    else:
        header("location:admin.cate.php?msgOK=Thêm danh mục thành công!");
    endif;
endif;
if (isset($_POST['btnupdate'])):
    $caname = $_POST['name'];
    $query1 = "update product_categories set category_name='$caname' where category_id='$caid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location::admin.catechange.php?msgErr=Nothing to save!");
    else:
        header("location:admin.cate.php?msgOK=Cập nhập danh mục thành công!");
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
                        <h2>Sản phẩm</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Sản phẩm</a>
                        <a href=""><?= $title ?> danh mục</a>
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
                                    <div class="control-group">
                                        <label for="province">ID:</label>
                                        <input type="text" class="form-control" id="province" name="caid" value="<?= $caid ?>"
                                               required="required" disabled/>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Tên danh mục:</label>
                                        <input autofocus type="text" class="form-control" id="address" name="name" value="<?= $caname ?>"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập tên danh mục" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <input type="hidden" name="form1" id="ok" />
                                    <?php
                                    if ($title == 'Thêm'):
                                        ?>
                                        <button class="btn" name="btnadd" type="submit" id="Button">Thêm danh mục</button>
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
    <?php include './Foot_1.php'; ?>
</body>
</html>
