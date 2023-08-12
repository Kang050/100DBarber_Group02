<?php
include './Begin.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (isset($_GET['id'])):
    $cancel = $_GET['id'];
    $querycancel = "update appointments set status='2',cancellation_reason='Khách hàng huỷ' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    $queryappid2 = "select * from appointments where appointment_id='$cancel'";
    $rsappid2 = mysqli_query($conn, $queryappid2);
    $fieldappid2 = mysqli_fetch_array($rsappid2);
    $starttime = substr($fieldappid2[4], 11, 8);
    $stadate = substr($fieldappid2[4], 0, 10);
    $querycancel2 = "update employee_shift set status='0' where employee_id='$fieldappid2[3]' and time='$starttime' and date='$stadate'";
    $rscancel2 = mysqli_query($conn, $querycancel2);
    header("location:appolist.php?msgOK=Đã huỷ đặt dịch vụ!");
endif;
$queryappid3 = "select * from appointments where client_id='$id'";
$rsappid3 = mysqli_query($conn, $queryappid3);
$dem = 0;
while ($fieldappid3 = mysqli_fetch_array($rsappid3)) :
    $bookdate = date('Y-m-d', strtotime($fieldappid3[4]));
    if (strtotime($bookdate) >= strtotime($date)):
        $dem++;
    endif;
endwhile;
$queryappid = "select * from appointments where client_id='$id' ORDER BY appointment_id DESC ";
$rsappid = mysqli_query($conn, $queryappid);
$countappid = mysqli_num_rows($rsappid);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
        <script   src="https://code.jquery.com/jquery-3.7.0.js"   integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="   crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main.php'; ?>
        <!-- Single Page Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Hồ sơ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Hồ sơ</a>
                        <a href="">Dịch vụ đã đặt</a>
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
                    <h2>Dịch vụ đã đặt</h2>
                    <p style="margin-top:20px">Danh sách lịch hẹn trong khoảng 5 ngày tính từ hôm nay</p>
                    <p>Các lịch hẹn trễ quá 15 phút sẽ bị tự động huỷ mong quý khách thông cảm và vui lòng đến đúng giờ</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="control-group" > 	
                            <label style='color:black;font-weight:bold' for='state'>Chọn số lượng hàng hiển thị:</label>
                            <select style='border: 2px solid #1d2434' class  ="form-control" name="state" id="maxRows">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <?php
                        if ($dem > 0):
                            ?>
                            <table class="table table-bordered" id="table-id" style="margin-top:40px">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Ngày đặt</th>
                                        <th>Stylist</th>
                                        <th>Dịch vụ</th>
                                        <th>Giờ bắt đầu</th>
                                        <th>Giờ kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Lý do</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dem = 1;
                                    while ($fieldappid = mysqli_fetch_array($rsappid)) :
                                        $bookdate = date('Y-m-d', strtotime($fieldappid[4]));
                                        if (strtotime($bookdate) >= strtotime($date)):
                                            ?>
                                            <tr>
                                                <td><?= $dem ?></td>
                                                <td><?= $fieldappid[1] ?></td>
                                                <?php
                                                $queryappname = "select first_name,last_name from employees where employee_id='$fieldappid[3]'";
                                                $rsappname = mysqli_query($conn, $queryappname);
                                                $fieldappname = mysqli_fetch_array($rsappname);
                                                ?>
                                                <td><?= $fieldappname[0] . ' ' . $fieldappname[1] ?></td>
                                                <?php
                                                $querysername = "select service_name from services where service_id='$fieldappid[8]'";
                                                $rssername = mysqli_query($conn, $querysername);
                                                $fieldsername = mysqli_fetch_array($rssername);
                                                ?>
                                                <td><?= $fieldsername[0] ?></td>
                                                <td><?= $fieldappid[4] ?></td>
                                                <td><?= $fieldappid[5] ?></td>
                                                <?php
                                                switch ($fieldappid[6]):
                                                    case "0":
                                                        echo "<td>Chưa hoàn thành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        ?>
                                                        <td style='font-style:italic'>
                                                            <a onclick="return confirm('Bạn chắc chắn muốn huỷ đặt lịch này?')" href='appolist.php?id=$fieldappid[0]'>Huỷ</a>
                                                        </td>
                                                        <?php
                                                        break;
                                                    case "1":
                                                        echo "<td>Đã hoàn thành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                    case "2":
                                                        echo "<td>Đã huỷ</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                    case "3":
                                                        echo "<td>Đang tiến hành</td>";
                                                        echo "<td>$fieldappid[7]</td>";
                                                        break;
                                                endswitch;
                                                ?>
                                            </tr>
                                            <?php
                                            $dem++;
                                        endif;
                                    endwhile;
                                    ?>           
                                </tbody>
                            </table>
                            <?php
                        else:
                            ?>
                            <h5 style="text-align: center;color:gray;margin-top:40px">Chưa có lịch hẹn nào</h5>
                        <?php
                        endif;
                        ?>
                        <div class="row justify-content-center">
                            <div class='pagination-container' >
                                <nav>
                                    <ul class="pagination">

                                        <li data-page="prev" >
                                            <span> < <span class="sr-only">(current)</span></span>
                                        </li>
                                        <!--	Here the JS Function Will Add the Rows -->
                                        <li data-page="next" id="prev">
                                            <span> > <span class="sr-only">(current)</span></span>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Page End -->
        <style>
            .pagination li{
                cursor: pointer;
                display: inline-block;
                margin: 5px;
                padding: 8px 15px;
                color: #1d2434;
                font-size: 14px;
                font-weight: 600;
                border-radius: 0;
                background: none;
                border: 2px solid #1d2434;
                transition: .3s;
            }

            .pagination li:hover,
            .pagination li.active
            {
                background: #1d2434;
                color: #D5B981;
            }
        </style>
        <script>

            function getPagination(table) {
                var lastPage = 1;
                $('#maxRows')
                        .on('change', function (evt) {
                            //$('.paginationprev').html('');						// reset pagination

                            lastPage = 1;
                            $('.pagination')
                                    .find('li')
                                    .slice(1, -1)
                                    .remove();
                            var trnum = 0; // reset tr counter
                            var maxRows = parseInt($(this).val()); // get Max Rows from select option
                            var totalRows = $(table + ' tbody tr').length;
                            if ((maxRows == 5000) || (maxRows >= totalRows)) {
                                $('.pagination').hide();
                            } else {
                                $('.pagination').show();
                            }

                            // numbers of rows
                            $(table + ' tr:gt(0)').each(function () {
                                // each TR in  table and not the header
                                trnum++; // Start Counter
                                if (trnum > maxRows) {
                                    // if tr number gt maxRows

                                    $(this).hide(); // fade it out
                                }
                                if (trnum <= maxRows) {
                                    $(this).show();
                                } // else fade in Important in case if it ..
                            }); //  was fade out to fade it in
                            if (totalRows > maxRows) {
                                // if tr total rows gt max rows option
                                var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                                //	numbers of pages
                                for (var i = 1; i <= pagenum; ) {
                                    // for each page append pagination li
                                    $('.pagination #prev')
                                            .before(
                                                    '<li data-page="' +
                                                    i +
                                                    '">\
                                                                  <span>' +
                                                    i++ +
                                                    '<span class="sr-only">(current)</span></span>\
                                                                </li>'
                                                    )
                                            .show();
                                } // end for i
                            } // end if row count > max rows
                            $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
                            $('.pagination li').on('click', function (evt) {
                                // on click each page
                                evt.stopImmediatePropagation();
                                evt.preventDefault();
                                var pageNum = $(this).attr('data-page'); // get it's number

                                var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

                                if (pageNum == 'prev') {
                                    if (lastPage == 1) {
                                        return;
                                    }
                                    pageNum = --lastPage;
                                }
                                if (pageNum == 'next') {
                                    if (lastPage == $('.pagination li').length - 2) {
                                        return;
                                    }
                                    pageNum = ++lastPage;
                                }

                                lastPage = pageNum;
                                var trIndex = 0; // reset tr counter
                                $('.pagination li').removeClass('active'); // remove active class from all li
                                $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
                                // $(this).addClass('active');					// add active class to the clicked
                                limitPagging();
                                $(table + ' tr:gt(0)').each(function () {
                                    // each tr in table not the header
                                    trIndex++; // tr index counter
                                    // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                                    if (
                                            trIndex > maxRows * pageNum ||
                                            trIndex <= maxRows * pageNum - maxRows
                                            ) {
                                        $(this).hide();
                                    } else {
                                        $(this).show();
                                    } //else fade in
                                }); // end of for each tr in table
                            }); // end of on click pagination list
                            limitPagging();
                        })
                        .val(5)
                        .change();
                // end of on select change

                // END OF PAGINATION
            }

            function limitPagging() {
                // alert($('.pagination li').length)

                if ($('.pagination li').length > 7) {
                    if ($('.pagination li.active').attr('data-page') <= 3) {
                        $('.pagination li:gt(5)').hide();
                        $('.pagination li:lt(5)').show();
                        $('.pagination [data-page="next"]').show();
                    }
                    if ($('.pagination li.active').attr('data-page') > 3) {
                        $('.pagination li:gt(0)').hide();
                        $('.pagination [data-page="next"]').show();
                        for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                            $('.pagination [data-page="' + i + '"]').show();
                        }

                    }
                }
            }
            $('.pagination li').on('click', function () {
                $(".pagination li").removeClass('active');
                $(this).addClass('active');
            });

            //  Developed By Yasser Mas
            // yasser.mas2@gmail.com
            getPagination('#table-id');

        </script>
        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
