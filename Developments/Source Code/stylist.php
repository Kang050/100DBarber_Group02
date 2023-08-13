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
                        <h2>Stylist</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Stylist</a>
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
                                <a href="employee.php?id=<?= $fieldemployee[0] ?>" >
                                    <div class="team-img">
                                        <img src="img/<?= $fieldemployee[5] ?>" alt="Team Image">
                                    </div>
                                    <div class="team-text">
                                        <h2><?= $fieldemployee[1] ?> <?= $fieldemployee[2] ?></h2>
                                        <p>Master Barber</p>
                                        <?php
                                        if ($fieldemployee[6] > 0):
                                            $score1 = round((int) $fieldemployee[7] / (int) $fieldemployee[6], 2);
                                        else:
                                            $score1 = 0;
                                        endif;
                                        ?>
                                        <h2 style="margin-top:10px">
                                            <?= $score1 ?> / 5
                                            <img src="img/star.jpg" style="width:25px;height:25px;margin-top:-7px;margin-left: 5px;margin-right:5px" alt="alt"/> 
                                        </h2>
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
        <!-- Single Page End -->


        <!-- Footer Start -->
        <?php include './Foot.php'; ?>
    </body>
</html>
