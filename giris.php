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
   <!-- calendar file css -->
   <link rel="stylesheet" href="js/semantic.min.css" />
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
   <div class="full_container">
      <div class="container">
         <div class="center verticle_center full_height">
            <div class="login_section">
               <div class="logo_login">
                  <div class="center">
                     <img width="300" src="images/dursun.png" alt="#" />
                  </div>
               </div>
               <div class="login_form">
                  <form method="post">
                     <fieldset>
                        <div class="field">
                           <label class="label_field">E-mail</label>
                           <input type="text" name="email" placeholder="E-mail" required />
                        </div>
                        <div class="field">
                           <label class="label_field">Parola</label>
                           <input type="password" name="parola" placeholder="Parola" required />
                        </div>

                        <div class="field margin_0">
                           <label class="label_field hidden">hidden label</label>
                           <button type="submit" name="giris" class="main_bt">Giriş Yap</button>
                        </div>

                        <?php
                        include("baglan.php");
                        @$giris = $_POST["giris"];
                        if (isset($giris)) {
                           $mail = $_POST["email"];
                           $parola = $_POST["parola"];
                           $sql = $db->prepare("SELECT * FROM yonetim WHERE mail='$mail' AND parola='$parola'");

                           $query = $db->query("SELECT * FROM yonetim WHERE mail='{$mail}' AND parola='{$parola}'")->fetch(PDO::FETCH_ASSOC);
                           $sql->execute();
                           if ($sql->rowCount()) {
                              @session_destroy();
                              session_start();
                              ob_start();
                              $_SESSION["admin"] = TRUE;
                              $_SESSION["mail"] = $query["mail"];
                              header("Refresh:0;url=index.php");
                              //echo 'Giriş Yapıldı'; 
                           } else {
                              echo 'Giriş Başarısız';
                           }
                        }
                        ?>
                     </fieldset>
                  </form>
               </div>
            </div>
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
   <!-- nice scrollbar -->
   <script src="js/perfect-scrollbar.min.js"></script>
   <script>
      var ps = new PerfectScrollbar('#sidebar');
   </script>
   <!-- custom js -->
   <script src="js/custom.js"></script>
</body>

</html>