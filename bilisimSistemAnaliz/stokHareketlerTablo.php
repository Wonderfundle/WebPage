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

// Veritabanından stok hareketleri tablosundan veri çek
$sql = "SELECT sh.hareket_id, u.urun_adi, d.depo_adi, sh.miktar, sh.hareket_tarihi, sh.hareket_turu 
        FROM stok_hareketleri sh
        LEFT JOIN urunler u ON sh.urun_id = u.urun_id
        LEFT JOIN depolar d ON sh.depo_id = d.depo_id";
$result = $conn->query($sql);

// Tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Hareket ID</th>
                    <th>Ürün Adı</th>
                    <th>Depo Adı</th>
                    <th>Miktar</th>
                    <th>Hareket Tarihi</th>
                    <th>Hareket Türü</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>
                      <td>' . $row['hareket_id'] . '</td>
                      <td>' . $row['urun_adi'] . '</td>
                      <td>' . $row['depo_adi'] . '</td>
                      <td>' . $row['miktar'] . '</td>
                      <td>' . $row['hareket_tarihi'] . '</td>
                      <td>' . $row['hareket_turu'] . '</td>
                   </tr>';
    }
} else {
    $table .= '<tr><td colspan="6">Tabloda hiç veri yok.</td></tr>';
}

$table .= '</tbody>
           </table>';

// Veritabanı bağlantısını kapat
$conn->close();

// Oluşturulan tabloyu döndür
?>
