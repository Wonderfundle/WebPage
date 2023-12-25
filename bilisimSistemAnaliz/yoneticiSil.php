<?php
include "02_baglan.php";
// POST verilerini al
$yonetici_id = $_POST['yonetici_id'];

// Silme sorgusu
$sql = "DELETE FROM yoneticiler WHERE yonetici_id = $yonetici_id";

if ($conn->query($sql) === TRUE) {
    echo "Yönetici başarıyla silindi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>