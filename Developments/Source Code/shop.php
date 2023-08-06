<?php
include_once './Begin.php';
$querycate2 = "SELECT * FROM product_categories";
$rscate2 = mysqli_query($conn, $querycate2);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main.php'; ?>

        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Cửa hàng</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Trang chủ</a>
                        <a href="">Cửa hàng</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page Start -->
        <div class="portfolio">
            <div class="blog">
                <div class="container">
                    <div class="section-header text-center">
                        <h2>Danh mục hàng hoá của chúng tôi gồm có</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul id="portfolio-flters">
                                <li data-filter="*" class="filter-active">Tất cả</li>
                                <?php
                                while ($fieldcate2 = mysqli_fetch_array($rscate2)) :
                                    echo "<li data-filter='.$fieldcate2[0]'>$fieldcate2[1]</li>";
                                endwhile;
                                ?> 
                            </ul>
                        </div>
                    </div>
                    <div class="row portfolio-container">
                        <div class="row blog-page">

                                <?php
                                while ($fieldproduct = mysqli_fetch_array($rsproduct)) :
                                    ?> 

                                        <div  class="col-lg-4 col-md-6 col-sm-12 portfolio-item <?= $fieldproduct[1] ?>">
                                            <div class="blog-item" style="border:solid #D5B981 2px">
                                                <a href="product.php?id=<?= $fieldproduct[0] ?>" >
                                                    <img src="img/<?= $fieldproduct[4] ?>" >
                                                    <div class="blog-text" >
                                                        <h2 style="margin-top: 30px;-webkit-line-clamp: 1;
                                                            display: -webkit-box;
                                                            -webkit-box-orient: vertical;
                                                            overflow: hidden;
                                                            text-overflow: ellipsis;
                                                            white-space: normal;"><?= $fieldproduct[2] ?></h2>
                                                        <h5 style="color:red;font-weight: bolder">
                                                            <?= $fieldproduct[5] ?> VNĐ
                                                        </h5>
                                                        <?php
                                                        if ($fieldproduct[6] > 0):
                                                            $score1 = round((int) $fieldproduct[7] / (int) $fieldproduct[6], 2);
                                                        else:
                                                            $score1 = 0;
                                                        endif;
                                                        ?>
                                                        <h6>
                                                            <?= $score1 ?> / 5
                                                            <img src="img/star.jpg" style="width:25px;height:25px;margin-top:-7px;margin-left: 5px;margin-right:5px" alt="alt"/> 
                                                            | <?= $fieldproduct[6] ?> lượt đánh giá
                                                        </h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    
                                    <?php
                                endwhile;
                                ?> 
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Page End -->
        <script>

        </script>

        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
