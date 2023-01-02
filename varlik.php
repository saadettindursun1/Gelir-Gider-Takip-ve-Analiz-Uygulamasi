<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Dursun Orman Ürünleri</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">

            <?php include("ustmenu.php");
            include("baglan.php");

            $gelir = 0;
            $gelir2 = 0; //alınmış olanlar
            $gider = 0;
            $gider2 = 0;
            $malDurum = 0;
            $sonuc = 0;

            //borç hesaplama
            foreach ($db->query("select * from odemeler") as $listele) {
                if ($listele["durum"] == 1) {
                    $tutar = $listele["ucret"];
                    if ($listele["borc_tur"] == 2 && $listele["taksit_sayi"] != 0) {
                        $fark = $listele["taksit_sayi"] - $listele["mevcut_taksit"];
                        $tutar = ($fark * $listele["ucret"]);
                    }
                    $gider = $gider + $tutar;
                }
                if ($listele["durum"] == 0) {
                    $gider2 = $gider2 + $listele["ucret"];
                }
            }
            //gelecek hesaplama
            foreach ($db->query("select * from gelirler") as $listele2) {
                if ($listele2["gelir_tur"] == 1) {
                    $gelir = $gelir + $listele2["ucret"];
                }
                if ($listele2["gelir_tur"] == 0) {
                    $gelir2 = $gelir2 + $listele2["ucret"];
                }
            }


            //kasa durumu
            $kasa = $gelir2 - $gider2;

            //mal beyan
            foreach ($db->query("select * from mal_beyan") as $listele3) {
                $malDurum = $malDurum + $listele3["deger"];
            }

            $sonuc = $malDurum + $kasa + $gelir - $gider;

            ?>

            <!-- row -->

            <div class="col-lg-8 card  float-left">

                <div class="card-header text-white bg-dark ">GÜNCEL RAPOR</div>
                <div class="card-body text-dark h5">
                    <span> Kasa Durumu : <?php echo $kasa ?> TL </span>
                    <hr>
                    <span> Borç Durumu: <?php echo $gider; ?> TL</span>
                    <hr>
                    <span> Alacak Durumu: <?php echo $gelir; ?> TL</span>
                    <hr>
                    <span> Mal Değer Durumu : <?php echo $malDurum; ?> TL</span>
                    <hr>
                    <span> Sonuç : <?php echo $sonuc; ?> TL</span>
                    <hr>
                </div>

            </div>

            <form method="post">
                <div class="col-lg-4 card  float-left">

                    <div class="card-header text-white bg-dark">Mal Beyanı</div>
                    <div class="card-body">
                        <input type="text" name="aciklama" class="form-control" placeholder="Açıklama">
                        <input type="number" name="deger" class="form-control mt-2" placeholder="Değer">
                        <button type="submit" name="kaydet" class="btn btn-block btn-warning mt-2">Kaydet</button>
                    </div>
                    <?php
                    @$kaydet = $_POST["kaydet"];
                    if (isset($kaydet)) {
                        $aciklama = $_POST["aciklama"];
                        $deger = $_POST["deger"];
                        if ($db->exec("INSERT INTO mal_beyan(aciklama,deger) 
                                    values ('" . $aciklama . "','" . $deger . "')"));
                        echo '<div class="alert alert-warning">Mal Beyan Bildirimi Kaydedilmiştir..</div>';
                        header("Refresh:2;Url=varlik.php");
                    }
                    ?>
                </div>
            </form>
            <!-- end row -->
            <form method="post">
                <div class="row  col-md-12">
                    <h1 class="text-center col-md-12 mt-4">VARLIKLAR</h1><br>
                    <!-- column contact -->

                    <?php foreach ($db->query("select * from mal_beyan") as $listele4) { ?>

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profile_details margin_bottom_30 ">
                            <div class="contact_blog mt-3">
                                <div class="contact_inner">
                                    <div class="left">
                                        <h3><?php echo $listele4["aciklama"]; ?></h3>
                                        <i class="fa fa-money"></i> <span class="h5"><?php echo $listele4["deger"]; ?> TL</span>
                                        </ul>
                                    </div>
                                    <div class="right">
                                        <div class="profile_contacts">
                                            <img class="img-responsive" src="images/map_icon.png" alt="#" />
                                        </div>
                                    </div>
                                    <div class="bottom_list">
                                        <div class="left_rating">
                                            <p class="ratings">
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                            </p>
                                        </div>
                                        <div class="right_button">
                                            <button type="submit" name="malSilme" value="<?php echo $listele4["id"]; ?>" class="btn btn-danger btn-xs"> <i class="fa fa-user">
                                                </i> <i class="fa fa-comments-o"> Sil</i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-xs">
                                                <i class="fa fa-user"> </i> Güncelle
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                               @$malSilme=$_POST["malSilme"];
                               if(isset($malSilme)){
                                  $sonuc = $db->exec("delete from mal_beyan WHERE id='".$malSilme."' ");
                                  header("Refresh:0;Url=varlik.php");
                               }
                        ?>

                    <?php } ?>

                    <!-- end column contact blog -->

                </div>
        </div>
        </form>
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- wow animation -->
        <script src="js/animate.js"></script>
        <!-- select country -->
        <script src="js/bootstrap-select.js"></script>
        <!-- owl carousel -->
        <script src="js/owl.carousel.js"></script>
        <!-- chart js -->
        <script src="js/Chart.min.js"></script>
        <script src="js/Chart.bundle.min.js"></script>
        <script src="js/utils.js"></script>
        <script src="js/analyser.js"></script>
        <!-- nice scrollbar -->
        <script src="js/perfect-scrollbar.min.js"></script>
        <script>
            var ps = new PerfectScrollbar('#sidebar');
        </script>
        <!-- custom js -->
        <script src="js/custom.js"></script>
        <script src="js/chart_custom_style1.js"></script>
</body>

</html>