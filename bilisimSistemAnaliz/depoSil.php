<?php
// Veritabanı bağlantısı için bilgiler
include "02_baglan.php";

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini al
$depo_id = $_POST['depo_id'];

// Silme sorgusu
$sql = "DELETE FROM depolar WHERE depo_id = $depo_id";

if ($conn->query($sql) === TRUE) {
    echo "Depo başarıyla silindi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>