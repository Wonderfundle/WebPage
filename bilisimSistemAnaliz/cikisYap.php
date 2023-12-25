<?php
// cikisYap.php

// Session'ı başlat
session_start();

// Tüm session değişkenlerini sil
$_SESSION = array();

// Session'ı sonlandır
session_destroy();

// Kullanıcıyı giriş yapma sayfasına yönlendir
header('Location: giris_yap.php');
exit;
?>
