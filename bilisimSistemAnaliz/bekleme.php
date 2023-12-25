<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYKUTSAN - HOŞGELDİNİZ </title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .loading-container {
            text-align: center;
            flex-direction: column;
        }

        .loading {
            border: 10px solid #f3f3f3;
            border-top: 10px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-top: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .aykutsan-logo {
            max-width: 40%;
            height: auto;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="loading-container">       
        <div class="aykutsan-logo-container">
            <img src="aykutsanBekleme.jpeg" alt="Aykutsan Bekleme" class="aykutsan-logo">
        </div>
        <div class="loading"></div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2500);
    </script>
</body>
</html>
