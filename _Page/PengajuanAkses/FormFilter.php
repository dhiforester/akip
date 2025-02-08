<?php
    include "../../_Config/Connection.php";
    include "../../_Config/SettingGeneral.php";
    if(empty($_POST['KeywordBy'])){
        echo '<div class="col-md-12 mt-3">';
        echo '  <label for="keyword">Kata Kunci</label>';
        echo '  <input type="text" name="keyword" id="keyword" class="form-control">';
        echo '</div>';
    }else{
        $KeywordBy=$_POST['KeywordBy'];
        if($KeywordBy=="status"){
            echo '<div class="col-md-12 mt-3">';
            echo '  <label for="keyword">Kata Kunci</label>';
            echo '  <select name="keyword" id="keyword" class="form-control">';
            echo '      <option value="">Pilih</option>';
            echo '      <option value="Pengajuan">Pengajuan</option>';
            echo '      <option value="Diterima">Diterima</option>';
            echo '      <option value="Ditolak">Ditolak</option>';
            echo '  </select>';
            echo '</div>';
        }else{
            if($KeywordBy=="tanggal"){
                echo '<div class="col-md-12 mt-3">';
                echo '  <label for="keyword">Kata Kunci</label>';
                echo '  <input type="date" name="keyword" id="keyword" class="form-control">';
                echo '</div>';
            }else{
                if($KeywordBy=="id_wilayah"){
                    echo '<div class="col-md-12 mt-3">';
                    echo '  <label for="kecamatan">Kecamatan</label>';
                    echo '  <select name="kecamatan" id="kecamatan" class="form-control">';
                    echo '      <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$NamaWilayahOfficial' ORDER BY kecamatan ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_wilayah= $data['id_wilayah'];
                        $kecamatan= $data['kecamatan'];
                        echo '<option value="'.$kecamatan.'">'.$kecamatan.'</option>';
                    }
                    echo '  </select>';
                    echo '</div>';
                    echo '<div class="col-md-12 mt-3">';
                    echo '  <label for="keyword">Desa</label>';
                    echo '  <select name="keyword" id="keyword" class="form-control">';
                    echo '      <option value="">Pilih</option>';
                    echo '  </select>';
                    echo '</div>';
                }else{
                    echo '<div class="col-md-12 mt-3">';
                    echo '  <label for="keyword">Kata Kunci</label>';
                    echo '  <input type="text" name="keyword" id="keyword" class="form-control">';
                    echo '</div>';
                }
            }
        }
    }
?>
<script>
    $('#kecamatan').change(function(){
        var kecamatan = $('#kecamatan').val();
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/PengajuanAkses/FormFilter2.php',
            data 	    :  {kecamatan: kecamatan},
            success     : function(data){
                $('#keyword').html(data);
            }
        });
    });
</script>