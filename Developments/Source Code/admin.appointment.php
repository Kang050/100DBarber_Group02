<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (!($_GET['proid'] == '')):
    $proid = $_GET['proid'];
    $querycli2 = "select * from clients where client_id='$proid'";
    $rscli2 = mysqli_query($conn, $querycli2);
    $fieldcli2 = mysqli_fetch_array($rscli2);
    $queryappoint = "select * from appointments where client_id='$proid' ORDER BY appointment_id DESC ";
else:
    $proid = '';
    $queryappoint = "select * from appointments ORDER BY start_time DESC ";
endif;
$rsappoint = mysqli_query($conn, $queryappoint);
$countappoint = mysqli_num_rows($rsappoint);
if (isset($_GET['id'])):
    $cancel = $_GET['id'];
    $querycancel = "update appointments set status='2',cancellation_reason='Khách đặt lại' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    $queryappid2 = "select * from appointments where appointment_id='$cancel'";
    $rsappid2 = mysqli_query($conn, $queryappid2);
    $fieldappid2 = mysqli_fetch_array($rsappid2);
    $starttime = substr($fieldappid2[4], 11, 8);
    $stadate = substr($fieldappid2[4], 0, 10);
    $querycancel2 = "update employee_shift set status='0' where employee_id='$fieldappid2[3]' and time='$starttime' and date='$stadate'";
    $rscancel2 = mysqli_query($conn, $querycancel2);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã huỷ đặt dịch vụ!");
endif;
if (isset($_GET['back3id'])):
    $cancel = $_GET['back3id'];
    $querycancel = "update appointments set status='0',cancellation_reason='' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    $queryappid2 = "select * from appointments where appointment_id='$cancel'";
    $rsappid2 = mysqli_query($conn, $queryappid2);
    $fieldappid2 = mysqli_fetch_array($rsappid2);
    $starttime = substr($fieldappid2[4], 11, 8);
    $stadate = substr($fieldappid2[4], 0, 10);
    $querycancel2 = "update employee_shift set status='1' where employee_id='$fieldappid2[3]' and time='$starttime' and date='$stadate'";
    $rscancel2 = mysqli_query($conn, $querycancel2);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã hoàn tác đơn đặt dịch vụ!");

endif;
if (isset($_GET['back1id'])):
    $cancel = $_GET['back1id'];
    $querycancel = "update appointments set status='0',cancellation_reason='' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã hoàn tác đơn đặt dịch vụ!");

endif;
if (isset($_GET['back2id'])):
    $cancel = $_GET['back2id'];
    $querycancel = "update appointments set status='3',cancellation_reason='' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã hoàn tác đơn đặt dịch vụ!");

endif;
if (isset($_GET['staid'])):
    $cancel = $_GET['staid'];
    $querycancel = "update appointments set status='3',cancellation_reason='' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã tiến hành đơn đặt dịch vụ!");

endif;
if (isset($_GET['endid'])):
    $cancel = $_GET['endid'];
    $querycancel = "update appointments set status='1',cancellation_reason='' where appointment_id='$cancel'";
    $rscancel = mysqli_query($conn, $querycancel);
    header("location:admin.appointment.php?proid=$proid&msgOK=Đã hoàn thành đơn đặt dịch vụ!");

endif;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
        <script   src="https://code.jquery.com/jquery-3.7.0.js"   integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="   crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main_1.php'; ?>

        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Đơn đặt dịch vụ</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Đơn đặt dịch vụ</a>
                        <?php
                        if (!($_GET['proid'] == '')):
                            echo "<a href=''>Khách hàng: $fieldcli2[2]</a>";
                        endif;
                        ?>

                    </div>
                </div>
            </div>
        </div>
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
                    <h2>Danh sách lịch hẹn</h2>
                    <?php
                    if (!($_GET['proid'] == '')):
                        echo "<h3 style='font-weight:bold;margin-top:20px'>Khách hàng: $fieldcli2[2]</h3>";
                        echo "<h3 style='font-weight:bold;margin-top:20px'>SĐT: $fieldcli2[3]</h3>";
                    else:
                        echo "<h3 style='font-weight:bold;margin-top:20px'>Tất cả khách hàng</h3>";
                    endif;
                    ?>
                    <p style="margin-top:20px">Các lịch hẹn trễ quá 15 phút sẽ bị tự động huỷ</p>
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
                        <?php
                        if (($_GET['proid'] == '')):
                            ?>
                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='time'>Lọc theo số điện thoại:</label>
                                <input  type="text" name='myInput' id="myInput" class="form-control"  onkeyup="myFunction()"  placeholder="Nhập số điện thoại để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>

                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='name'>Lọc theo tên khách hàng:</label>
                                <input  type="text" name='myInput2' id="myInput2" class="form-control"  onkeyup="myFunction()"  placeholder="Nhập tên khách hàng để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>
                            <?php
                        else:
                            ?>
                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='name'>Lọc theo giờ bắt đầu:</label>
                                <input  type="text" name='myInput3' id="myInput3" class="form-control"  onkeyup="myFunction2()"  placeholder="Nhập giờ bắt đầu để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="row justify-content-center">
                            <button class="btnp" type="button" id="xoa" onclick="location.href = 'admin.appointment.php?proid=<?= $proid ?>'" style="margin-top:20px" disabled>Xoá tìm kiếm</button>
                        </div>
                    </div>
                    <div class="col-12" style="margin-top:40px">
                        <div class="container row justify-content-center ">
                            <table class="table table-bordered" id= "table-id">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="width:3%">ID</th>

                                        <?php
                                        if (($_GET['proid'] == '')):
                                            ?>
                                            <th style="width:15%">Khách hàng</th>
                                            <th style="width:15%">Số điện thoại</th>
                                            <?php
                                        endif;
                                        ?>
                                        <th style="width:9%">Stylist</th>
                                        <th style="width:15%">Giờ bắt đầu</th>
                                        <th style="width:15%">Trạng thái</th>
                                        <?php
                                        if (!($_GET['proid'] == '')):
                                            ?>
                                            <th style="width:15%">Lý do</th>
                                            <?php
                                        endif;
                                        ?>
                                        <th colspan="3" style="width:27%">Tuỳ chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    if ($countappoint == 0):
                                        echo 'Không có lịch đặt nào!';
                                    else:
                                        $dem = 1;
                                        while ($fieldappid = mysqli_fetch_array($rsappoint)) :
                                            ?>
                                            <tr>
                                                <td><?= $fieldappid[0] ?></td>
                                                <?php
                                                $querycli = "select * from clients where client_id='$fieldappid[2]'";
                                                $rscli = mysqli_query($conn, $querycli);
                                                $fieldcli = mysqli_fetch_array($rscli);
                                                if (($_GET['proid'] == '')):
                                                    ?>
                                                    <td><a href="admin.appointment.php?proid=<?= $fieldcli[0] ?>"><?= $fieldcli[2] ?></a></td>
                                                    <td><?= $fieldcli[3] ?></td>
                                                    <?php
                                                endif;
                                                $queryappname = "select first_name,last_name from employees where employee_id='$fieldappid[3]'";
                                                $rsappname = mysqli_query($conn, $queryappname);
                                                $fieldappname = mysqli_fetch_array($rsappname);
                                                ?>
                                                <td><?= $fieldappname[0] . ' ' . $fieldappname[1] ?></td>
                                                <td><?= $fieldappid[4] ?></td>
                                                <?php
                                                if (!($_GET['proid']) == ''):
                                                    switch ($fieldappid[6]):
                                                        case "0":
                                                            echo "<td>Chưa hoàn thành</td>";
                                                            echo "<td>$fieldappid[7]</td>";
                                                            ?>                                                       
                                                            <td style='font-style:italic;width:10%;text-align: center'>
                                                                <a  onclick="return confirm('Bạn có chắc chắn khách đã đến?')" href='admin.appointment.php?proid=<?= $proid ?>&staid=<?= $fieldappid[0] ?>'>Tiến hành</a> </td>
                                                            <td style='font-style:italic;text-align: center;width:6%'>
                                                                <a  onclick="return confirm('Bạn chắc chắn muốn huỷ đặt lịch này?')" href='admin.appointment.php?proid=<?= $proid ?>&id=<?= $fieldappid[0] ?>'>Huỷ</a>
                                                            </td>   
                                                            <?php
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "1":
                                                            echo "<td>Đã hoàn thành</td>";
                                                            echo "<td>$fieldappid[7]</td>";
                                                            ?>
                                                            <td style='font-style:italic;width:10%;text-align: center'><a onclick="return confirm('Bạn có chắc chắn hoàn tác lịch đặt này?')"   href='admin.appointment.php?proid=<?= $proid ?>&back2id=<?= $fieldappid[0] ?>'>Hoàn tác</a></td>
                                                            <?php
                                                            echo "<td style='width:6%'></td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "2":
                                                            echo "<td>Đã huỷ</td>";
                                                            echo "<td>$fieldappid[7]</td>";
                                                            if ($fieldappid[7] == "Quá giờ hẹn"):
                                                                echo "<td></td>";
                                                            else:
                                                                ?>
                                                                <td style='font-style:italic;width:10%;text-align: center'><a onclick="return confirm('Bạn có chắc chắn hoàn tác lịch đặt này?')"   href='admin.appointment.php?proid=<?= $proid ?>&back3id=<?= $fieldappid[0] ?>'>Hoàn tác</a></td>
                                                            <?php
                                                            endif;
                                                            echo "<td style='width:6%'></td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "3":
                                                            echo "<td>Đang tiến hành</td>";
                                                            echo "<td>$fieldappid[7]</td>";
                                                            ?>
                                                            <td style='font-style:italic;width:10%;text-align: center'><a onclick="return confirm('Bạn có chắc chắn hoàn tác lịch đặt này?')"   href='admin.appointment.php?proid=<?= $proid ?>&back1id=<?= $fieldappid[0] ?>'>Hoàn tác</a></td>
                                                            <td style='font-style:italic;text-align: center;width:6%'><a onclick="return confirm('Bạn có chắc chắn lịch đặt này đã hoàn thành xong?')"   href='admin.appointment.php?proid=<?= $proid ?>&endid=<?= $fieldappid[0] ?>'>Xong</a></td>
                                                            <?php
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                    endswitch;
                                                else:
                                                    switch ($fieldappid[6]):
                                                        case "0":
                                                            echo "<td>Chưa hoàn thành</td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "1":
                                                            echo "<td>Đã hoàn thành</td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "2":
                                                            echo "<td>Đã huỷ</td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                        case "3":
                                                            echo "<td>Đang tiến hành</td>";
                                                            echo "<td style='width:12%;text-align: center'><a href='admin.appochange.php?proid=$proid&id=$fieldappid[0]'>Xem chi tiết</a></td>";
                                                            break;
                                                    endswitch;
                                                endif;
                                                ?>
                                            </tr>
                                            <?php
                                            $dem++;

                                        endwhile;
                                    endif;
                                    ?>           
                                </tbody>
                            </table>
                            <div class="row justify-content-center col-12">
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
                            <?php
                            if (!($_GET['proid'] == '')):
                                ?>
                                <div class="row justify-content-center col-12">
                                    <button class="btnp" type="button" onclick="location.href = 'admin.appointment.php?proid='" style="">Quay lại</button>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>




        <!-- Single Page End -->
        <style>
            .btnp {
                padding: 15px 30px;

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
            .btnp:disabled {
                color: #D5B981;
                background: #1d2434;
                opacity:0.5;
            }
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
                            if ((maxRows == 5000) || (maxRows>=totalRows)) {
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
            function myFunction() {
                // Declare variables 
                document.getElementById('xoa').disabled=false;
                var input, filter, table, tr, td, i, count, txtValue, row, input2, filter2, td2, txtValue2;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                input2 = document.getElementById("myInput2");
                filter2 = input2.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                row = document.getElementById('maxRows');
                count = 0;
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    td2 = tr[i].getElementsByTagName("td")[1];
                    if (td && td2) {
                        txtValue = td.textContent || td.innerText;
                        txtValue2 = td2.textContent || td2.innerText;
                        if ((txtValue.toUpperCase().indexOf(filter) > -1) && (txtValue2.toUpperCase().indexOf(filter2) > -1) && (count < parseInt(row.value))) {
                            tr[i].style.display = "";
                            count++;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
                $('.pagination').hide();
            }
            function myFunction2() {
                // Declare variables 
                document.getElementById('xoa').disabled=false;
                var input2, filter2, table, tr, td2, i, row, count, txtValue2;
                input2 = document.getElementById("myInput3");
                filter2 = input2.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                row = document.getElementById('maxRows');
                count = 0;
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td2 = tr[i].getElementsByTagName("td")[2];
                    if (td2) {
                        txtValue2 = td2.textContent || td2.innerText;
                        if ((txtValue2.toUpperCase().indexOf(filter2) > -1) && (count < parseInt(row.value))) {
                            tr[i].style.display = "";
                            count++;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
                $('.pagination').hide();
            }
        </script>

        <!-- Footer Start -->
        <?php include './Foot_1.php'; ?>
    </body>
</html>
