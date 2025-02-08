<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Id Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $NamaDaerah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
?>
    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
    <input type="hidden" name="nama_daerah" value="<?php echo "$NamaDaerah"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="kode">Kode</label>
            <input type="text" name="kode" class="form-control">
            <small class="credit">Diisi dengan kode sesuai nomenklatur (Ex: 1.1.1)</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="level">Level</label>
            <select name="level" id="level" class="form-control">
                <option value="">Pilih</option>
                <option value="Bidang">Bidang</option>
                <option value="Sub Bidang">Sub Bidang</option>
                <option value="Kegiatan">Kegiatan</option>
            </select>
        </div>
    </div>
    <div id="FormLanjutanTambahBidang"></div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="nama">Nama Parameter</label>
            <input type="text" name="nama" class="form-control">
            <small class="credit">
                Nama Bidang, Sub Bidang atau Kegiatan di tulis disini
            </small>
        </div>
    </div>
<?php } ?>
<script>
    //Kondisi Ketika Level Diubah
    $('#level').change(function(){
        var level = $('#level').val();
        var id_wilayah ="<?php echo "$id_wilayah"; ?>";
        $('#FormLanjutanTambahBidang').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/BidangKegiatan/FormLanjutanTambahBidang.php',
            data        :   {level: level, id_wilayah: id_wilayah},
            success     : function(data){
                $('#FormLanjutanTambahBidang').html(data);
            }
        });
    });
</script>