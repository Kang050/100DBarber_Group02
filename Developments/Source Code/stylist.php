<?php
include_once './Begin.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include './Head.php'; ?>
    </head>

    <body>

        <!-- Nav Bar End -->

        <?php include './Main.php'; ?>

        <!-- Single Page Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Barber</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Barber</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Team Start -->
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <p>Đội ngũ stylist</p>
                    <h2>Gặp gỡ stylist đến từ nước ngoài</h2>
                </div>
                <div class="row">
                    <?php
                    while ($fieldemployee = mysqli_fetch_array($rsemployees)) :
                        ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="<?= $fieldemployee[5] ?>" alt="Team Image">
                                </div>
                                <div class="team-text">
                                    <h2><?= $fieldemployee[1] ?> <?= $fieldemployee[2] ?></h2>
                                    <p>Master Barber</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>    
                </div>
            </div>
        </div>
        <!-- Single Page End -->


        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
