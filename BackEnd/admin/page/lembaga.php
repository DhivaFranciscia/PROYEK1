<?php
include "../assets/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM lembaga ORDER BY id_lembaga ASC");
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Lembaga Pendidikan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 80px;">Id </th>
                        <th>Nama Lembaga Pendidikan</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td class="text-center"><?= $row['id_lembaga'] ?? ''; ?></td>
                            <td><?= $row['nama_lembaga'] ?? ''; ?></td>
                            <td><?= $row['alamat'] ?? ''; ?></td>
                            <td><?= $row['email'] ?? ''; ?></td>
                <td>
                     <a href="index.php?page=admin&action=edit&id=<?= $data['nama_lembaga']; ?>" 
                        class="btn btn-sm btn-warning"><span class="bi bi-pencil"></span>
                    </a>
                    <a href="index.php?page=admin&action=reset&id=<?= $data['nama_lembaga']; ?>"
                        class="btn btn-sm btn-default"><span class="bi bi-arrow-clockwise"></span>
                    </a>
                    <a href="index.php?page=admin&action=hapus&id=<?= $data['nama_lembaga']; ?>" 
                        class="btn btn-sm btn-danger"><span class="bi bi-trash"></span>
                    </a>
                </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
