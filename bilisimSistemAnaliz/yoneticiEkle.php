<?php
include "02_baglan.php";
// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini alma
$yonetici_id=$_POST['yonetici_id'];
$yonetici_adi = $_POST['yonetici_adi'];
$sifre = $_POST['sifre'];

// SQL sorgusu oluşturma
$sql = "INSERT INTO yoneticiler (yonetici_id,yonetici_adi, sifre) VALUES ('$yonetici_id','$yonetici_adi', '$sifre')";

// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Yeni yönetici başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
