<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_referensi_bukti
    if(empty($_POST['id_referensi_bukti'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Referensi Bukti Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_referensi_bukti=$_POST['id_referensi_bukti'];
        //Buka data askes
        $nama_bukti=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'nama_bukti');
        $single_multi=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'single_multi');
        $type_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'type_file');
        $deskripsi=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'deskripsi');
        $max_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'max_file');
        $DataArray = json_decode($type_file, true);
?>
    <input type="hidden" name="id_referensi_bukti" value="<?php echo "$id_referensi_bukti"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama_bukti"><b>Nama Lampiran/Bukti</b></label>
            <input type="text" name="nama_bukti" id="nama_bukti" class="form-control" placeholder="Dokumen RPJMDES Terbaru" value="<?php echo $nama_bukti; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="single_multi"><b>Single/Multi Upload</b></label>
            <select name="single_multi" id="single_multi" class="form-control">
                <option <?php if($single_multi==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($single_multi=="Single"){echo "selected";} ?> value="Single">Single</option>
                <option <?php if($single_multi=="Multi"){echo "selected";} ?> value="Multi">Multi</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti"><b>Type File (Document)</b></label>
            <ul>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/pdf')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti1" value="application/pdf"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti1">PDF</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/vnd.ms-excel')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti2" value="application/vnd.ms-excel"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti2">XLS</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti3" value="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti3">XLSX</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'text/csv')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti4" value="text/csv"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti4">CSV-1</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/csv')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti5" value="application/csv"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti5">CSV-2</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'text/plain')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti6" value="text/plain"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti6">CSV-3</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/msword')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti7" value="application/msword"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti7">DOC</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti8" value="application/vnd.openxmlformats-officedocument.wordprocessingml.document"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti8">DOCX</label>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti"><b>Type File (Image)</b></label>
            <ul>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'image/jpeg')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti9" value="image/jpeg"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti9">JPEG</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'image/png')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti10" value="image/png"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti10">PNG</label>
                </li>
                <li>
                    <input <?php if (checkImageGifExists($type_file,'image/gif')) {echo "checked";} ?> type="checkbox" name="type_bukti[]" id="<?php echo "$id_referensi_bukti"; ?>type_bukti11" value="image/gif"> 
                    <label for="<?php echo "$id_referensi_bukti"; ?>type_bukti11">GIF</label>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="max_file"><b>Ukuran Maksimal (MB)</b></label>
            <input type="text" name="max_file" id="max_file" class="form-control" value="<?php echo "$max_file"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="deskripsi"><b>Deskripsi/Petunjuk Upload</b></label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"><?php echo "$deskripsi"; ?></textarea>
        </div>
    </div>
<?php } ?>