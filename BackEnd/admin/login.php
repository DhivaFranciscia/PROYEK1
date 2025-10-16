<?php
session_start();
include "../assets/koneksi.php";

// kalau sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['developer'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $nama     = $_POST['nama'];
    $password = $_POST['password'];

    // cek user di database
    $query  = mysqli_query($koneksi, "SELECT * FROM developer WHERE nama='$nama' AND password='$password'");
    $cekdev = mysqli_num_rows($query);

    if ($cekdev > 0) {
        $data = mysqli_fetch_assoc($query);

        // simpan session
        $_SESSION['developer'] = $data['nama'];
        $_SESSION['id_dev']    = $data['id']; // kalau ada kolom id

        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Nama atau Password salah');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100"> <div class="card shadow p-4" style="width: 350px;"> <h3 class="text-center mb-3">Login</h3> <form method="post">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
