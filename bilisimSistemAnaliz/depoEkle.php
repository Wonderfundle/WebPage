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
$depo_id = $_POST['depo_id'];
$depo_adi = $_POST['depo_adi'];

$sql = "INSERT INTO depolar (depo_id, depo_adi) VALUES ('$depo_id', '$depo_adi')";


// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Veri başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>