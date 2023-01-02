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
          $tarih = date("Y-m-d");
         
          ?>
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid mt-5">
            <form method="POST">       
            <div class="card col-md-6 float-left">
             <div class="card-header text-white bg-success">Gelir Ekle</div>
             <div class="card-body">
                <input type="text" name="gelirucret" class="form-control" placeholder="Ücret" required>
                <input type="date" name="gelirtarih" class="form-control mt-2" value="<?php echo $tarih; ?>" disabled=disabled>

                <input type="text" name="geliraciklama" class="form-control mt-2" placeholder="Açıklama" required>
                <button type="submit" name="gelir" class="btn btn-block btn-warning mt-2">Kaydet</button>
             </div>
            </div>
            <?php 
               @$gelir=$_POST["gelir"];
               if(isset($gelir)){
                  @$gelirucret=$_POST["gelirucret"];
                  @$gelirtarih=$_POST["gelirtarih"];
                  @$geliraciklama=$_POST["geliraciklama"];
                  $gelir_tur=0;
                  $vade_gun="-";                
                  if($db->exec("INSERT INTO gelirler(ucret,aciklama,gelir_tur,vade_gun) 
                  values ('".$gelirucret."','".$geliraciklama."','".$gelir_tur."','".$gelirtarih."')"));
                  $sonuc="Gelir Bildirimi Kaydedildi..";
               } ?>


            </form>  
            <form METHOD="POST">
            <div class="card col-md-6 float-left">
             <div class="card-header text-white bg-danger">Gider Ekle</div>
             <div class="card-body">
                <input type="text" name="giderucret" class="form-control" placeholder="Ücret" required>
                <input type="date" name="gidertarih" class="form-control mt-2" value="<?php echo $tarih; ?>"  disabled=disabled>
                <input type="text" name="gideraciklama" class="form-control mt-2" placeholder="Açıklama" required>
                <button type="submit" name="gider" class="btn btn-block btn-warning mt-2">Kaydet</button>
             </div>
            </div>
            <?php 
               @$gider=$_POST["gider"];
               if(isset($gider)){
                  @$giderucret=$_POST["giderucret"];
                  @$gidertarih=date("d.m.Y");
                  @$gideraciklama=$_POST["gideraciklama"];
                  $giderdurum=0;
                  $gider_tur=0;
                  if($db->exec("INSERT INTO odemeler(odeme_adi,ucret,odeme_gunu,taksit_sayi,mevcut_taksit,durum,borc_tur,odenen_gun) 
                  values ('".$gideraciklama."','".$giderucret."','".$gidertarih."','"."-"."','"."-"."','".$giderdurum."','".$gider_tur."','".$gidertarih."')"));
                  $sonuc="Gider Bildirimi Kaydedildi..";
               } ?>
            </form>
            <div>
            
                 <span class="mt-2"><?php echo @$sonuc; ?> </span>
                </div>
          
                  
                <!-- widgets başlanhıç -->
                <div class="col-md-6 float-left">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Gelirler</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="msg_list_main">
                                          <ul class="msg_list">
                                             <?php
                                             foreach($db->query('SELECT * FROM gelirler where gelir_tur="0" order by id desc') as $listele) {
                                             ?>
                                             <li>
                                                <span>
                                                <span class="name_user"><?php echo $listele["ucret"]; ?></span>
                                                <span class="msg_user"><?php echo $listele["aciklama"]; ?></span>
                                                <span class="time_ago"><?php echo $listele["vade_gun"]; ?></span>
                                                </span>
                                             </li>
                                       <?php } ?>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 float-left">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Giderler</h2>
                                 </div>
                              </div>
                              <div class="full progress_bar_inner">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="msg_list_main">
                                          <ul class="msg_list">
                                          <?php
                                             foreach($db->query('SELECT * FROM odemeler where durum="0" order by odenen_gun desc') as $listele2) {
                                             ?>
                                             <li>
                                                <span>
                                                <span class="name_user"><?php echo $listele2["ucret"]; ?></span>
                                                <span class="msg_user"><?php echo $listele2["odeme_adi"]; ?></span>
                                                <span class="time_ago"><?php echo $listele2["odenen_gun"]; ?></span>
                                                </span>
                                             </li>
                                             <?php } ?>
                                            </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                       
                     </div>
                  </div>
                  <!-- Widgets Bitiş -->
                </div>
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