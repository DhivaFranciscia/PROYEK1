<?php
switch($_GET['action']){
    default:
    ?>
    <table class="table table-bordered table-striped">
    <thead>
        <th>No.</th>
        <th>Kode</th>
        <th>Kategori</th>
        <th><a href="index.php?page=kategori&action=add" class="btn btn-sm btn-primary">
            <span class="glyphicon glyphicon-plus"></span>Add</a></th>
    </thead>
    <tbody>
        <?php
            $query=mysqli_query($koneksi,"SELECT * FROM kategori 
                                ORDER BY urut_kategori ASC");
            while($data=mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?=$data['urut_kategori'];?></td>
            <td><?=$data['kode_kategori'];?></td>
            <td><?=$data['nama_kategori'];?></td>
            <td>
                <a href="index.php?page=kategori&action=edit&id=<?=$data['kode_kategori'];?>"
                class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="index.php?page=kategori&action=hapus&id=<?=$data['kode_kategori'];?>"
                class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
    </table>
        <?php
        break;

        case 'add':
            ?>
            <form method="POST" action="index.php?page=kategori&action=save">
                <label>Nomor Urut:</label>
                <input type="number" name="nomor" class="form-control" required="true">
                <label>Kode:</label>
                <input type="text" name="kode" class="form-control" required="true">
                <label>Nama Kategori:</label>
                <input type="text" name="nama" class="form-control" required="true"><br>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
                <a href="index.php?page=kategori" class="btn btn-default">KEMBALI</a>
            </form>
            <?php
        break;

        case 'save':
            if(isset($_POST['kode'])){
                $kode = $_POST['kode'];
                $nama = $_POST['nama'];
                $nomor = $_POST['nomor'];
                $query = mysqli_query($koneksi, "INSERT INTO kategori 
                                (kode_kategori, nama_kategori, urut_kategori)
                                VALUES ('".$kode."', '".$nama."', '".$nomor."')");
                
                if($query){
                    echo "<script> document.location='index.php?page=kategori'; </script>";
                }else{
                    echo "<script> alert('Gagal menyimpan kategori'); 
                           document.location='index.php?page=kategori&action=add'; </script>";
                }
            }
        break;

        case 'edit':
            $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kode_kategori='".$_GET['id']."'");
            $data = mysqli_fetch_assoc($query);
        ?>
            <form method="POST" action="index.php?page=kategori&action=update">
                <input type="hidden" name="id" value="<?=$data['kode_kategori']?>">
                <label>Nomor Urut:</label>
                <input type="number" name="nomor" class="form-control" required="true" value="<?=$data['urut_kategori']?>" disabled="true">
                <label>Kode Kategori:</label>
                <input type="text" name="kode" class="form-control" required="true" value="<?=$data['kode_kategori']?>" disabled="true">
                <label>Nama Kategori:</label>
                <input type="text" name="nama" class="form-control" required="true" value="<?=$data['nama_kategori']?>"><br>
                <button type="submit" class="btn btn-primary">UPDATE</button>
                <a href="index.php?page=kategori" class="btn btn-default">KEMBALI</a>
            </form>
        <?php
        break;

        case 'update':
            if(isset($_POST['id'])){
                $nama = $_POST['nama'];
                $nomor = $_POST['nomor'];
                $query = mysqli_query($koneksi, "UPDATE kategori SET 
                            nama_kategori='".$nama."', 
                            urut_kategori='".$nomor."'
                            WHERE kode_kategori='".$_POST['id']."'");
                
                if($query){
                    echo "<script> document.location='index.php?page=kategori'; </script>";
                }else{
                    echo "<script> alert('Gagal mengupdate kategori'); 
                           document.location='index.php?page=kategori&action=edit&id=".$_POST['id']."'; </script>";
                }
            }    
        break;

        case 'hapus':
            $query = mysqli_query($koneksi, "DELETE FROM kategori WHERE kode_kategori='".$_GET['id']."'");
            if($query){
                echo "<script> document.location='index.php?page=kategori'; </script>";
            }else{
                echo "<script> alert('Gagal menghapus kategori'); document.location='index.php?page=kategori'; </script>";
            }
        break;
}