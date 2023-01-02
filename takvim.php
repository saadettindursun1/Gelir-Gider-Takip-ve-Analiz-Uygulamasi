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
         $bulunanAy = date("m");
         @$secimTarih = $_GET["secimAy"];
         if (isset($secimTarih)) {
            $bulunanAy = $secimTarih;
         }
         @$ayYazdir = "";

         if ($bulunanAy == 1) {
            $ayYazdir = "Ocak";
         }
         if ($bulunanAy == 7) {
            $ayYazdir = "Temmuz";
         }
         if ($bulunanAy == 2) {
            $ayYazdir = "Şubat";
         }
         if ($bulunanAy == 8) {
            $ayYazdir = "Ağustos";
         }
         if ($bulunanAy == 3) {
            $ayYazdir = "Mart";
         }
         if ($bulunanAy == 9) {
            $ayYazdir = "Eylül";
         }
         if ($bulunanAy == 4) {
            $ayYazdir = "Nisan";
         }
         if ($bulunanAy == 10) {
            $ayYazdir = "Ekim";
         }
         if ($bulunanAy == 5) {
            $ayYazdir = "Mayıs";
         }
         if ($bulunanAy == 11) {
            $ayYazdir = "Kasım";
         }
         if ($bulunanAy == 6) {
            $ayYazdir = "Haziran";
         }
         if ($bulunanAy == 12) {
            $ayYazdir = "Aralık";
         }


         $bulunanYil = date("Y");
         ?>
         <!-- dashboard inner -->
         <div class="midde_cont">
            <div class="container-fluid">
               <form method="post">
                  <div class="card col-md-12 ">
                     <div class="card-header text-white bg-success">Görev Ekle</div>
                     <div class="card-body">
                        <input type="text" name="gorev" class="form-control" placeholder="Açıklama">

                        <input type="date" name="gorevTarih" value="<?php echo $tarih; ?>" class="form-control mt-2">
                        <button type="submit" name="kaydet" class="btn btn-block btn-warning mt-2">Kaydet</button>
                     </div>
                  </div>
                  <?php
                  @$kaydet = $_POST["kaydet"];
                  if (isset($kaydet)) {
                     $gorev = $_POST["gorev"];
                     $gorevTarih = $_POST["gorevTarih"];
                     if ($db->exec("INSERT INTO ajanda(gorev,tarih) 
                                    values ('" . $gorev . "','" . $gorevTarih . "')"));
                     echo '<div class="alert alert-warning">Görev Kaydedilmiştir..</div>';
                     header("Refresh:2;Url=takvim.php");
                  }
                  ?>
               </form>
               <div class="col-md-12">
                  <div class="col-md-12 mt-4">
                     <select name="secimAy" id="" class="form-control" onchange="MM_jumpMenu('parent',this,0)">
                        <option value="takvim.php?secimAy=1" <?php if ($bulunanAy == 1) {
                                                                  echo 'selected=selected';
                                                               } ?>>Ocak</option>
                        <option value="takvim.php?secimAy=2" <?php if ($bulunanAy == 2) {
                                                                  echo 'selected=selected';
                                                               } ?>>Şubat</option>
                        <option value="takvim.php?secimAy=3" <?php if ($bulunanAy == 3) {
                                                                  echo 'selected=selected';
                                                               } ?>>Mart</option>
                        <option value="takvim.php?secimAy=4" <?php if ($bulunanAy == 4) {
                                                                  echo 'selected=selected';
                                                               } ?>>Nisan</option>
                        <option value="takvim.php?secimAy=5" <?php if ($bulunanAy == 5) {
                                                                  echo 'selected=selected';
                                                               } ?>>Mayıs</option>
                        <option value="takvim.php?secimAy=6" <?php if ($bulunanAy == 6) {
                                                                  echo 'selected=selected';
                                                               } ?>>Haziran</option>
                        <option value="takvim.php?secimAy=7" <?php if ($bulunanAy == 7) {
                                                                  echo 'selected=selected';
                                                               } ?>>Temmuz</option>
                        <option value="takvim.php?secimAy=8" <?php if ($bulunanAy == 8) {
                                                                  echo 'selected=selected';
                                                               } ?>>Ağustos</option>
                        <option value="takvim.php?secimAy=9" <?php if ($bulunanAy == 9) {
                                                                  echo 'selected=selected';
                                                               } ?>>Eylül</option>
                        <option value="takvim.php?secimAy=10" <?php if ($bulunanAy == 10) {
                                                                  echo 'selected=selected';
                                                               } ?>>Ekim</option>
                        <option value="takvim.php?secimAy=11" <?php if ($bulunanAy == 11) {
                                                                  echo 'selected=selected';
                                                               } ?>>Kasım</option>
                        <option value="takvim.php?secimAy=12" <?php if ($bulunanAy == 12) {
                                                                  echo 'selected=selected';
                                                               } ?>>Aralık</option>
                     </select>
                  </div>
                  <table class="table table-striped projects text-center mt-4">
                     <thead class="thead-dark">
                        <tr>
                           <th colspan="7" class="h5">2022 Yılı <?php echo $ayYazdir ?> Ayı Görev Çizelgesi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                           <tr>
                              <?php for ($t = 1; $t < 7; $t++) { ?>
                                 <td><?php
                                       $gunYaz = $t + ($i * 6);

                                       $gunEslestir = $bulunanYil . "-" . $bulunanAy . "-" . $gunYaz;
                                       $stil = "";
                                       $id = "";
                                       foreach ($db->query("select * from ajanda where tarih='" . $gunEslestir . "'") as $listele4) {
                                          $stil = "h5 text-danger ustYuvarlak";
                                          $id = $listele4["id"];
                                       }   ?>
                                    <a href="takvim.php?secimAy=<?php echo $bulunanAy  ?>&gelenId=<?php echo $gunEslestir; ?>" class="<?php echo $stil ?>"><?php echo $gunYaz ?></a>

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
                           <?php
                           @$gelenId = $_GET["gelenId"];
                           if ($gelenId > 0) {
                              foreach ($db->query("select * from ajanda where tarih='" . $gelenId . "'") as $listele2) {
                           ?>
                                 <li>
                                    <span>
                                       <span class="name_user"><?php echo $listele2["gorev"]; ?></span>
                                       <span class="msg_user"><?php echo $listele2["tarih"]; ?></span>
                                       <span class="time_ago"><a href="takvim.php?gorevSil=<?php echo $listele2["id"]; ?>" class="text-danger">Sil</a></span>
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
               </div>

            </div>
         </div>


         <!-- end dashboard inner -->

      </div>
   </div>
   </div>
   <!-- jQuery -->

   <script type="text/javascript">
      function MM_jumpMenu(targ, selObj, restore) { //v3.0

         eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");

         if (restore) selObj.selectedIndex = 0;

      }
   </script>
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