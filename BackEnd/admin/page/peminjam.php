<?php
include '../assets/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Peminjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Data Peminjam</h3>

<?php
switch ($_GET['action'] ?? '') {
    default:
        // tampilkan data
        $query = "SELECT * FROM peminjam ORDER BY nama_lembaga_pendidikan, nama_peminjam ASC";
        $sql   = mysqli_query($koneksi, $query);

        if (!$sql) {
            echo "<div class='alert alert-danger'>Query gagal: " . mysqli_error($koneksi) . "</div>";
            exit;
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[$row['nama_lembaga_pendidikan']][] = $row;
        }

        echo '<a href="dashboard.php?page=peminjam&action=add" class="btn btn-primary mb-3">
                <span class="bi bi-plus-circle"></span> Tambah Peminjam
              </a>';

        if (count($data) === 0) {
            echo "<div class='alert alert-warning'>Tidak ada data peminjam.</div>";
        } else {
            foreach ($data as $lembaga => $peminjamList) {
                echo "<div class='card mb-4 shadow-sm'>";
                echo "<div class='card-header bg-success text-white fw-bold'>" . htmlspecialchars($lembaga) . "</div>";
                echo "<div class='card-body'>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered table-striped align-middle mb-0'>";
                echo "<thead class='table-dark'>
                        <tr>
                            <th>ID</th>
                            <th>Nama Peminjam</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>";
                echo "<tbody>";
                foreach ($peminjamList as $p) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . htmlspecialchars($p['id_user']) . "</td>";
                    echo "<td>" . htmlspecialchars($p['nama_peminjam']) . "</td>";
                    echo "<td>" . htmlspecialchars($p['email_peminjam']) . "</td>";
                    echo "<td>" . htmlspecialchars($p['password']) . "</td>";
                    echo "<td class='text-center'>
                            <a href='dashboard.php?page=peminjam&action=edit&id=".$p['id_peminjam']."' class='btn btn-sm btn-warning'>
                                <span class='bi bi-pencil'></span>
                            </a>
                            <a href='dashboard.php?page=peminjam&action=hapus&id=".$p['id_peminjam']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus?\")'>
                                <span class='bi bi-trash'></span>
                            </a>
                       <a href='dashboard.php?page=peminjam' class='btn btn-sm btn-secondary'>
                        <i class='bi bi-arrow-clockwise'></i>
                    </a>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody></table></div></div></div>";
            }
        }
        break;

    case 'add':
        ?>
        <form method="POST" action="dashboard.php?page=peminjam&action=save">
            <label>ID:</label>
            <input type="number" name="id_user" class="form-control" required>
            <label>Nama Peminjam:</label>
            <input type="text" name="nama_peminjam" class="form-control" required>
            <label>Email:</label>
            <input type="email" name="email_peminjam" class="form-control" required>
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
            <label>Lembaga Pendidikan:</label>
            <input type="text" name="nama_lembaga_pendidikan" class="form-control" required><br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="dashboard?page=peminjam" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
        break;

    case 'save':
        if (isset($_POST['nama_peminjam'])) {
            $idu      = $_POST['id_user'];           
            $nama     = $_POST['nama_peminjam'];
            $email    = $_POST['email_peminjam'];
            $password = $_POST['password'];
            $lembaga  = $_POST['nama_lembaga_pendidikan'];

            $q = mysqli_query($koneksi, "INSERT INTO peminjam (id_user, nama_peminjam,email_peminjam,password,nama_lembaga_pendidikan)
                                         VALUES ('$idu','$nama','$email','$password','$lembaga')");
            if ($q) {
                echo "<script>document.location='dashboard.php?page=peminjam';</script>";
            } else {
                echo "<script>alert('Gagal simpan'); document.location='dashboard.php?page=peminjam&action=add';</script>";
            }
        }
        break;

    case 'edit':
        $q = mysqli_query($koneksi, "SELECT * FROM peminjam WHERE id_peminjam='".$_GET['id']."'");
        $d = mysqli_fetch_assoc($q);
        ?>
        <form method="POST" action="dashboard.php?page=peminjam&action=update">
             <label>ID:</label>
            <input type="id" name="id_user" class="form-control" required value="<?=$d['id_user']?>">
            <label>Nama Peminjam:</label>
            <input type="text" name="nama_peminjam" class="form-control" required value="<?=$d['nama_peminjam']?>">
            <label>Email:</label>
            <input type="email" name="email_peminjam" class="form-control" required value="<?=$d['email_peminjam']?>">
            <label>Lembaga Pendidikan:</label>
            <input type="text" name="nama_lembaga_pendidikan" class="form-control" required value="<?=$d['nama_lembaga_pendidikan']?>"><br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dashboard.php?page=peminjam" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
        break;

    case 'update':
        if (isset($_POST['nama_peminjam'])) {
            $idu     = $_POST['id_user'];
            $nama    = $_POST['nama_peminjam'];
            $email   = $_POST['email_peminjam'];
            $lembaga = $_POST['nama_lembaga_pendidikan'];

            $q = mysqli_query($koneksi, "UPDATE peminjam SET
                                         id_user='$idu', 
                                         nama_peminjam='$nama',
                                         email_peminjam='$email',
                                         nama_lembaga_pendidikan='$lembaga'
                                         WHERE nama_peminjam='$nama'");
            if ($q) {
                echo "<script>document.location='?page=peminjam';</script>";
            } else {
                echo "<script>alert('Gagal update'); document.location='dashboard.php?page=peminjam&action=edit&id=$id';</script>";
            }
        }
        break;

    case 'hapus':
        $q = mysqli_query($koneksi, "DELETE FROM peminjam WHERE id_peminjam='".$_GET['id']."'");
        if ($q) {
            echo "<script>document.location='dashboard.php?page=peminjam';</script>";
        } else {
            echo "<script>alert('Gagal hapus'); document.location='dashboard.php?page=peminjam';</script>";
        }
        break;
}
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
