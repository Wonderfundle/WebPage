<?php
session_start();

// Eğer kullanıcı oturumu varsa, kullanıcı bilgilerini kullanabiliriz
if (isset($_SESSION['yonetici_adi'])) {
    $yonetici_adi = $_SESSION['yonetici_adi']; // Kullanıcı adını kullanabilirsiniz
} else {
    // Kullanıcı oturumu yoksa giriş yapma sayfasına yönlendir
    header('Location: giris_yap.php');
    exit;
}

// Burada sayfanızın geri kalanı devam eder...
?>