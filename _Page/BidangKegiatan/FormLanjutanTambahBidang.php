<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    if(empty($_POST['level'])){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12">';
        echo '      <small class="credit text-danger">Level Tidak Boleh Kosong!</small>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['id_wilayah'])){
            echo '<div class="row mb-3">';
            echo '  <div class="col-md-12">';
            echo '      <small class="credit text-danger">ID Wilayahh Tidak Boleh Kosong!</small>';
            echo '  </div>';
            echo '</div>';
        }else{
            $level=$_POST['level'];
            $id_wilayah=$_POST['id_wilayah'];
            if($level=="Sub Bidang"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-12">';
                echo '      <label for="kode_bidang">Bidang</label>';
                echo '      <select name="kode_bidang" id="kode_bidang" class="form-control">';
                echo '          <option value="">Pilih</option>';
                $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND level='Bidang' ORDER BY kode ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $kode_bidang= $data['kode'];
                    $nama= $data['nama'];
                    echo '<option value="'.$kode_bidang.'">'.$kode_bidang.'. '.$nama.'</option>';
                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }else{
                if($level=="Kegiatan"){
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="kode_bidang">Bidang</label>';
                    echo '      <select name="kode_bidang" id="kode_bidang" class="form-control">';
                    echo '          <option value="">Pilih</option>';
                    $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND level='Bidang' ORDER BY kode ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $kode_bidang= $data['kode'];
                        $nama= $data['nama'];
                        echo '<option value="'.$kode_bidang.'">'.$kode_bidang.'. '.$nama.'</option>';
                    }
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-12">';
                    echo '      <label for="kode_sub_bidang">Sub Bidang</label>';
                    echo '      <select name="kode_sub_bidang" id="kode_sub_bidang" class="form-control">';
                    echo '          <option value="">Pilih</option>';
                    echo '      </select>';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    
                }
            }
        }
    }
?>
<script>
    //Kondisi Ketika Level Diubah
    $('#kode_bidang').change(function(){
        var kode_bidang = $('#kode_bidang').val();
        var id_wilayah ="<?php echo "$id_wilayah"; ?>";
        $('#kode_sub_bidang').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/BidangKegiatan/ListSubBidang.php',
            data        :   {kode_bidang: kode_bidang, id_wilayah: id_wilayah},
            success     : function(data){
                $('#kode_sub_bidang').html(data);
            }
        });
    });
</script>