<?php
include "../assets/koneksi.php";
session_start();
if (!isset($_SESSION['developer'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Back-end Web Application</title>
</head>
<body>
    <div class="container">
        <h2>Back-end Web Application</h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <a class="list-group-item" href="dashboard.php?page=Staf_perpus">Staf Perpustakaan</a>
                    <a class="list-group-item" href="dashboard.php?page=peminjam">Peminjam</a>
                    <a class="list-group-item" href="dashboard.php?page=buku">Buku</a>
                    <a class="list-group-item" href="dashboard.php?page=lembaga">lemabaga</a>
                    <a class="list-group-item" href="logout.php">Logout</a>
                </div>
            </div>
            <div class="col-sm-9">
                <?php
                    switch($_GET['page'] ?? ''){

                        default :
                            include "page/Staf_perpus.php";
                        break;
                        case 'peminjam':
                            include "page/peminjam.php";
                        break;
                        case 'lembaga':
                            include "page/lembaga.php";
                        break;
                        case 'buku':
                            include "page/buku.php";
                        break;
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        ckeditor.replace('editor');
    </script>
</body>
</html>
