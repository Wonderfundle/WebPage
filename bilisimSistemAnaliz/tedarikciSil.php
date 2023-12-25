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
$tedarikci_id = $_POST['tedarikci_id'];

// Silme sorgusu
$sql = "DELETE FROM tedarikciler WHERE tedarikci_id = $tedarikci_id";

if ($conn->query($sql) === TRUE) {
    echo "Tedarikçi başarıyla silindi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>