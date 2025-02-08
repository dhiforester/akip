<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['akses'])){
        $akses=$_POST['akses'];
        if($akses=="Provinsi"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-4">';
            echo '      <label for="provinsi">Provinsi</label>';
            echo '  </div>';
            echo '  <div class="col-md-8">';
            echo '      <select class="form-control" name="provinsi" id="provinsi">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }else{
            if($akses=="Kabupaten"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="provinsi">Provinsi</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="provinsi" id="provinsi">';
                echo '          <option value="">Pilih</option>';
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="kabupaten">Kabupaten</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                echo '          <option value="">Pilih</option>';
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }else{
                if($akses=="Kecamatan"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-4">';
                    echo '      <label for="provinsi">Provinsi</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-8">';
                    echo '      <select class="form-control" name="provinsi" id="provinsi">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-4">';
                    echo '      <label for="kabupaten">Kabupaten</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-8">';
                    echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-4">';
                    echo '      <label for="kecamatan">Kecamatan</label>';
                    echo '  </div>';
                    echo '  <div class="col-md-8">';
                    echo '      <select class="form-control" name="kecamatan" id="kecamatan">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    if($akses=="Desa"){
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-4">';
                        echo '      <label for="provinsi">Provinsi</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-8">';
                        echo '      <select class="form-control" name="provinsi" id="provinsi">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-4">';
                        echo '      <label for="kabupaten">Kabupaten</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-8">';
                        echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-4">';
                        echo '      <label for="kecamatan">Kecamatan</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-8">';
                        echo '      <select class="form-control" name="kecamatan" id="kecamatan">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-md-4">';
                        echo '      <label for="desa">Desa</label>';
                        echo '  </div>';
                        echo '  <div class="col-md-8">';
                        echo '      <select class="form-control" name="desa" id="desa">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                    }else{
            
                    }
                }
            }
        }
    }
?>
<script>
    //Menampilkan List Provinsi Pertama Kali
    $('#provinsi').html('<option value="">Loading...</option>>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/ListProvinsi.php',
        success     : function(data){
            $('#provinsi').html(data);
        }
    });
    //Ketika Propinsi Dipilih
    $('#provinsi').change(function(){
        var id_wilayah = $('#provinsi').val();
        $('#kabupaten').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKabupaten.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kabupaten').html(data);
            }
        });
        //Kecamatan dan Desa Reset
        $('#kecamatan').html('<option value="">Pilih</option>');
        $('#desa').html('<option value="">Pilih</option>');
    });
    //Ketika Kabupaten Dipilih
    $('#kabupaten').change(function(){
        var id_wilayah = $('#kabupaten').val();
        $('#kecamatan').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKecamatan.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kecamatan').html(data);
            }
        });
        //Desa Reset
        $('#desa').html('<option value="">Pilih</option>');
    });
    //Ketika Kecamatan Dipilih
    $('#kecamatan').change(function(){
        var id_wilayah = $('#kecamatan').val();
        $('#desa').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListDesa.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#desa').html(data);
            }
        });
    });
</script>