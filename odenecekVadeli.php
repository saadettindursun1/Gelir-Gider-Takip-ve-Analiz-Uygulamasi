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
                        <h2>Ödenecek Vadeli Borçlar</h2>
                     </div>
                  </div>
               </div>
               <!-- row -->
               <div class="row column1">
                  <div class="col-md-12">
                     <div class="white_shd full margin_bottom_30">
                        <form method="post">
                           <div class="full price_table padding_infor_info">
                              <div class="row">
                                 <div class="col-lg-7">
                                    <div class="table-responsive-sm">
                                       <table class="table table-striped projects text-center">
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
                                             foreach ($db->query('SELECT * FROM odemeler where borc_tur="1" order by id desc') as $listele) {
                                                $siraNo++;
                                             ?>
                                                <tr>
                                                   <td><a href="odenecekVadeli.php?silinecek=<?php echo $listele["id"]; ?>" class="text-danger">Sil</a></td>
                                                   <td><?php echo $siraNo; ?></td>
                                                   <td>
                                                      <a><?php echo $listele["odeme_adi"]; ?></a>
                                                      <?php echo $listele["ucret"]; ?>
                                                   </td>
                                                   <td>
                                                      <?php echo $listele["odeme_gunu"]; ?>
                                                   </td>
                                                   <td> <button type="submit" name="btn" value="<?php echo $listele["id"]; ?>" class="btn btn-success btn-xs" <?php if ($listele["durum"] == 0) {

                                                                                                                                                                  echo 'disabled=disabled';
                                                                                                                                                               }     ?>>Ödendi Olarak İşaretle</button> </td>
                                                </tr>
                                                <input type="hidden" name="deger<?php echo $listele["id"]; ?>" value="<?php echo $listele["mevcut_taksit"]; ?>">
                                             <?php } ?>
                                             <?php
                                             @$btn = $_POST["btn"];
                                             if (isset($btn)) {
                                                $tarih = date("d.m.Y");
                                                $sonuc = $db->exec("UPDATE odemeler SET odenen_gun='" . $tarih . "',durum='" . "0" . "' WHERE id='" . $btn . "' ");
                                                echo "Borç Ödeme Bildiriminiz Kaydedilmiştir.";
                                                header("Refresh:0;Url=odenecekVadeli.php");
                                             }
                                             @$silinecek = $_GET["silinecek"];
                                             if (isset($silinecek)) {
                                                $sonuc = $db->exec("delete from odemeler WHERE id='" . $silinecek . "' ");
                                                header("Refresh:0;Url=odenecekVadeli.php");
                                             }
                                             ?>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>

                                 <div class="col-lg-4 card  float-left">

                                    <div class="card-header text-white bg-dark">Ödenecek Vadeli Borç Ekle</div>
                                    <div class="card-body">
                                       <input type="number" name="ucret" class="form-control" placeholder="Ücret">
                                       <input type="date" name="odeme_gunu" class="form-control mt-2" placeholder="Ödeme günü">
                                       <input type="text" name="odeme_adi" class="form-control mt-2" placeholder="Açıklama">
                                       <button type="submit" name="kaydet" class="btn btn-block btn-warning mt-2">Kaydet</button>
                                    </div>
                                    <?php
                                    @$kaydet = $_POST["kaydet"];
                                    if (isset($kaydet)) {
                                       $odeme_adi = $_POST["odeme_adi"];
                                       $ucret = $_POST["ucret"];
                                       $odeme_gunu = $_POST["odeme_gunu"];
                                       if ($db->exec("INSERT INTO odemeler(odeme_adi,ucret,odeme_gunu,taksit_sayi,mevcut_taksit,durum,borc_tur,odenen_gun) 
                                    values ('" . $odeme_adi . "','" . $ucret . "','" . $odeme_gunu . "','" . "-" . "','" . "-" . "','" . "1" . "','" . "1" . "','" . "-" . "')"));
                                       echo '<div class="alert alert-warning">Vadeli Ödenecek Gider Bildirimi Kaydedilmiştir..</div>';
                                       header("Refresh:2;Url=odenecekVadeli.php");
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