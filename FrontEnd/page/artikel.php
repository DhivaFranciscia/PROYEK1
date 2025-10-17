<article class="container">
<?php
    $kode=mysqli_escape_string($koneksi, url_segment(2));
    $query=mysqli_query($koneksi, "SELECT*FROM artikel a
                        INNER JOIN kategori b ON a.kode_kategori=b.kode_kategori
                        ORDER BY a.tgl_artikel DESC");
    while($data=mysqli_fetch_assoc($query)){
?>
    <div class="row">
        <div class="col-sm-4"><img src="<?=base_url()."/img/".$data['gambar_artikel']?>" class="img-responsive"></div>
        <div class="col-sm-8">
            <h2><?=$data['jdl_artikel']?></h2>
            <span class="glyphicon glyphicon-calendar"></span>
                <?=tgljm_full($data['tgl_artikel'])?> WIB
            <span class="glyphicon glyphicon-tag"></span>
                <?=$data['nama_kategori']?>
            <?=potong_text($data['isi_artikel'],500)?>
            <br>
            <a href="<?=base_url()."/read/".$data['id_artikel']."/".$data['jdl_artikel']?>"
                class="btn btn-success">Read More</a>
        </div>
    </div>
    <hr>
<?php
    }
?>
</article>