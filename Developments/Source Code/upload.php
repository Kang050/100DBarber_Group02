<?php
  
  // file upload.php xử lý upload file

  if ($_SERVER['REQUEST_METHOD'] !== 'POST'):
      // Dữ liệu gửi lên server không bằng phương thức post
      echo "Phải Post dữ liệu";
      die;
  endif;

  // Kiểm tra có dữ liệu fileupload trong $_FILES không
  // Nếu không có thì dừng
  if (!isset($_FILES["fileupload"])):
      echo "Dữ liệu không đúng cấu trúc";
      die;
  endif;

  // Kiểm tra dữ liệu có bị lỗi không
  if ($_FILES["fileupload"]['error'] != 0):
    echo "Dữ liệu upload bị lỗi";
    die;
  endif;

  // Đã có dữ liệu upload, thực hiện xử lý file upload

  //Thư mục bạn sẽ lưu file upload
  $target_dir    = "./img/";
  //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
  $target_file   = $target_dir . basename($_FILES["fileupload"]["name"]);

  $allowUpload   = true;

  //Lấy phần mở rộng của file (jpg, png, ...)
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Cỡ lớn nhất được upload (bytes)
  $maxfilesize   = 800000;

  ////Những loại file được phép upload
  $allowtypes    = array('jpg', 'png', 'jpeg');




  // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
  // Bạn có thể phát triển code để lưu thành một tên file khác
  if (file_exists($target_file)):
      header('location:admin.prochange.php?msgError=Tên file đã tồn tại trên server, không được ghi đè');
      $allowUpload = false;
  endif;
  // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
  if ($_FILES["fileupload"]["size"] > $maxfilesize):
      header("location:admin.prochange.php?msgError=Không được upload ảnh lớn hơn $maxfilesize (bytes).");
      $allowUpload = false;
  endif;


  // Kiểm tra kiểu file


  if ($allowUpload):
      // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
      if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)):


      
      else:
      
          echo "Có lỗi xảy ra khi upload file.";
      endif;
  endif;

