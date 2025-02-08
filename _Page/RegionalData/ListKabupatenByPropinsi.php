<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_wilayah'])){
        $id_wilayah=$_POST['id_wilayah'];
        $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
?>
<ul>
    <?php
        //Menampilkan Kabupaten
        $JumlahKabupaten = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kabupaten' AND propinsi='$propinsi'"));
        if(!empty($JumlahKabupaten)){
            $no=1;
            $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kabupaten' AND propinsi='$propinsi' ORDER BY kabupaten ASC");
            while ($data = mysqli_fetch_array($query)) {
                $IdWilayahKabupaten= $data['id_wilayah'];
                $kabupaten= $data['kabupaten'];
                echo '<li class="mb-2">';
                echo '  <a href="javascript:void(0);" class="ClickKabupaten" value="'.$IdWilayahKabupaten.'">'.$kabupaten.'</a><code>('.$IdWilayahKabupaten.') </code><br>';
                echo '  <div id="ListKecamatanByKabupaten'.$IdWilayahKabupaten.'"></div>';
                echo '</li>';
                $no++;
            }
        }
    ?>
</ul>
<script>
    $(".ClickKabupaten").click(function() {
        var id_wilayah = $(this).attr('value');
        $('#ListKecamatanByKabupaten'+id_wilayah+'').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/RegionalData/ListKecamatanByKabupaten.php',
            data        : {id_wilayah: id_wilayah},
            success     : function(data){
                $('#ListKecamatanByKabupaten'+id_wilayah+'').html(data);
            }
        });
    });
</script>
<?php } ?>