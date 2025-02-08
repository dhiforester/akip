<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center">';
        echo '      <b></b>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $kategori=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kategori');
        if($kategori=="desa"){
            $NamaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
        }else{
            if($kategori=="Kecamatan"){
                $NamaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
            }else{
                if($kategori=="Kabupaten"){
                    $NamaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                }else{
                    if($kategori=="propinsi"){
                        $NamaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                    }
                }
            }
        }
?>
    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
    <div class="row">
        <div class="col col-md-12 text-center">
            <b><?php echo "$NamaWilayah"; ?></b>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 text-center">
            <code>Apakah anda yakin akan menghapus data ini?</code>
        </div>
    </div>
<?php 
    }
?>