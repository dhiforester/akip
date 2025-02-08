<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_kriteria_indikator
    if(empty($_POST['id_kriteria_indikator'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Kriteria & Indikator Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
        $level=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'level');
        $teks=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'teks');
        $alternatif=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'alternatif');
        $bobot=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'bobot');
        $keterangan=getDataDetail($Conn,'kriteria_indikator','id_kriteria_indikator',$id_kriteria_indikator,'keterangan');
?>
    <input type="hidden" name="id_kriteria_indikator" value="<?php echo "$id_kriteria_indikator"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <b>Kriteria/Indikator</b>
        </div>
        <div class="col-md-12">
            <small class="credit text-grayish"><?php echo $teks; ?></small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <b>Parameter Lampiran</b>
        </div>
        <div class="col-md-12">
            <ol>
                <?php
                    //Arraykan Parameter
                    $query = mysqli_query($Conn, "SELECT * FROM referensi_bukti ORDER BY id_referensi_bukti ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_referensi_bukti= $data['id_referensi_bukti'];
                        $nama_bukti= $data['nama_bukti'];
                        //Cek apakah data ada pada relasi
                        $QryCek = mysqli_query($Conn,"SELECT * FROM kriteria_indikator_ref WHERE id_referensi_bukti='$id_referensi_bukti' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                        $DataCek = mysqli_fetch_array($QryCek);
                        if(empty($DataCek['id_kriteria_indikator_ref'])){
                            $id_kriteria_indikator_ref="";
                        }else{
                            $id_kriteria_indikator_ref=$DataCek['id_kriteria_indikator_ref'];
                        }
                ?>
                    <li>
                        <input type="checkbox" <?php if(!empty($id_kriteria_indikator_ref)){echo "checked";} ?> name="id_referensi_bukti[]" id="<?php echo "$id_kriteria_indikator-$id_referensi_bukti"; ?>" value="<?php echo "$id_referensi_bukti"; ?>"> 
                        <label for="<?php echo "$id_kriteria_indikator-$id_referensi_bukti"; ?>"><?php echo "$nama_bukti"; ?></label>
                    </li>
                <?php
                    }
                ?>
            </ol>
        </div>
    </div>
<?php } ?>