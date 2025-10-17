<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $pesan  = mysqli_real_escape_string($koneksi, $_POST['pesan']);
    $query = "INSERT INTO kontak (nama_lengkap, email, alamat, pesan) 
              VALUES ('$nama', '$email', '$alamat', '$pesan')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pesan berhasil dikirim'); window.location='kontak.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
        <div class="container mt-5">            
            <h2>Form kontak</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat:</label>
                    <input type="text" name="alamat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Pesan:</label>
                    <textarea name="pesan" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
