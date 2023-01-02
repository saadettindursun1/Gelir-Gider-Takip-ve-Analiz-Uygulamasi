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

         <?php include("ustmenu.php"); include("baglan.php");
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
            foreach ($db->query("select * from gelirler") as $listele5) {
                if ($listele5["gelir_tur"] == 1) {
                    $gelir = $gelir + $listele5["ucret"];
                }
                if ($listele5["gelir_tur"] == 0) {
                    $gelir2 = $gelir2 + $listele5["ucret"];
                }
            }


            //kasa durumu
            $kasa = $gelir2 - $gider2;

            //mal beyan
            $sorgu = $db->prepare("SELECT COUNT(*) FROM mal_beyan");
            $sorgu->execute();
            $malDurum = $sorgu->fetchColumn();
         ?>
         <!-- dashboard inner -->
         <div class="row column1">
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-exchange yellow_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo $kasa; ?> ₺</p>
                                 <p class="head_couter">Kasa Durumu</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-level-down red_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo $gider; ?> ₺</p>
                                 <p class="head_couter">Borç Durumu</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-level-up green_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo $gelir; ?> ₺</p>
                                 <p class="head_couter">Alacak Durumu</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-car blue1_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no"><?php echo $malDurum; ?></p>
                                 <p class="head_couter">Varlık Sayısı</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



        <!--TABLO BAŞLANGIÇ --> <table class="table table-striped projects text-center mt-4">
            <thead class="thead-dark">
               <tr>
                  <th colspan="7" class="h5"><span class="text-center">GÖREV ÇİZELGESİ</span>  <span class="float-right"><?php echo date("d.m.Y"); ?></span></th>
               </tr>
            </thead>
            <tbody>
               <?php for ($i = 0; $i < 5; $i++) { ?>
                  <tr>
                     <?php for ($t = 1; $t < 7; $t++) { ?>
                        <td><?php
                              $gunYaz = $t + ($i * 6);
                              $stil = "";
                              $id = "";
                              foreach ($db->query("select * from odemeler where borc_tur=2 and odeme_gunu='" . $gunYaz . "'") as $listele4) {
                                 $stil = "h5 ustYuvarlak text-danger";
                                 $id = $listele4["id"];
                              }   ?>
                           <a href="index.php?secimGun=<?php echo $gunYaz; ?>" class="<?php echo $stil ?>"><?php echo $gunYaz ?></a>

                        </td>
                     <?php } ?>
                  </tr> <?php } ?>
               <tr>
                  <td>31</td>
               </tr>

            </tbody>
         </table>

         <div class="col-md-12 mt-5">
                     <div class="msg_list_main">
                        <ul class="msg_list">
                           <?php  @$secimGun = $_GET["secimGun"];
                           if ($secimGun > 0) { ?>
                           <h3> ÖDEME LİSTESİ</h3><hr>
                           <?php
                           foreach ($db->query("select * from odemeler where borc_tur=2 and odeme_gunu='" . $secimGun . "'") as $listele2) {
                           ?>
                                 <li>
                                    <span>
                                       <span class="name_user"><?php echo $listele2["odeme_adi"]; ?></span>
                                       <span class="msg_user"><?php echo $listele2["ucret"]; ?></span>
                                       <span class="time_ago"><?php echo $listele2["odenen_gun"];  ?>  (Son Ödenen Tarih)</span>
                                    </span>
                                 </li>
                           <?php }
                           } ?>
                        </ul>
                     </div>
                     <?php
                     @$gorevSil = $_GET["gorevSil"];
                     if (isset($gorevSil)) {
                        $sonuc = $db->exec("delete from ajanda WHERE id='" . $gorevSil . "' ");
                        header("Refresh:0;Url=takvim.php");
                     }
                     ?>
                  </div>


         <!-- end dashboard inner -->
      </div>
   </div>
   </div>
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