<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (isset($_GET['serid'])):
    $title = "Cập nhập";
    $serid = $_GET['serid'];
    $queryserid = "select * from services where service_id='$serid'";
    $rsserid = mysqli_query($conn, $queryserid);
    $fieldserid = mysqli_fetch_array($rsserid);
    $sid = $fieldserid[0];
    $sname = $fieldserid[1];
    $sdes = $fieldserid[2];
    $sprice = $fieldserid[3];
    $sdu = $fieldserid[4];
    $simg = $fieldserid[5];
else:
    $sid = 'Tự động tạo';
    $title = "Thêm";
    $sname = '';
    $sdes = '';
    $sprice = '';
    $sdu = '';
    $simg = '';
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
            $simg = basename($_FILES["fileupload"]["name"]);
        else:
            header("location:admin.serchange.php?msgErr=Có lỗi xảy ra khi upload file!");
            die;
        endif;
    else:
        header("location:admin.serchange.php?msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
        die;
    endif;
    $sname = $_POST['name'];
    $sdes = $_POST['des'];
    $sprice = $_POST['price'];
    $sdu = $_POST['du'];
    $query1 = "insert into services(service_name,service_description,service_price,service_duration,img) values('$sname','$sdes','$sprice','$sdu','$simg')";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.serchange.php?msgErr=Nothing to save!");
    else:
        header("location:admin.service.php?msgOK=Thêm dịch vụ thành công!");
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
                $status = unlink("./img/$simg");
                $simg = basename($_FILES["fileupload"]["name"]);
            else:
                header("location:admin.serchange.php?serid=$sid&msgErr=Có lỗi xảy ra khi upload file!");
                die;
            endif;
        else:
            header("location:admin.serchange.php?serid=$sid&msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
            die;
        endif;
    endif;
    $sname = $_POST['name'];
    $sdes = $_POST['des'];
    $sprice = $_POST['price'];
    $sdu = $_POST['du'];
    $query1 = "update services set service_name='$sname',service_description='$sdes',service_price='$sprice',service_duration='$sdu',img='$simg' where service_id='$sid'";
    $rs1 = mysqli_query($conn, $query1);
    if (!$rs1):
        header("location:admin.serchange.php?serid=$sid&msgErr=Nothing to save!");
    else:
        header("location:admin.service.php?msgOK=Cập nhập dịch vụ thành công!");
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
                        <h2>Nhân viên & Dịch vụ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Nhân viên & Dịch vụ</a>
                        <a href=""><?= $title ?> dịch vụ</a>
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
                                        <input type="text" class="form-control" id="province" name="id" value="<?= $sid ?>"
                                               required="required" disabled/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Tên dịch vụ:</label>
                                        <input type="text" class="form-control" id="address" name="name" value="<?= $sname ?>"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập tên dịch vụ" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Miêu tả:</label>
                                        <textarea class="form-control" id="address" name="des" style='border: 2px solid #1d2434;'
                                                  required="required"
                                                  data-validation-required-message="Vui lòng nhập miêu tả dịch vụ" ><?= $sdes ?></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Giá tiền:</label>
                                        <input type="text" class="form-control" id="province" name="price" value="<?= $sprice ?>"
                                               required="required" data-validation-required-message="Vui lòng nhập giá dịch vụ"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Thời gian:</label>
                                        <input type="text" class="form-control" id="province" name="du" value="<?= $sdu ?>"
                                               placeholder="Thời gian tính theo phút"
                                               required="required" data-validation-required-message="Vui lòng thời gian"/>
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
                                                <label for="imgchoice">Hình ảnh đang chọn: <img style="margin-left:10px" src="img/<?= $simg ?>" width="100px"> <?= $simg ?></label>
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
                                    <div class="row justify-content-center">
                                        <?php
                                        if ($title == 'Thêm'):
                                            ?>
                                            <button class="btn" name="btnadd" type="submit" id="Button" disabled>Thêm dịch vụ</button>
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
                lastModified: new Date()
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
