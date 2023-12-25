<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AYKUTSAN - Giriş</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <?php
    include("02_baglan.php");
    // Yönetici adlarını çek
    $sql = "SELECT yonetici_id, yonetici_adi FROM yoneticiler";
    $result = $conn->query($sql);
    ?>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="my-4"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                            <img src="aykutsanGiris.jpg" alt="Aykutsan Logo" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
                            <div class="mt-4"></div>
                                <form action="kontrol.php" method="post">
                                    <div class="form-floating mb-3">                                    
                                        <select class="form-control" id="yoneticiID" name="yoneticiAdi">
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row['yonetici_id'] . '">' . $row['yonetici_adi'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            class="form-control"
                                            id="sifre"
                                            name="sifre"
                                            type="password"
                                            placeholder="Password"
                                        />
                                        <label for="sifre">Şifre</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; AYKUTSAN</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
