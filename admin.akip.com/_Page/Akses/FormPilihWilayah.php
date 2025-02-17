<?php
    include "../../_Config/Connection.php";
    if(!empty($_POST['akses'])){
        $akses=$_POST['akses'];
        if($akses=="Provinsi"){
            echo '<div class="row mb-3">';
            echo '  <div class="col-4">';
            echo '      <label for="provinsi">Provinsi</label>';
            echo '  </div>';
            echo '  <div class="col-8">';
            echo '      <select class="form-control" name="provinsi" id="provinsi">';
            echo '          <option value="">Pilih</option>';
            echo '      </select>';
            echo '  </div>';
            echo '</div>';
        }else{
            if($akses=="Kabupaten"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-4">';
                echo '      <label for="provinsi">Provinsi</label>';
                echo '  </div>';
                echo '  <div class="col-8">';
                echo '      <select class="form-control" name="provinsi" id="provinsi">';
                echo '          <option value="">Pilih</option>';
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
                echo '<div class="row mb-3">';
                echo '  <div class="col-4">';
                echo '      <label for="kabupaten">Kabupaten</label>';
                echo '  </div>';
                echo '  <div class="col-8">';
                echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                echo '          <option value="">Pilih</option>';
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }else{
                if($akses=="Inspektorat"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-4">';
                    echo '      <label for="provinsi">Provinsi</label>';
                    echo '  </div>';
                    echo '  <div class="col-8">';
                    echo '      <select class="form-control" name="provinsi" id="provinsi">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-4">';
                    echo '      <label for="kabupaten">Kabupaten</label>';
                    echo '  </div>';
                    echo '  <div class="col-8">';
                    echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-4">';
                    echo '      <label for="inspektorat">Inspektorat</label>';
                    echo '  </div>';
                    echo '  <div class="col-8">';
                    echo '      <select class="form-control" name="inspektorat" id="inspektorat">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    if($akses=="OPD"){
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-4">';
                        echo '      <label for="provinsi">Provinsi</label>';
                        echo '  </div>';
                        echo '  <div class="col-8">';
                        echo '      <select class="form-control" name="provinsi" id="provinsi">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-4">';
                        echo '      <label for="kabupaten">Kabupaten</label>';
                        echo '  </div>';
                        echo '  <div class="col-8">';
                        echo '      <select class="form-control" name="kabupaten" id="kabupaten">';
                        echo '          <option value="">Pilih</option>';
                        echo '      </select>';
                        echo '  </div>';
                        echo '</div>';
                        echo '<div class="row mb-3">';
                        echo '  <div class="col-4">';
                        echo '      <label for="opd">OPD</label>';
                        echo '  </div>';
                        echo '  <div class="col-8">';
                        echo '      <select class="form-control" name="opd" id="opd">';
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
        var id_provinsi = $('#provinsi').val();
        $('#kabupaten').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKabupaten.php',
            data 	    :  {id_provinsi: id_provinsi},
            success     : function(data){
                $('#kabupaten').html(data);
            }
        });
        //Kecamatan dan Desa Reset
        $('#inspektorat').html('<option value="">Pilih</option>');
        $('#opd').html('<option value="">Pilih</option>');
    });
    //Ketika Kabupaten Dipilih
    $('#kabupaten').change(function(){
        var id_kabkot = $('#kabupaten').val();
        $('#inspektorat').html('Loading...');
        $('#opd').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListInspektorat.php',
            data 	    :  {id_kabkot: id_kabkot},
            success     : function(data){
                $('#inspektorat').html(data);
            }
        });
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListOpd.php',
            data 	    :  {id_kabkot: id_kabkot},
            success     : function(data){
                $('#opd').html(data);
            }
        });
    });
</script>