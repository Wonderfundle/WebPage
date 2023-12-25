<?php
// veritabanina_ekle.php

// Veritabanı bağlantısı
$servername = "localhost"; // Veritabanı sunucusu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "bilisimdeneme"; // Veritabanı adı

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini alma
$urun_id = $_POST['urun_id'];
$urun_adi = $_POST['urun_adi'];
$kategori_id = $_POST['kategori_id'];
$birim_fiyat = $_POST['birim_fiyat'];
$tedarikci_id = $_POST['tedarikci_id'];

$sql = "INSERT INTO urunler (urun_id, urun_adi, birim_fiyat,kategori_id, tedarikci_id) VALUES ('$urun_id', '$urun_adi','$birim_fiyat','$kategori_id',  '$tedarikci_id')";

// SQL sorgusu oluşturma
//$sql = "INSERT INTO urunler (urun_id,urun_adi, fiyat, stok_miktari) VALUES ($urun_id', '$urun_adi', '$urun_fiyati', '$urun_adedi')";

// Sorguyu çalıştırma ve sonucu kontrol etme
if ($conn->query($sql) === TRUE) {
    echo "Veri başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>