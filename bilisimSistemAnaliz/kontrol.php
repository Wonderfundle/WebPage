<?php
session_start();

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bilisimDeneme";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Formdan gelen verileri al
$yoneticiID = $_POST['yoneticiAdi']; // Düzeltildi: yoneticiID -> yoneticiAdi

// Veritabanında kullanıcı adını ara
$sql = "SELECT yonetici_id, yonetici_adi, sifre FROM yoneticiler WHERE yonetici_id = '$yoneticiID'"; // Düzeltildi: yoneticiId -> yoneticiID
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Kullanıcı bulundu, şifreyi kontrol et
    $row = $result->fetch_assoc();
    $yoneticiAdi = $row['yonetici_adi'];
    $sifre = $row['sifre'];

    if ($_POST['sifre'] == $sifre) {
        // Şifre doğru, oturumu başlat
        $_SESSION['yonetici_adi'] = $yoneticiAdi;
        echo "Başarıyla giriş yapıldı. Yönlendiriliyorsunuz...";
        header("Location: bekleme.php"); // index.php yerine yönlendirmek istediğiniz sayfanın adını kullanın
        exit();
    } else {
        // Hatalı şifre durumu
        echo "Yanlış şifre. Tekrar deneyin.";
    }
} else {
    // Kullanıcı bulunamadı
    echo "Yanlış kullanıcı adı. Tekrar deneyin.";
}

$conn->close();
?>
