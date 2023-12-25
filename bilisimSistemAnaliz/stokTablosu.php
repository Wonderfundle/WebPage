<?php
include "02_baglan.php";

// Veritabanından urunler ve depolar tablolarından veri çek
$sql = "SELECT urunler.urun_adi, depolar.depo_adi, stok.miktar
        FROM stok
        INNER JOIN urunler ON stok.urun_id = urunler.urun_id 
        INNER JOIN depolar ON stok.depo_id = depolar.depo_id ";
$result = $conn->query($sql);

// Veritabanı sorgusundan gelen verileri kullanarak tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Miktar</th>
                    <th>Depo Adı</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>
                      <td>' . $row['urun_adi'] . '</td>
                      <td>' . $row['miktar'] . '</td>
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

?>
