<?php
include '02_baglan.php';

// POST verilerini alma
$urun_id = $_POST['urun_id'];
$depo_id = $_POST['depo_id'];
$miktar = $_POST['miktar'];

// Belirli ürün ve depo kombinasyonunun mevcut olup olmadığını kontrol et
$sqlCheckExistence = "SELECT COUNT(*) as count FROM stok WHERE urun_id='$urun_id' AND depo_id='$depo_id'";
$resultCheckExistence = $conn->query($sqlCheckExistence);

if ($resultCheckExistence === FALSE) {
    die("Hata: " . $sqlCheckExistence . "<br>" . $conn->error);
}

$rowExistence = $resultCheckExistence->fetch_assoc();
$countExistence = $rowExistence['count'];

if ($countExistence > 0) {
    // Ürün ve depo kombinasyonu mevcut, miktarı güncelle
    $sqlUpdate = "UPDATE stok SET miktar = miktar + $miktar WHERE urun_id='$urun_id' AND depo_id='$depo_id'";

    if ($conn->query($sqlUpdate) === TRUE) {
        // Stok güncellendi, stok hareketi ekle
        $hareketTuru = ($miktar > 0) ? 'Artan Miktar' : 'Yeni Veri Girişi';
        $hareketTarihi = date('Y-m-d');

        $sqlInsert = "INSERT INTO stok_hareketleri (urun_id, depo_id, miktar, hareket_tarihi, hareket_turu) VALUES ('$urun_id', '$depo_id', '$miktar', '$hareketTarihi', '$hareketTuru')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "Veri başarıyla güncellendi ve stok hareketi eklendi";
        } else {
            echo "Hata: " . $sqlInsert . "<br>" . $conn->error;
        }
    } else {
        echo "Hata: " . $sqlUpdate . "<br>" . $conn->error;
    }
} else {
    // Ürün ve depo kombinasyonu mevcut değil, yeni stok girişi yap
    $sqlInsert = "INSERT INTO stok (urun_id, depo_id, miktar) VALUES ('$urun_id', '$depo_id', '$miktar')";

    if ($conn->query($sqlInsert) === TRUE) {
        // Yeni stok eklendi, stok hareketi ekle
        $hareketTuru = 'Yeni Veri Girişi';
        $hareketTarihi = date('Y-m-d');

        $sqlInsertHareket = "INSERT INTO stok_hareketleri (urun_id, depo_id, miktar, hareket_tarihi, hareket_turu) VALUES ('$urun_id', '$depo_id', '$miktar', '$hareketTarihi', '$hareketTuru')";

        if ($conn->query($sqlInsertHareket) === TRUE) {
            echo "Veri başarıyla eklendi ve stok hareketi eklendi";
        } else {
            echo "Hata: " . $sqlInsertHareket . "<br>" . $conn->error;
        }
    } else {
        echo "Hata: " . $sqlInsert . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
