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

// Veritabanından tedarikciler tablosundan veri çek
$sql = "SELECT tedarikci_id, tedarikci_adi, tedarikci_adresi FROM tedarikciler";
$result = $conn->query($sql);

// Tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Tedarikçi ID</th>
                    <th>Tedarikçi Adı</th>
                    <th>Tedarikçi Adresi</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>
                      <td>' . $row['tedarikci_id'] . '</td>
                      <td>' . $row['tedarikci_adi'] . '</td>
                      <td>' . $row['tedarikci_adresi'] . '</td>
                   </tr>';
    }
} else {
    $table .= '<tr><td colspan="3">Tabloda hiç veri yok.</td></tr>';
}

$table .= '</tbody>
           </table>';

// Veritabanı bağlantısını kapat
$conn->close();

// Oluşturulan tabloyu döndür
?>
