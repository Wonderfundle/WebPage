<?php
// veritabanina_ekle.php

include "02_baglan.php";

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini alma
$kategori_id = $_POST['kategori_id'];
$kategori_adi = $_POST['kategori_adi'];


$sql = "INSERT INTO kategoriler (kategori_id,kategori_adi) VALUES ('$kategori_id', '$kategori_adi')";


// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Veri başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>