<?php
include "02_baglan.php";
// Veritabanından yoneticiler tablosundan veri çek
$sql = "SELECT yonetici_id, yonetici_adi, sifre FROM yoneticiler";
$result = $conn->query($sql);

// Veritabanı sorgusundan gelen verileri kullanarak tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Yönetici ID</th>
                    <th>Yönetici Adı</th>
                    <th>Yönetici Şifresi</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $passwordStars = str_repeat('*', strlen($row['sifre']));
        $table .= '<tr>
                      <td>' . $row['yonetici_id'] . '</td>
                      <td>' . $row['yonetici_adi'] . '</td>
                      <td><span class="password-mask">' . $passwordStars . '</span></td>
                   </tr>';
    }
} else {
    $table .= '<tr><td colspan="4">Tabloda hiç veri yok.</td></tr>';
}

$table .= '</tbody>
           </table>';

// Veritabanı bağlantısını kapat
$conn->close();

// Oluşturulan tabloyu döndür
?>

<style>
    .password-mask {
        color: transparent;
        text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    }
</style>