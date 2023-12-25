<?php
include "02_baglan.php";
// Veritabanından urunler tablosundan veri çek
$sql = "SELECT depo_id, depo_adi FROM depolar";
$result = $conn->query($sql);
// Veritabanı sorgusundan gelen verileri kullanarak tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Depo ID</th>
                    <th>Depo Adı</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>
                      <td>' . $row['depo_id'] . '</td>
                      <td>' . $row['depo_adi'] . '</td>
                   </tr>';
    }
} else {
    $table .= '<tr><td colspan="5">Tabloda hiç veri yok.</td></tr>';
}

$table .= '</tbody>
           </table>';

// Veritabanı bağlantısını kapat
$conn->close();

// Oluşturulan tabloyu döndür
?>