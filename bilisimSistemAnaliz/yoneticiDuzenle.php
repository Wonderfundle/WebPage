<?php
include "02_baglan.php";
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini alma
$yonetici_id = $_POST['yonetici_id'];
$yonetici_adi = $_POST['yonetici_adi'];
$sifre = $_POST['sifre'];

// SQL sorgusu oluşturma
$sql = "UPDATE yoneticiler SET yonetici_adi='$yonetici_adi', sifre='$sifre' WHERE yonetici_id=$yonetici_id";

// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Yönetici bilgileri başarıyla güncellendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
