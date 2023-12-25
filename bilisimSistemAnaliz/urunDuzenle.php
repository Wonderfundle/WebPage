<?php
// Veritabanı bağlantısı için bilgiler
$servername = "localhost"; // Veritabanı sunucusu
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifre
$dbname = "bilisimdeneme"; // Veritabanı adı

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini al
$urun_id = $_POST['urun_id'];
$urun_adi = $_POST['urun_adi'];
$kategori_id = $_POST['kategori_id'];
$birim_fiyat = $_POST['birim_fiyat'];
$tedarikci_id = $_POST['tedarikci_id'];

// Güncelleme sorgusu
$sql = "UPDATE urunler SET urun_adi='$urun_adi', kategori_id='$kategori_id', birim_fiyat='$birim_fiyat', tedarikci_id = '$tedarikci_id' WHERE urun_id=$urun_id";

if ($conn->query($sql) === TRUE) {
    echo "Ürün başarıyla güncellendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>