<?php include("oturumKontrol.php"); ?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AYKUTSAN</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css"
      rel="stylesheet"
    />
    <link href="css/styles.css" rel="stylesheet" />
    <script
      src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.php">AYKUTSAN</a>
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Navbar Search-->
      <div
        class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
      ></div>
      <!-- Navbar-->

      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="fas fa-user fa-fw"></i
          ></a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdown"
          >
            <!--  <li><a class="dropdown-item" href="#!">Settings</a></li>-->
            <!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li>-->
            <li class="dropdown-header"> <?php echo $yonetici_adi; ?></li>
            <li><a class="dropdown-item" href="cikisYap.php">Çıkış Yap</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <?php
include("02_baglan.php");

// Veritabanı sorgusu
$query = "SELECT kategoriler.kategori_id, kategoriler.kategori_adi, COUNT(urunler.urun_id) as UrunSayisi 
          FROM Kategoriler 
          LEFT JOIN Urunler ON kategoriler.kategori_id = urunler.kategori_id 
          GROUP BY kategoriler.kategori_id, kategoriler.kategori_adi";

$result = $conn->query($query);
if (!$result) {
    die("Veritabanı sorgu hatası: " . $conn->error);
}

// Verileri işleme
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Verileri JavaScript tarafına aktarma
echo '<script>';
echo 'var chartData = ' . json_encode($data) . ';';
echo '</script>';
?>

  <?php
include("02_baglan.php");

// Veritabanı sorgusu
$query = "SELECT depolar.depo_id, depolar.depo_adi, SUM(stok.miktar) as ToplamMiktar 
          FROM depolar 
          LEFT JOIN stok ON depolar.depo_id = stok.depo_id 
          GROUP BY depolar.depo_id, depolar.depo_adi";

$result = $conn->query($query);
if (!$result) {
    die("Veritabanı sorgu hatası: " . $conn->error);
}

// Verileri işleme
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Verileri JavaScript tarafına aktarma
echo '<script>';
echo 'var chartDataDepo = ' . json_encode($data) . ';';
echo '</script>';
?>


    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Gösterge Paneli
              </a>
              <a class="nav-link" href="stokHareketleriListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-cubes"></i>
                </div>
                Stok Hareketleri
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Depo Listele
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="depo1.php">
                                        <div class="sb-nav-link-icon"><i class="fa fa-align-left"></i></div>
                                        Depo 1
                                    </a>
                                    <a class="nav-link" href="depo2.php">
                                        <div class="sb-nav-link-icon"><i class="fa fa-align-left"></i></div>
                                        Depo 2
                                    </a>
                                    <a class="nav-link" href="depo3.php">
                                        <div class="sb-nav-link-icon"><i class="fa fa-align-left"></i></div>
                                        Depo 3
                                    </a>
                            
                            </nav>
                        </div>
              <div class="sb-sidenav-menu-heading">Düzenleme İşlemleri</div>
              <a class="nav-link" href="urunDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-exchange"></i>
                </div>
                Ürün Düzenle</a
              >
              <a class="nav-link" href="tedarikciDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-briefcase"></i>
                </div>
                Tedarikçi Düzenle</a
              >
              <a class="nav-link" href="kategoriDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-sitemap"></i>
                </div>
                Kategori Düzenle</a
              >
              <a class="nav-link" href="yoneticiDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-briefcase"></i>
                </div>
                Yönetici Düzenle</a
              >
              <a class="nav-link" href="depoDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-sitemap"></i>
                </div>
                Depo Düzenle</a
              >
              <a class="nav-link" href="stokDuzenleSayfa.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-sitemap"></i>
                </div>
                Stok Düzenle
              </a>
              <div
                class="collapse"
                id="collapsePages"
                aria-labelledby="headingTwo"
                data-bs-parent="#sidenavAccordion"
              ></div>
              <div class="sb-sidenav-menu-heading">Tablolar</div>
              <a class="nav-link" href="urunListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-align-left"></i>
                </div>
                Ürün Listele
              </a>
              <a class="nav-link" href="tedarikciListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-align-left"></i>
                </div>
                Tedarikçi Listele
              </a>
              <a class="nav-link" href="depoListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-align-left"></i>
                </div>
                Depo Listele
              </a>
              <a class="nav-link" href="yoneticiListele.php">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Yönetici Listele
              </a>
              <a class="nav-link" href="kategoriListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-align-left"></i>
                </div>
                Kategori Listele
              </a>
              <a class="nav-link" href="stokListele.php">
                <div class="sb-nav-link-icon">
                  <i class="fa fa-align-left"></i>
                </div>
                Stok Listele
              </a>
            </div>
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Gösterge Paneli</h1>
            <div class="row">
            <div class="col-xl-5 mb-4">
              <div class="card">
                <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Kategorilerdeki Toplam Ürün Sayısı
                </div>
                <canvas id="myChart"></canvas>
              </div>
            </div>
            <div class="col-xl-1 mb-4"></div>
            <div class="col-xl-4 mb-4">
              <div class="card">
                <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Depolardaki Toplam Ürün Miktarı
                </div>
                <canvas id="myChart2"></canvas>
              </div>
            </div>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div
              class="d-flex align-items-center justify-content-between small"
            >
              <div class="text-muted">Copyright &copy;AYKUTSAN</div>
            </div>
          </div>
        </footer>
      </div>
    </div>
              

    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(item => item.kategori_adi),
            datasets: [{
                label: 'Ürün Sayısı',
                data: chartData.map(item => item.UrunSayisi),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',  // Kırmızı
                    'rgba(54, 162, 235, 0.2)', // Mavi
                    'rgba(255, 206, 86, 0.2)', // Sarı
                    'rgba(75, 192, 192, 0.2)', // Yeşil
                    'rgba(153, 102, 255, 0.2)' // Mor
                    // İstediğiniz kadar renk ekleyebilirsiniz
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: chartDataDepo.map(item => item.depo_adi),
            datasets: [{
                label: 'Toplam Miktar',
                data: chartDataDepo.map(item => item.ToplamMiktar),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',  // Kırmızı
                    'rgba(54, 162, 235, 0.2)', // Mavi
                    'rgba(255, 206, 86, 0.2)', // Sarı
                    'rgba(75, 192, 192, 0.2)', // Yeşil
                    'rgba(153, 102, 255, 0.2)' // Mor
                    // İstediğiniz kadar renk ekleyebilirsiniz
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/scripts.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/datatables-simple-demo.js"></script>
  </body>
</html>
