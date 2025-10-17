<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php
            $num=0;
            $query=mysqli_query($koneksi, "SELECT*FROM artikel
                                            ORDER BY tgl_artikel DESC
                                            LIMIT 0,4");
            while($data=mysqli_fetch_assoc($query)){
                if($num == "0"){$class="active";}
                else{$class="";}
        ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?=$num?>" class="<?=$class?>"></li>
        <?php
            $num++;
            }
        ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php
            $num=0;
            $query=mysqli_query($koneksi, "SELECT*FROM artikel
                                            ORDER BY tgl_artikel DESC
                                            LIMIT 0,4");
            while($data=mysqli_fetch_assoc($query)){
                if($num == "0"){$class="active";}
                else{$class="";}
        ?>
        <a href="<?=base_url()."/read/".$data['id_artikel']."/".$data['jdl_artikel']?>"
            class="item <?=$class?>">
        <img src="<?=base_url()."/img/".$data['gambar_artikel']?>">
        </div>
        </a>
        <?php
            $num++;
            }
        ?>
    </div>
</div>