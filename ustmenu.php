<?php

session_start();

ob_start();

  header('Content-Type: text/html; charset=utf-8');

if($_SESSION["admin"]!=TRUE)
{
header("Refresh:0;url= hata.php");
}
?>
  <nav id="sidebar">
     <div class="sidebar_blog_1">
        <div class="sidebar-header">
           <div class="logo_section">
              <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
           </div>
        </div>
        <div class="sidebar_user_info">
           <div class="icon_setting"></div>
           <div class="user_profle_side">
              <div class="user_info">
                 <img class="img-responsive" src="images/dursun.png" alt="#" />
              </div>
           </div>
        </div>
     </div>
     <div class="sidebar_blog_2">
        <h4>Menü</h4>
        <ul class="list-unstyled components">
           <li>
              <a href="index.php">
                 <i class="fa fa-clone white_color"></i> <span>Ana Sayfa</span></a>
           </li>
           <li><a href="kasa.php"><i class="fa fa-dashboard yellow_color"></i> <span>Kasa</span></a></li>

           <li><a href="aylik.php"><i class="fa fa-clock-o orange_color"></i> <span>Aylık Ödemeler</span></a></li>
           <li>
              <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Vadeli İşlemler</span></a>
              <ul class="collapse list-unstyled" id="element">
                 <li><a href="odenecekVadeli.php">> <span>Ödenecek vadeli borçlar</span></a></li>
                 <li><a href="gelecekVadeli.php">> <span>Alınacak vadeli kazançlar</span></a></li>
              </ul>
           </li>
           <li><a href="takvim.php"><i class="fa fa-table purple_color2"></i> <span>Ajanda (Hatırlatıcı)</span></a></li>

           <li><a href="varlik.php"><i class="fa fa-briefcase blue1_color"></i> <span>Güncel Rapor</span></a></li>

           <li><a href="cikis.php"><i class="fa fa-close red_color"></i> <span>Çıkış Yap (<?php echo $_SESSION["mail"]; ?>)</span></a></li>
        </ul>
     </div>
  </nav>
  <!-- end sidebar -->

  <!-- right content -->

  <div id="content">
     <!-- topbar -->
     <div class="topbar">
        <nav class="navbar navbar-expand-lg navbar-light">
           <div class="full">
              <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
              <div class="logo_section">
                 <a href="index.php"><img class="img-responsive" src="images/dursun.png" alt="#" /></a>
              </div>

           </div>
        </nav>
     </div>
     <!-- end topbar -->
