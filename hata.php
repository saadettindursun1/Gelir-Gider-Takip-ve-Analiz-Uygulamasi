<?php
 echo str_repeat("<br>", 8)."<center><img src=images/error.png border=0 /> <br> Yönetim Paneli sadece yetkili kullanıcılara açıktır!</center>";
 header("Refresh:3;url= giris.php");
?>