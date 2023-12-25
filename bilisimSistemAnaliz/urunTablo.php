<?php
include "02_baglan.php";
// Veritabanından urunler tablosundan veri çek
$sql = "SELECT urunler.urun_id, urunler.urun_adi, kategoriler.kategori_adi, urunler.birim_fiyat, tedarikciler.tedarikci_adi 
        FROM urunler
        INNER JOIN kategoriler ON urunler.kategori_id = kategoriler.kategori_id
        INNER JOIN tedarikciler ON urunler.tedarikci_id = tedarikciler.tedarikci_id";
$result = $conn->query($sql);

// Veritabanı sorgusundan gelen verileri kullanarak tabloyu oluştur
$table = '<table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Ürün ID</th>
                    <th>Ürün Adı</th>
                    <th>Kategori Adı</th>
                    <th>Birim Fiyat</th>
                    <th>Tedarikçi Adı</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    // Veritabanından gelen her bir satır için tabloya bir satır ekleyin
    while ($row = $result->fetch_assoc()) {
        $table .= '<tr>
                      <td>' . $row['urun_id'] . '</td>
                      <td>' . $row['urun_adi'] . '</td>
                      <td>' . $row['kategori_adi'] . '</td>
                      <td>' . $row['birim_fiyat'] . '</td>
                      <td>' . $row['tedarikci_adi'] . '</td>
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
