<?php
include "02_baglan.php";
// POST verilerini al
$urun_id = $_POST['urun_id'];

// Silme sorgusu
$sql = "DELETE FROM urunler WHERE urun_id = $urun_id";

if ($conn->query($sql) === TRUE) {
    echo "Ürün başarıyla silindi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>