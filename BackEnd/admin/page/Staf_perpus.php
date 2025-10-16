<?php
include "../assets/koneksi.php";

switch($_GET['action'] ?? ''){


    default:
        ?>
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Staf Perpustakaan</h4>
                <div>
                    <a href="dashboard.php?page=Staf_perpus&action=add" class="btn btn-sm btn-light text-primary">
                        <span class="bi bi-plus-circle"></span> Tambah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>NIP</th>
                                <th>Nama Staf</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Lembaga Pendidikan</th>
                                <th>NPSN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM staf_perpus ORDER BY id ASC");
                            while($row = mysqli_fetch_assoc($query)){
                            ?>
                                <tr>
                                    <td class="text-center"><?= $row['nip']; ?></td>
                                    <td><?= $row['nama_staf']; ?></td>
                                    <td><?= $row['email_staf']; ?></td>
                                    <td><?= $row['password']; ?></td>
                                    <td><?= $row['nama_lembaga_pendidikan']; ?></td>
                                    <td><?= $row['NPSN']; ?></td>
                                    <td class="text-center">
                                        <a href="dashboard.php?page=Staf_perpus&action=edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">
                                            <span class="bi bi-pencil"></span>
                                        </a>
                                        <a href="dashboard.php?page=Staf_perpus&action=reset&id=<?= $row['id']; ?>" class="btn btn-sm btn-secondary">
                                            <span class="bi bi-arrow-clockwise"></span>
                                        </a>
                                        <a href="dashboard.php?page=Staf_perpus&action=hapus&id=<?= $row['id']; ?>" 
                                           onclick="return confirm('Yakin hapus data ini?');"
                                           class="btn btn-sm btn-danger">
                                            <span class="bi bi-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        break;

    case 'add':
        ?>
        <form method="POST" action="dashboard.php?page=Staf_perpus&action=save">
            <label>NIP:</label>
            <input type="text" name="nip" class="form-control" required>
            <label>Nama Staf:</label>
            <input type="text" name="nama_staf" class="form-control" required>
            <label>Email:</label>
            <input type="email" name="email_staf" class="form-control" required>
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
            <label>Lembaga Pendidikan:</label>
            <input type="text" name="nama_lembaga_pendidikan" class="form-control" required>
            <label>NPSN:</label>
            <input type="number" name="NPSN" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <a href="dashboard.php?page=Staf_perpus" class="btn btn-default">KEMBALI</a>
        </form>
        <?php
        break;

    case 'save':
        if (isset($_POST['nip'])) {
            $nip     = $_POST['nip'];
            $nama    = $_POST['nama_staf'];
            $email   = $_POST['email_staf'];
            $pass    = $_POST['password'];
            $lembaga = $_POST['nama_lembaga_pendidikan'];
            $NPSN    = $_POST['NPSN'];

            $sql = "INSERT INTO staf_perpus 
                    (nip, nama_staf, email_staf, password, nama_lembaga_pendidikan, NPSN) 
                    VALUES ('$nip', '$nama', '$email', '$pass', '$lembaga', '$NPSN')";
            $query = mysqli_query($koneksi, $sql);

            if ($query) {
                echo "<script>document.location='dashboard.php?page=Staf_perpus';</script>";
            } else {
                echo "<script>alert('Gagal simpan: " . mysqli_error($koneksi) . "'); 
                      document.location='dashboard.php?page=Staf_perpus&action=add';</script>";
            }
        }
        break;

    case 'edit':
        if (isset($_GET['id'])) {
            $q = mysqli_query($koneksi, "SELECT * FROM staf_perpus WHERE id='" . $_GET['id'] . "'") 
                 or die("SQL Error: " . mysqli_error($koneksi));
            $data = mysqli_fetch_assoc($q);

            if ($data) {
                ?>
                <form method="POST" action="dashboard.php?page=Staf_perpus&action=update">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">

                    <label>NIP:</label>
                    <input type="number" name="nip" class="form-control" required value="<?= $data['nip']; ?>">

                    <label>Nama Staf:</label>
                    <input type="text" name="nama_staf" class="form-control" required value="<?= $data['nama_staf']; ?>">

                    <label>Email:</label>
                    <input type="email" name="email_staf" class="form-control" required value="<?= $data['email_staf']; ?>">

                    <label>Lembaga Pendidikan:</label>
                    <input type="text" name="nama_lembaga_pendidikan" class="form-control" required value="<?= $data['nama_lembaga_pendidikan']; ?>">

                    <label>NPSN:</label>
                    <input type="text" name="NPSN" class="form-control" required value="<?= $data['NPSN']; ?>"><br>

                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <a href="dashboard.php?page=Staf_perpus" class="btn btn-default">KEMBALI</a>
                </form>
                <?php
            } else {
                echo "<p class='text-danger'>Data tidak ditemukan!</p>";
            }
        } else {
            echo "<p class='text-danger'>ID tidak diberikan!</p>";
        }
        break;


    case 'update':
        if (isset($_POST['id'])) {
            $id      = $_POST['id'];
            $nip     = $_POST['nip'];
            $nama    = $_POST['nama_staf'];
            $email   = $_POST['email_staf'];
            $lembaga = $_POST['nama_lembaga_pendidikan'];
            $NPSN    = $_POST['NPSN'];

            $q = mysqli_query($koneksi, "UPDATE staf_perpus 
                                         SET nip='$nip', 
                                             nama_staf='$nama', 
                                             email_staf='$email', 
                                             nama_lembaga_pendidikan='$lembaga', 
                                             NPSN='$NPSN' 
                                         WHERE id='$id'");

            if ($q) {
                echo "<script>document.location='dashboard.php?page=Staf_perpus';</script>";
            } else {
                echo "<script>alert('Gagal update: ".mysqli_error($koneksi)."'); 
                      document.location='dashboard.php?page=Staf_perpus&action=edit&id=$id';</script>";
            }
        }
        break;

    case 'hapus':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $q = mysqli_query($koneksi, "DELETE FROM staf_perpus WHERE id='$id'");

            if ($q) {
                echo "<script>alert('Data berhasil dihapus'); 
                      document.location='dashboard.php?page=Staf_perpus';</script>";
            } else {
                echo "<script>alert('Gagal menghapus data'); 
                      document.location='dashboard.php?page=Staf_perpus';</script>";
            }
        }
        break;
}
?>
