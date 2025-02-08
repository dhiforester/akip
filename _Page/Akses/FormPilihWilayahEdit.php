<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['akses'])){
        $akses=$_POST['akses'];
        if($akses=="Provinsi"||$akses=="Kabupaten"||$akses=="Kecamatan"||$akses=="Desa"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4">';
            echo '      <label for="provinsi_edit">Provinsi</label>';
            echo '  </div>';
            echo '  <div class="col-md-8">';
            echo '      <select class="form-control" name="provinsi" id="provinsi_edit">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }
        if($akses=="Kabupaten"||$akses=="Kecamatan"||$akses=="Desa"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4">';
            echo '      <label for="kabupaten_edit">Kabupaten</label>';
            echo '  </div>';
            echo '  <div class="col-md-8">';
            echo '      <select class="form-control" name="kabupaten" id="kabupaten_edit">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }
        if($akses=="Kecamatan"||$akses=="Desa"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4">';
            echo '      <label for="kecamatan_edit">Kecamatan</label>';
            echo '  </div>';
            echo '  <div class="col-md-8">';
            echo '      <select class="form-control" name="kecamatan" id="kecamatan_edit">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }
        if($akses=="Desa"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4">';
            echo '      <label for="desa_edit">Desa</label>';
            echo '  </div>';
            echo '  <div class="col-md-8">';
            echo '      <select class="form-control" name="desa" id="desa_edit">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }
    }
?>
<script>
    //Menampilkan List Provinsi Pertama Kali
    $('#provinsi_edit').html('<option value="">Loading...</option>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/ListProvinsi.php',
        success     : function(data){
            $('#provinsi_edit').html(data);
        }
    });
    //Ketika Propinsi Dipilih
    $('#provinsi_edit').change(function(){
        var id_wilayah = $('#provinsi_edit').val();
        $('#kabupaten_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKabupaten.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kabupaten_edit').html(data);
            }
        });
        //Kecamatan dan Desa Reset
        $('#kecamatan_edit').html('<option value="">Pilih</option>');
        $('#desa_edit').html('<option value="">Pilih</option>');
    });
    //Ketika Kabupaten Dipilih
    $('#kabupaten_edit').change(function(){
        var id_wilayah = $('#kabupaten_edit').val();
        $('#kecamatan_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKecamatan.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kecamatan_edit').html(data);
            }
        });
        //Desa Reset
        $('#desa').html('<option value="">Pilih</option>');
    });
    //Ketika Kecamatan Dipilih
    $('#kecamatan_edit').change(function(){
        var id_wilayah = $('#kecamatan_edit').val();
        $('#desa_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListDesa.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#desa_edit').html(data);
            }
        });
    });
</script>