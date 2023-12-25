<?php
include '02_baglan.php';

// POST verilerini alma
$urun_id = $_POST['urun_id'];
$depo_id = $_POST['depo_id'];
$miktar = $_POST['miktar'];

// Mevcut miktarı al
$sqlMevcutMiktar = "SELECT miktar FROM stok WHERE urun_id='$urun_id'";
$resultMevcutMiktar = $conn->query($sqlMevcutMiktar);

if ($resultMevcutMiktar->num_rows > 0) {
    // Ürün zaten stokta var, mevcut miktarı al
    $rowMevcutMiktar = $resultMevcutMiktar->fetch_assoc();
    $mevcutMiktar = $rowMevcutMiktar['miktar'];

    // Eğer talep edilen miktar, mevcut miktarı aşıyorsa hata mesajı gönder
    if ($miktar > $mevcutMiktar) {
        echo "Hata: Talep edilen miktar, mevcut miktarı aşıyor.";
    } else {
        // İstenilen miktarı çıkar
        $yeniMiktar = $mevcutMiktar - $miktar;

        // Yeni miktarı güncelle
        $sqlUpdate = "UPDATE stok SET miktar='$yeniMiktar' WHERE urun_id='$urun_id'";

        if ($conn->query($sqlUpdate) === TRUE) {
            // Stok güncellendi, şimdi stok hareketleri tablosuna kayıt ekle
            $hareketTarihi = date('Y-m-d');
            $hareketTuru = 'Azalan Miktar';

            $sqlInsert = "INSERT INTO stok_hareketleri (urun_id, depo_id, miktar, hareket_tarihi, hareket_turu) VALUES ('$urun_id', '$depo_id', '$miktar', '$hareketTarihi', '$hareketTuru')";

            if ($conn->query($sqlInsert) === TRUE) {
                echo "Veri başarıyla güncellendi ve stok hareketi eklendi";
            } else {
                echo "Hata: " . $sqlInsert . "<br>" . $conn->error;
            }
        } else {
            echo "Hata: " . $sqlUpdate . "<br>" . $conn->error;
        }
    }
} else {
    echo "Hata: Ürün stokta bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
