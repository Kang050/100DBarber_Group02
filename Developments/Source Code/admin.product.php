<?php
include_once './Begin_1.php';
if ($id == null):
    header("location:admin.login.php?msgErr=Bạn cần đăng nhập trước!");
endif;
if (!($_GET['caid'] == '')):
    $caid = $_GET['caid'];
    $queryca = "select * from product_categories where category_id='$caid'";
    $rsca = mysqli_query($conn, $queryca);
    $fieldca = mysqli_fetch_array($rsca);
    $queryproid = "select * from products where category_id='$caid' ORDER BY product_id";
else:
    $caid = '';
    $queryproid = "select * from products ORDER BY product_id";
endif;
$rsproid = mysqli_query($conn, $queryproid);
$countproid = mysqli_num_rows($rsproid);
if (isset($_GET['proid'])):
    $ima = $_GET['ima'];
    $status = unlink("./img/$ima");
    $delproid = $_GET['proid'];
    $querydelproid = "delete from products where product_id='$delproid'";
    $rsdelproid = mysqli_query($conn, $querydelproid);
    header("location:admin.product.php?caid=$caid&msgOK=Xoá sản phẩm thành công!");
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
                        <h2>Sản phẩm</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Sản phẩm</a>
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
                    <h2>Danh sách sản phẩm</h2>
                    <?php
                    if (!($_GET['caid'] == '')):
                        echo "<h3 style='font-weight:bold;margin-top:20px'>Danh mục: $fieldca[1]</h3>";
                    else:
                        echo "<h3 style='font-weight:bold;margin-top:20px'>Tất cả sản phẩm</h3>";
                    endif;
                    ?>
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
                        if (($_GET['caid'] == '')):
                            ?>
                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='time'>Lọc theo tên danh mục:</label>
                                <input  type="text" name='myInput' id="myInput" class="form-control"  onkeyup="myFunction()"  placeholder="Nhập tên danh mục để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>

                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='name'>Lọc theo tên sản phẩm:</label>
                                <input  type="text" name='myInput2' id="myInput2" class="form-control"  onkeyup="myFunction()" placeholder="Nhập tên sản phẩm để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>
                            <?php
                        else:
                            ?>
                            <div class="control-group">
                                <label style='color:black;font-weight:bold;margin-top:20px' for='name'>Lọc theo tên sản phẩm:</label>
                                <input  type="text" name='myInput3' id="myInput3" class="form-control"  onkeyup="myFunction2()" placeholder="Nhập tên sản phẩm để tìm kiếm.." style='border: 2px solid #1d2434;'>
                            </div>
                        <?php
                        endif;
                        ?>
                        <div class="row justify-content-center">
                            <button class="btnp" type="button" id="xoa" disabled onclick="location.href = 'admin.product.php?caid=<?= $caid ?>'" style="margin-top:20px" >Xoá tìm kiếm</button>
                        </div>
                    </div>
                    <table class="table table-bordered" id='table-id' style="margin-top:40px" >
                        <thead>
                            <tr style="text-align:center">
                                <th>ID</th>
                                <?php
                                if (($_GET['caid'] == '')):
                                    ?>
                                    <th>Danh mục</th>
                                    <?php
                                endif;
                                ?>
                                <th style="width:50%">Tên sản phẩm</th>
                                <th>Giá</th>
                                <th colspan="2">Tuỳ chỉnh</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            while ($fieldproduct = mysqli_fetch_array($rsproid)) :
                                $queryca2 = "select * from product_categories where category_id='$fieldproduct[1]'";
                                $rsca2 = mysqli_query($conn, $queryca2);
                                $fieldca2 = mysqli_fetch_array($rsca2);
                                ?>
                                <tr id="row">
                                    <td><?= $fieldproduct[0] ?></td>
                                    <?php
                                    if (($_GET['caid'] == '')):
                                        ?>
                                        <td><a href = "admin.product.php?caid=<?= $fieldca2[0] ?>"><?= $fieldca2[1] ?></a></td>
                                        <?php
                                    endif;
                                    ?>
                                    <td><?= $fieldproduct[2] ?></td>
                                    <td><?= $fieldproduct[5] ?></td>
                                    <td style="text-align:center">
                                        <a style="font-style: italic" href="admin.product.php?caid=<?= $caid ?>&proid=<?= $fieldproduct[0] ?>&ima=<?= $fieldproduct[4] ?>" onclick="return confirm('Bạn chắc chắn muốn xoá sản phẩm này?')">Xoá</a>
                                    </td>
                                    <td style="text-align:center">
                                        <a style="font-style: italic" href="admin.prochange.php?caid=<?= $caid ?>&proid=<?= $fieldproduct[0] ?>" >Xem chi tiết</a>
                                    </td>
                                    </td>
                                </tr>
                                <?php
                            endwhile;
                            ?>           
                        </tbody>
                    </table>
                    <div class="row justify-content-center col-12">
                        <div class='pagination-container ' >
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
                    <div class="row justify-content-center col-12">
                        <?php
                        if (!($_GET['caid'] == '')):
                            ?>

                        <button class="btnp" type="button" onclick="location.href = 'admin.product.php?caid='" style="margin-right:20px">Quay lại</button>
                            <?php
                        endif;
                        ?>
                        <button class="btnp" type="button" onclick="location.href = 'admin.prochange.php?caid=<?= $caid ?>'">Thêm sản phẩm</button>
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
                document.getElementById('xoa').disabled = false;
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
                    td = tr[i].getElementsByTagName("td")[1];
                    td2 = tr[i].getElementsByTagName("td")[2];
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
                document.getElementById('xoa').disabled = false;
                var input2, filter2, table, tr, td2, i, row, count, txtValue2;
                input2 = document.getElementById("myInput3");
                filter2 = input2.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                row = document.getElementById('maxRows');
                count = 0;
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td2 = tr[i].getElementsByTagName("td")[1];
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
