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

         <?php
         include("ustmenu.php");
         include("baglan.php"); ?>
         <!-- dashboard inner -->
         <!-- dashboard inner -->
         <div class="midde_cont">
            <div class="container-fluid">
               <div class="row column_title">
                  <div class="col-md-12">
                     <div class="page_title">
                        <h2>Aylık Ödemeler</h2>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <div class="row column1">
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">

                        <div class="full price_table padding_infor_info">
                           <div class="row">
                              <div class="col-lg-8 float-left">
                                 <form method="post">
                                    <div class="table-responsive-sm">
                                       <table class="table table-striped projects text-center">
                                          <thead class="thead-dark">
                                             <tr>
                                                <th>Sil</th>
                                                <th>No</th>
                                                <th>Ödeme Adı</th>
                                                <th>Ücret</th>
                                                <th>Ödeme Günü</th>
                                                <th>Taksit Sayısı</th>
                                                <th>En Son Ödenen</th>
                                                <th>Durum</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php
                                             $siraNo = 0;
                                             foreach ($db->query('SELECT * FROM odemeler where borc_tur="2" order by id desc') as $listele) {
                                                $siraNo++;
                                             ?>
                                                <tr>
                                                   <td><a href="aylik.php?silinecek=<?php echo $listele["id"]; ?>" class="text-danger">Sil</a></td>
                                                   <td><?php echo $siraNo; ?></td>
                                                   <td>
                                                      <a><?php echo $listele["odeme_adi"]; ?></a>
                                                   </td>
                                                   <td>
                                                      <?php echo $listele["ucret"]; ?>
                                                   </td>
                                                   <td>
                                                      <?php echo $listele["odeme_gunu"]; ?>
                                                   </td>
                                                   <td><?php echo $listele["mevcut_taksit"] . "/" . $listele["taksit_sayi"]; ?></td>
                                                   <td><?php echo $listele["odenen_gun"]; ?></td>
                                                   <td> <button type="submit" name="btn" value="<?php echo $listele["id"]; ?>" class="btn btn-success btn-xs" <?php if ($listele["mevcut_taksit"] == $listele["taksit_sayi"] && $listele["taksit_sayi"] > 0) {
                                                                                                                                                                  echo 'disabled=disabled';
                                                                                                                                                               }     ?>>Ödendi Olarak İşaretle</button> </td>
                                                </tr>
                                                <input type="hidden" name="deger<?php echo $listele["id"]; ?>" value="<?php echo $listele["mevcut_taksit"]; ?>">
                                             <?php } ?>

                                          </tbody>
                                       </table>
                                       <?php
                                       @$btn = $_POST["btn"];
                                       @$deger = $_POST["deger" . $btn];
                                       $deger = $deger + 1;
                                       if (isset($btn)) {
                                          $tarih = date("d.m.Y");
                                          $sonuc = $db->exec("UPDATE odemeler SET odenen_gun='" . $tarih . "',mevcut_taksit='" . $deger . "' WHERE id='" . $btn . "' ");
                                          foreach ($db->query('SELECT * FROM odemeler where id=' . $btn . '') as $listele3) {
                                          }
                                          if ($db->exec("INSERT INTO odemeler(odeme_adi,ucret,odeme_gunu,taksit_sayi,mevcut_taksit,durum,borc_tur,odenen_gun) 
                                             values ('" . $listele3["odeme_adi"] . "','" . $listele3["ucret"] . "','" . $listele3["odeme_gunu"] . "','" . $listele3["taksit_sayi"] . "','" . $deger . "','" . "0" . "','" . "0" . "','" . $tarih . "')"));
                                          header("Refresh:0");
                                       }
                                       @$silinecek = $_GET["silinecek"];
                                       if (isset($silinecek)) {
                                          $sonuc = $db->exec("delete from odemeler WHERE id='" . $silinecek . "' ");
                                          header("Refresh:0;Url=aylik.php");
                                       }
                                       ?>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-4 card  float-right">

                              <form method="post">
                                 <div class="card-header text-white bg-dark">Aylık Gider Ekle</div>
                                 <div class="card-body">
                                    <input type="text" name="ucret" class="form-control" placeholder="Ücret" required>
                                    <input type="number" name="odeme_gunu" class="form-control mt-2" placeholder="Ödeme günü" required>
                                    <input type="number" name="taksit_sayi" class="form-control mt-2" placeholder="Taksit Sayısı" required>
                                    <input type="text" name="mevcut_taksit" class="form-control mt-2" placeholder="Sıradaki Taksit" required>
                                    <input type="text" name="odeme_adi" class="form-control mt-2" placeholder="Açıklama" required>
                                    <button type="submit" name="kaydet" class="btn btn-block btn-warning mt-2">Kaydet</button>
                                 </div>
                                 <?php
                                 @$kaydet = $_POST["kaydet"];
                                 if (isset($kaydet)) {
                                    $odeme_adi = $_POST["odeme_adi"];
                                    $ucret = $_POST["ucret"];
                                    $odeme_gunu = $_POST["odeme_gunu"];
                                    $taksit_sayi = $_POST["taksit_sayi"];
                                    $mevcut_taksit = $_POST["mevcut_taksit"];
                                    if ($db->exec("INSERT INTO odemeler(odeme_adi,ucret,odeme_gunu,taksit_sayi,mevcut_taksit,durum,borc_tur,odenen_gun) 
                                    values ('" . $odeme_adi . "','" . $ucret . "','" . $odeme_gunu . "','" . $taksit_sayi . "','" . $mevcut_taksit . "','" . "1" . "','" . "2" . "','" . "-" . "')"));
                                    echo '<div class="alert alert-warning">Aylık Gider Bildirimi Kaydedilmiştir..</div>';
                                    header("Refresh:2;Url=aylik.php");
                                 }
                                 ?>
                              </form>

                           </div>
                        </div>


                     </div>

                  </div>

               </div>

               <!-- end row -->

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