<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (isset($_GET['emid'])):
    $title = "Cập nhập";
    $emid = $_GET['emid'];
    $queryemid = "select * from employees where employee_id='$emid'";
    $rsemid = mysqli_query($conn, $queryemid);
    $fieldemid = mysqli_fetch_array($rsemid);
    $eid = $fieldemid[0];
    $efname = $fieldemid[1];
    $elname = $fieldemid[2];
    $ephone = $fieldemid[3];
    $eemail = $fieldemid[4];
    $eimg = $fieldemid[5];
    $erate = $fieldemid[6];
    $escore = $fieldemid[7];
    if ((int) $erate > 0):
        $score = round((int) $escore / (int) $erate, 2);
    else:
        $score = 0;
    endif;
else:
    $eid = 'Tự động tạo';
    $title = "Thêm";
    $efname = '';
    $elname = '';
    $ephone = '';
    $eemail = '';
    $eimg = '';
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
            $eimg = basename($_FILES["fileupload"]["name"]);
        else:
            header("location:admin.emchange.php?msgErr=Có lỗi xảy ra khi upload file!");
            die;
        endif;
    else:
        header("location:admin.emchange.php?msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
        die;
    endif;
    $elname = $_POST['lname'];
    $efname = $_POST['fname'];
    $ephone = $_POST['phone'];
    $eemail = $_POST['email'];
    $mes = '';
    $querycheck = "select * from employees where phone_number='$ephone'";
    $rscheck = mysqli_query($conn, $querycheck);
    $countcheck = mysqli_num_rows($rscheck);
    $querycheck2 = "select * from employees where email='$eemail'";
    $rscheck2 = mysqli_query($conn, $querycheck2);
    $countcheck2 = mysqli_num_rows($rscheck2);
    if ($countcheck > 0):
        $mes = $mes . 'Số điện thoại đã được đăng ký! ';
    endif;
    if ($countcheck2 > 0):
        $mes = $mes . 'Email đã được đăng ký! ';
    endif;
    if ($mes == ''):
        $query1 = "insert into employees(first_name,last_name,phone_number,email,img) values('$efname','$elname','$ephone','$eemail','$eimg')";
        $rs1 = mysqli_query($conn, $query1);
        if (!$rs1):
            header("location:admin.emchange.php?msgErr=Nothing to save!");
        else:
            header("location:admin.employee.php?msgOK=Thêm nhân viên thành công!");
        endif;
    else:
        $status = unlink("./img/$eimg");
        header("location:admin.emchange.php?msgErr=$mes!");
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
                $status = unlink("./img/$eimg");
                $eimg = basename($_FILES["fileupload"]["name"]);
            else:
                header("location:admin.emchange.php?emid=$eid&msgErr=Có lỗi xảy ra khi upload file!");
                die;
            endif;
        else:
            header("location:admin.emchange.php?emid=$eid&msgErr=Tên file đã tồn tại trên server, không được ghi đè!");
            die;
        endif;
    endif;
    $elname = $_POST['lname'];
    $efname = $_POST['fname'];
    $ephone = $_POST['phone'];
    $eemail = $_POST['email'];
    $mes = '';
    $querycheck = "select * from employees where phone_number='$ephone'";
    $rscheck = mysqli_query($conn, $querycheck);
    $countcheck = mysqli_num_rows($rscheck);
    $querycheck2 = "select * from employees where email='$eemail'";
    $rscheck2 = mysqli_query($conn, $querycheck2);
    $countcheck2 = mysqli_num_rows($rscheck2);
    if ($countcheck > 0):
        $mes = $mes . 'Số điện thoại đã được đăng ký! ';
    endif;
    if ($countcheck2 > 0):
        $mes = $mes . 'Email đã được đăng ký! ';
    endif;
    if ($mes == ''):
        $query1 = "update employees set first_name='$efname',last_name='$elname',phone_number='$ephone',email='$eemail',img='$eimg' where employee_id='$eid'";
        $rs1 = mysqli_query($conn, $query1);
        if (!$rs1):
            header("location:admin.emchange.php?msgErr=Nothing to save!");
        else:
            header("location:admin.employee.php?msgOK=Cập nhập nhân viên thành công!");
        endif;
    else:
        $status = unlink("./img/$eimg");
        header("location:admin.emchange.php?msgErr=$mes!");
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
                        <a href=""><?= $title ?> nhân viên</a>
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
                                        <input type="text" class="form-control" id="province" name="id" value="<?= $eid ?>"
                                               required="required" disabled/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Họ:</label>
                                        <input type="text" class="form-control" id="address" name="fname" value="<?= $efname ?>"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập họ tên nhân viên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="address">Tên:</label>
                                        <input type="text" class="form-control" id="address" name="lname" value="<?= $elname ?>"
                                               required="required"
                                               data-validation-required-message="Vui lòng nhập họ tên nhân viên" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="email">Email:</label>
                                        <input type="text" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" 
                                               placeholder="Email nhân viên" value="<?= $eemail ?>"
                                               class="form-control" id="email" name="email" required="required"
                                               data-validation-required-message="Vui lòng nhập mail nhân viên"
                                               data-validation-pattern-message="Sai định dạng mail"/>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <label for="phone">Số điện thoại:</label>
                                        <input type="tel" pattern="0[0-9]{9,10}" class="form-control" id="phone" name="phone"
                                               placeholder="Số điện thoại mã vùng Việt Nam(bắt đầu bằng số 0)"
                                               required="required" value="<?= $ephone ?>"
                                               data-validation-required-message="Vui lòng nhập số điện thoại nhân viên"
                                               data-validation-pattern-message="Số điện thoại chỉ chứa 10 hoặc 11 chữ số" />
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
                                                <label for="imgchoice">Hình ảnh đang chọn: <img style="margin-left:10px" src="img/<?= $eimg ?>" width="100px"> <?= $eimg ?></label>
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
                                    <?php
                                    if ($title == 'Cập nhập'):
                                        ?>
                                        <div class="control-group">
                                            <label for="address">Lượt đánh giá:</label>
                                            <input type="text" class="form-control" id="province" name="id" value="<?= $erate ?>"
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
                                            <button class="btn" name="btnadd" type="submit" id="Button" disabled>Thêm nhân viên</button>
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
