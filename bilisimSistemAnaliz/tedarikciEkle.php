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
$tedarikci_id = $_POST['tedarikci_id'];
$tedarikci_adi = $_POST['tedarikci_adi'];
$tedarikci_adresi = $_POST['tedarikci_adresi'];


$sql = "INSERT INTO tedarikciler (tedarikci_id, tedarikci_adi, tedarikci_adresi) VALUES ('$tedarikci_id', '$tedarikci_adi', '$tedarikci_adresi')";


// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Veri başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>