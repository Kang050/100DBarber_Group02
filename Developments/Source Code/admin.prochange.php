<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
$caid = $_GET['caid'];
if (isset($_GET['proid'])):
    $title = "Cập nhập";
    $proid = $_GET['proid'];
    $queryproid = "select * from products where product_id='$proid'";
    $rsproid = mysqli_query($conn, $queryproid);
    $fieldproid = mysqli_fetch_array($rsproid);
    $pid = $fieldproid[0];
    $pcate = $fieldproid[1];
    $pname = $fieldproid[2];
    $pdes = $fieldproid[3];
    $pimg = $fieldproid[4];
    $pprice = $fieldproid[5];
    $prate = $fieldproid[6];
    $pscore = $fieldproid[7];
    if ((int) $prate > 0):
        $score = round((int) $pscore / (int) $prate, 2);
    else:
        $score = 0;
    endif;
else:
    $pid = 'Tự động tạo';
    $title = "Thêm";
    $pcate = '';
    $pname = '';
    $pdes = '';
    $pimg = '';
    $pprice = '';
endif;
if (isset($_POST['btnadd'])):
    $target_dir = "./img/";
    //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
    $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);

    $allowUpload = true;

    // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
    // Bạn có thể phát triển code để lưu thành một tên file khác
    if (file_exists($target_file)):
        $allowUpload = false;
    endif;

    if ($allowUpload):
        // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)):
            $pimg = basename($_FILES["fileupload"]["name"]);
        else:
            header("location:admin.prochange.php?caid=$caid&msgErr=Có lỗi xảy ra khi upload file!");
            die;
        endif;
    else:
        header("location:admin.prochange.php?caid=$caid&msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
        die;
    endif;
    $pcate = $_POST['cate'];
    $pname = $_POST['name'];
    $pdes = $_POST['des'];
    $pprice = $_POST['price'];
    $query1 = "insert into products(category_id,name,description,product_image,price) values('$pcate','$pname','$pdes','$pimg','$pprice')";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.prochange.php?caid=$caid&msgErr=Nothing to save!");
    else:
        header("location:admin.product.php?caid=$caid&msgOK=Thêm sản phẩm thành công!");
    endif;
endif;
if (isset($_POST['btnupdate'])):
    if ($_POST['imgchoice'] == '2'):


        // Đã có dữ liệu upload, thực hiện xử lý file upload
        //Thư mục bạn sẽ lưu file upload
        $target_dir = "./img/";
        //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
        $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);

        $allowUpload = true;

        // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
        // Bạn có thể phát triển code để lưu thành một tên file khác
        if (file_exists($target_file)):
            $allowUpload = false;
        endif;

        if ($allowUpload):
            // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
            if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)):
                $status = unlink("./img/$pimg");
                $pimg = basename($_FILES["fileupload"]["name"]);
            else:
                header("location:admin.prochange.php?caid=$caid&proid=$pid&msgErr=Có lỗi xảy ra khi upload file!");
                die;
            endif;
        else:
            header("location:admin.prochange.php?caid=$caid&proid=$pid&msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
            die;
        endif;
    endif;
    $pcate = $_POST['cate'];
    $pname = $_POST['name'];
    $pdes = $_POST['des'];
    $pprice = $_POST['price'];
    $query1 = "update products set name='$pname',category_id='$pcate',description='$pdes',product_image='$pimg',price='$pprice' where product_id='$pid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.prochange.php?caid=$caid&msgErr=Nothing to save!");
    else:
        header("location:admin.product.php?caid=$caid&msgOK=Cập nhập sản phẩm thành công!");
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
                            <?php
                            if (isset($_GET['msgOK'])):
                                echo '<div class="alert alert-success">' . $_GET['msgOK'] . '</div>';
                            endif;
                            if (isset($_GET['msgErr'])):
                                echo '<div class="alert alert-danger">' . $_GET['msgErr'] . '</div>';
                            endif;
                            ?>
                            <div class="register-form">
                                <div id="success"></div>
                                <form  method="post" id="Form" novalidate="novalidate"  enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label for="province">ID:</label>
                                        <input type="text" class="form-control" id="province" name="id" value="<?= $pid ?>"
                                               required="required" disabled/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Danh mục:</label>
                                        <select id='address' name='cate' onchange="" class='form-control' style='border: 2px solid #1d2434;margin-bottom:10px'>
                                            <option value="no"  >Chọn danh mục</option>
                                            <?php
                                            while ($fieldcate = mysqli_fetch_array($rscate)) :
                                                if ($pcate == $fieldcate[0]):
                                                    ?>
                                                    <option selected value='<?= $fieldcate[0] ?>'><?= $fieldcate[1] ?></option>
                                                    <?php
                                                else:
                                                    ?>
                                                    <option value='<?= $fieldcate[0] ?>'><?= $fieldcate[1] ?></option>
                                                <?php
                                                endif;
                                            endwhile;
                                            ?> 
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Tên sản phẩm:</label>
                                        <textarea class="form-control" id="address" name="name"  style='border: 2px solid #1d2434;'
                                                  required="required"
                                                  data-validation-required-message="Vui lòng nhập tên sản phẩm" ><?= $pname ?></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Miêu tả:</label>
                                        <textarea class="form-control" id="address" name="des" style='border: 2px solid #1d2434;'
                                                  required="required"
                                                  data-validation-required-message="Vui lòng nhập miêu tả sản phẩm" ><?= $pdes ?></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <?php
                                    if ($title == 'Thêm'):
                                        ?>
                                        <div class="control-group">
                                            <label for="address">Hình ảnh:</label>
                                            <input onchange="check2()" style="margin-left:10px" type="file" name="fileupload"  id="fileupload" value="" accept="image/png, image/jpg, image/jpeg"/>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <?php
                                    else:
                                        ?>
                                        <div class="control-group">
                                            <label for="address">Hình ảnh:</label>
                                            <div class="control-group">
                                                <input onchange="check(1)" type="radio" id="imgchoice" name="imgchoice" checked style="margin-right:10px" value="1">
                                                <label for="imgchoice">Hình ảnh đang chọn: <img style="margin-left:10px" src="img/<?= $pimg ?>" width="100px"> <?= $pimg ?></label>
                                            </div>
                                            <div class="control-group">
                                                <input onchange="check(2)" type="radio" id="imgchoice" name="imgchoice" style="margin-right:10px" value="2">
                                                <label for="imgchoice" >Chọn hình mới:
                                                    <input onchange="check1()" style="margin-left:10px" type="file" name="fileupload" disabled id="fileupload" value="" accept="image/png, image/jpg, image/jpeg" />
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                    <?php
                                    endif;
                                    ?>
                                    <div class="control-group">
                                        <label for="address">Giá tiền:</label>
                                        <input type="text" class="form-control" id="province" name="price" value="<?= $pprice ?>"
                                               required="required" data-validation-required-message="Vui lòng nhập giá sản phẩm"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <?php
                                    if ($title == 'Cập nhập'):
                                        ?>
                                        <div class="control-group">
                                            <label for="address">Lượt đánh giá:</label>
                                            <input type="text" class="form-control" id="province" name="id" value="<?= $prate ?>"
                                                   required="required" disabled >
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <label for="address">Điểm đánh giá:</label>
                                            <input type="text" class="form-control" id="province" name="id" value="<?= $score ?>"
                                                   required="required" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                    <div class="row justify-content-center">
                                        <?php
                                        if ($title == 'Thêm'):
                                            ?>
                                            <button class="btn" name="btnadd" type="submit" id="Button" disabled>Thêm sản phẩm</button>
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
        <style>
            #Button:disabled {
                color: #D5B981;
                background: #1d2434;
                opacity:0.5;
            }
        </style>
        <script>
            const fileInput = document.querySelector('input[type="file"]');

            // Create a new File object
            const myFile = new File(['Hello World!'], 'Chỉ File: PNG, JPG, JPEG', {
                type: 'text/plain',
                lastModified: new Date(),
            });

            // Now let's create a DataTransfer to get a FileList
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(myFile);
            fileInput.files = dataTransfer.files;
            function check(r) {
                if (r === 2) {
                    document.getElementById("fileupload").disabled = false;
                    if (document.getElementById("fileupload").files === dataTransfer.files) {
                        document.getElementById("Button").disabled = true;
                    }

                } else {
                    document.getElementById("fileupload").disabled = true;
                    document.getElementById("Button").disabled = false;
                }
            }
            function check1() {

                if (document.getElementById("fileupload").files.length === 0) {
                    document.getElementById("Button").disabled = true;
                } else {
                    document.getElementById("Button").disabled = false;
                }
                if (document.getElementById("fileupload").files.length === 0) {
                    fileInput.files = dataTransfer.files;
                }
            }
            function check2() {
                if (document.getElementById("fileupload").files === dataTransfer.files) {
                    document.getElementById("Button").disabled = true;
                } else {
                    document.getElementById("Button").disabled = false;
                }
            }

        </script>
        <!-- Footer Start -->
        <?php include './Foot_1.php'; ?>
    </body>
</html>
