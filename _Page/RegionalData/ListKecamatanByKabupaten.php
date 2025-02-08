<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(!empty($_POST['id_wilayah'])){
        $id_wilayah=$_POST['id_wilayah'];
        $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
?>
<ul>
    <?php
        //Menampilkan Kabupaten
        $JumlahKecamatan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$kabupaten'"));
        if(!empty($JumlahKecamatan)){
            $no=1;
            $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$kabupaten' ORDER BY kecamatan ASC");
            while ($data = mysqli_fetch_array($query)) {
                $IdWilayahKecamatan= $data['id_wilayah'];
                $kecamatan= $data['kecamatan'];
                echo '<li class="mb-2">';
                echo '  <a href="javascript:void(0);" class="text-info ClickKecamatan" value="'.$IdWilayahKecamatan.'">'.$kecamatan.'</a><code>('.$IdWilayahKecamatan.') </code><br>';
                echo '  <div id="ListDesaByKecamatan'.$IdWilayahKecamatan.'"></div>';
                echo '</li>';
                $no++;
            }
        }
    ?>
</ul>
<script>
    $(".ClickKecamatan").click(function() {
        var id_wilayah = $(this).attr('value');
        $('#ListDesaByKecamatan'+id_wilayah+'').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/RegionalData/ListDesaByKecamatan.php',
            data        : {id_wilayah: id_wilayah},
            success     : function(data){
                $('#ListDesaByKecamatan'+id_wilayah+'').html(data);
            }
        });
    });
</script>
<?php } ?>