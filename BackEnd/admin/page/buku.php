<?php
include '../assets/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Buku per Lembaga Pendidikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="mb-4">Data Buku per Lembaga Pendidikan</h3>

<?php
switch ($_GET['action'] ?? '') {
    default:
        // tampilkan data
        $query = "SELECT b.*, l.nama_lembaga
            FROM buku b
            JOIN lembaga l ON b.id_lembaga = l.id_lembaga
            ORDER BY l.nama_lembaga, b.judul_buku ASC";
        $sql = mysqli_query($koneksi, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[$row['nama_lembaga']][] = $row;
        }

        echo '<a href="dashboard.php?page=buku&action=add" class="btn btn-primary mb-3">
                <span class="bi bi-plus-circle"></span> Tambah Buku
             </a>';

        if (count($data) === 0) {
            echo "<div class='alert alert-warning'>Tidak ada data buku.</div>";
        } else {
            foreach ($data as $lembaga => $bukuList) {
                echo "<div class='card mb-4 shadow-sm'>";
                echo "<div class='card-header bg-primary text-white fw-bold'>" . htmlspecialchars($lembaga) . "</div>";
                echo "<div class='card-body'>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered table-striped align-middle mb-0'>";
                echo "<thead class='table-dark'>
                        <tr>
                            <th>Kode</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Sinopsis</th>
                            <th style='width:90px'>Stok</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>";
                echo "<tbody>";
                foreach ($bukuList as $b) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($b['kode_buku']) . "</td>";
                    echo "<td>" . htmlspecialchars($b['judul_buku']) . "</td>";
                    echo "<td>" . htmlspecialchars($b['penulis_buku']) . "</td>";
                    echo "<td>" . htmlspecialchars($b['penerbit_buku']) . "</td>";
                    echo "<td>" . nl2br(htmlspecialchars($b['sinopsis_buku'])) . "</td>";
                    echo "<td class='text-center'>" . htmlspecialchars($b['stok_buku']) . "</td>";
                    echo "<td class='text-center'>
                        <a href=\"dashboard.php?page=buku&action=edit&id=".$b['kode_buku']."\" class=\"btn btn-sm btn-warning\">
                            <span class='bi bi-pencil'></span></a>
                        <a href=\"dashboard.php?page=buku&action=hapus&id=".$b['kode_buku']."\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Yakin hapus?')\">
                            <span class='bi bi-trash'></span></a>
                        <a href=\"dashboard.php?page=buku\" class=\"btn btn-sm btn-secondary\">
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
        <form method="POST" action="dashboard.php?page=buku&action=save">
            <label>Kode:</label>
            <input type="text" name="kode_buku" class="form-control" required>
            <label>Judul Buku:</label>
            <input type="text" name="judul_buku" class="form-control" required>
            <label>Penulis:</label>
            <input type="text" name="penulis_buku" class="form-control" required>
            <label>Penerbit:</label>
            <input type="text" name="penerbit_buku" class="form-control" required>            
            <label>Sinopsis:</label>
            <textarea name="sinopsis_buku" class="form-control" required></textarea>
            <label>Stok:</label>
            <input type="number" name="stok_buku" class="form-control" required>
            <label>Id lembaga:</label>
            <input type="number" name="id_lembaga" class="form-control" required><br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="dashboard.php?page=buku" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
        break;

    case 'save':
        if (isset($_POST['kode_buku'])) {
            $kode     = $_POST['kode_buku'];
            $judul    = $_POST['judul_buku'];
            $penulis  = $_POST['penulis_buku'];
            $penerbit = $_POST['penerbit_buku'];
            $sinopsis = $_POST['sinopsis_buku'];
            $stok     = $_POST['stok_buku'];
            $lembaga  = $_POST['id_lembaga'];

            $q = mysqli_query($koneksi, "INSERT INTO buku (kode_buku, judul_buku, penulis_buku, penerbit_buku, sinopsis_buku, stok_buku, id_lembaga)
                                         VALUES ('$kode','$judul','$penulis','$penerbit','$sinopsis','$stok', '$lembaga')");
            if ($q) {
                echo "<script>document.location='dashboard.php?page=buku';</script>";
            } else {
                echo "<script>alert('Gagal simpan'); document.location='dashboard.php?page=buku&action=add';</script>";
            }
        }
        break;

    case 'edit':
        $q = mysqli_query($koneksi, "SELECT * FROM buku WHERE kode_buku='".$_GET['id']."'");
        $d = mysqli_fetch_assoc($q);
        if (!$d) {
            echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
            break;
        }
        ?>
        <form method="POST" action="dashboard.php?page=buku&action=update">
            <input type="hidden" name="kode_buku" value="<?=$d['kode_buku']?>">
            <label>Judul Buku:</label>
            <input type="text" name="judul_buku" class="form-control" required value="<?=$d['judul_buku']?>">
            <label>Penulis:</label>
            <input type="text" name="penulis_buku" class="form-control" required value="<?=$d['penulis_buku']?>">
            <label>Penerbit:</label>
            <input type="text" name="penerbit_buku" class="form-control" required value="<?=$d['penerbit_buku']?>">
            <label>Sinopsis:</label>
            <textarea name="sinopsis_buku" class="form-control" required><?=$d['sinopsis_buku']?></textarea>
            <label>Stok:</label>
            <input type="number" name="stok_buku" class="form-control" required value="<?=$d['stok_buku']?>"><br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="dashboard.php?page=buku" class="btn btn-secondary">Kembali</a>
        </form>
        <?php
        break;

    case 'update':
        if (isset($_POST['kode_buku'])) {
            $kode     = $_POST['kode_buku'];
            $judul    = $_POST['judul_buku'];
            $penulis  = $_POST['penulis_buku'];
            $penerbit = $_POST['penerbit_buku'];
            $sinopsis = $_POST['sinopsis_buku'];
            $stok     = $_POST['stok_buku'];

            $q = mysqli_query($koneksi, "UPDATE buku SET 
                                         judul_buku='$judul',
                                         penulis_buku='$penulis',
                                         penerbit_buku='$penerbit',
                                         sinopsis_buku='$sinopsis',
                                         stok_buku='$stok'
                                         WHERE kode_buku='$kode'");
            if ($q) {
                echo "<script>document.location='dashboard.php?page=buku';</script>";
            } else {
                echo "<script>alert('Gagal update'); document.location='dashboard.php?page=buku&action=edit&id=$kode';</script>";
            }
        }
        break;

    case 'hapus':
        $q = mysqli_query($koneksi, "DELETE FROM buku WHERE kode_buku='".$_GET['id']."'");
        if ($q) {
            echo "<script>document.location='dashboard.php?page=buku';</script>";
        } else {
            echo "<script>alert('Gagal hapus'); document.location='dashboard.php?page=buku';</script>";
        }
        break;
}
?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
