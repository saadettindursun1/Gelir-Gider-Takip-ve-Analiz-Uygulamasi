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
         include("baglan.php"); ?>
         <!-- dashboard inner -->
         <!-- dashboard inner -->
         <div class="midde_cont">
            <div class="container-fluid">
               <div class="row column_title">
                  <div class="col-md-12">
                     <div class="page_title">
                        <h2>Alınacak Vadeli Ödemeler</h2>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <form method="post">
               <div class="row column1">
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">

                        <div class="full price_table padding_infor_info">
                           <div class="row">
                              <div class="col-lg-7">
                                 <div class="table-responsive-sm">
                                    <table class="table table-striped projects">
                                       <thead class="thead-dark">
                                          <tr>
                                             <th>Sil</th>
                                             <th>No</th>
                                             <th>Ödeme Adı</th>
                                             <th>Ücret</th>
                                             <th>Ödeme Günü</th>
                                             <th>Durum</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                          $siraNo = 0;
                                          foreach ($db->query("select * from gelirler where gelir_tur=1") as $listele) {
                                             $siraNo++; ?>
                                             <tr>
                                                <td><a href="gelecekVadeli.php?silinecek=<?php echo $listele["id"]; ?>" class="text-danger">Sil</a></td>
                                                <td><?php echo $siraNo; ?></td>
                                                <td>
                                                   <a><?php echo $listele["aciklama"] ?></a>
                                                </td>
                                                <td><?php echo $listele["ucret"]; ?></td>
                                                <td><?php echo $listele["vade_gun"]; ?></td>
                                                <td>
                                                   <button type="submit" name="odendiBtn" value="<?php echo $listele["id"]; ?>" class="btn btn-success btn-xs">Alındı Olarak İşaretle</button>
                                                </td>
                                             </tr>
                                          <?php }
                                            @$odendiBtn=$_POST["odendiBtn"];
                                            if(isset($odendiBtn)){
                                               $sonuc = $db->exec("UPDATE gelirler SET gelir_tur='" . "0" ."' WHERE id='" . $odendiBtn . "' ");
                                               header("Refresh:0;Url=gelecekVadeli.php");
                                            } 
                                            @$silinecek=$_GET["silinecek"];
                                            if(isset($silinecek)){
                                               $sonuc = $db->exec("DELETE FROM gelirler WHERE id='" . $silinecek . "' ");
                                               
                                               header("Refresh:0;Url=gelecekVadeli.php");
                                            }
                                            ?>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                                          </form>
                                
                              <div class="col-lg-4 card  float-left">
                              <form method="post">
                                 <div class="card-header text-white bg-dark">Alınacak Vadeli Ödeme Ekle</div>
                                 <div class="card-body">
                                    <input type="text" name="aciklama" class="form-control" placeholder="Açıklama" required>
                                    <input type="text" name="ucret" class="form-control mt-2" placeholder="Ücret" required>
                                    <input type="date" name="odeme_gunu" class="form-control mt-2" placeholder="Ödeme günü" required>
                                    <button type="submit" name="kaydet" class="btn btn-block btn-warning mt-2">Kaydet</button>
                                 </div>
                                 <?php
                                 @$kaydet = $_POST["kaydet"];
                                 if (isset($kaydet)) {
                                    $aciklama = $_POST["aciklama"];
                                    $ucret = $_POST["ucret"];
                                    $odeme_gunu = $_POST["odeme_gunu"];
                                    if ($db->exec("INSERT INTO gelirler(ucret,aciklama,gelir_tur,vade_gun) 
                                    values ('" . $ucret . "','" . $aciklama . "','" . "1" . "','" . $odeme_gunu . "')"));
                                    echo '<div class="alert alert-warning">Vadeli Alınacak Gelir Bildirimi Kaydedilmiştir..</div>';
                                    header("Refresh:2;Url=gelecekVadeli.php");
                                 }

                               
                                 ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </form>
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