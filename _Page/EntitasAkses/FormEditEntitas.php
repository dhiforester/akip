<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap aksses
    if(empty($_POST['id_akses_entitas'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 mb-3">';
        echo '         Tidak ada informasi akses yang ditangkap sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses_entitas=$_POST['id_akses_entitas'];
        $akses=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'akses');
        $entitas=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
        $standar_fitur=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
        //Jumlah Akses
        $jumlah_akses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_akses_entitas='$id_akses_entitas'"));
        $data_array = json_decode($standar_fitur, true);
        //Menghitung Jumlah standar fitur
        $data_array = json_decode($standar_fitur, true);
        $JumlahDataArray=count($data_array);
?>
    <input type="hidden" name="id_akses_entitas" value="<?php echo "$id_akses_entitas"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="akses">Akses</label>
            <select name="akses" id="akses_edit" class="form-control">
                <option <?php if($akses==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($akses=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                <option <?php if($akses=="Provinsi"){echo "selected";} ?> value="Provinsi">Provinsi</option>
                <option <?php if($akses=="Kabupaten"){echo "selected";} ?> value="Kabupaten">Kabupaten/Kota</option>
                <option <?php if($akses=="Kecamatan"){echo "selected";} ?> value="Kecamatan">Kecamatan</option>
                <option <?php if($akses=="Desa"){echo "selected";} ?> value="Desa">Kelurahan/Desa</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="entitas">Entitas Akses</label>
            <input type="text" name="entitas" id="entitas" class="form-control" value="<?php echo "$entitas"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12" id="FormStandarFiturEdit">
            <?php
                if(!empty($akses)){
                    echo '<label for="standar_fitur">Standar Fitur</label>';
                    $no=1;
                    $query = mysqli_query($Conn, "SELECT DISTINCT kategori FROM akses_fitur WHERE akses='$akses' ORDER BY kategori ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $kategori= $data['kategori'];
                        echo '<div class="row">';
                        echo '  <div class="col-md-12 ml-3">';
                        echo '      '.$no.'. '.$kategori.'';
                        echo '      <ul>';
                        //List Fitur
                        $query2 = mysqli_query($Conn, "SELECT * FROM akses_fitur WHERE kategori='$kategori' AND akses='$akses' ORDER BY nama ASC");
                        while ($data2 = mysqli_fetch_array($query2)) {
                            $id_akses_fitur =$data2['id_akses_fitur'];
                            $NamaFitur=$data2['nama'];
                            $KodeFitur=$data2['kode'];
                            $CekKodeFitur=$jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_entitas WHERE standar_fitur like '%$KodeFitur%'"));
                            if(empty($CekKodeFitur=$jml_data)){
                                echo '<li>';
                                echo '  <input type="checkbox" name="id_akses_fitur[]" id="id_akses_fitur'.$id_akses_fitur.'" value="'.$id_akses_fitur.'">';
                                echo '  <label for="id_akses_fitur'.$id_akses_fitur.'">'.$NamaFitur.'</label>';
                                echo '</li>';
                            }else{
                                echo '<li>';
                                echo '  <input type="checkbox" checked name="id_akses_fitur[]" id="id_akses_fitur'.$id_akses_fitur.'" value="'.$id_akses_fitur.'">';
                                echo '  <label for="id_akses_fitur'.$id_akses_fitur.'">'.$NamaFitur.'</label>';
                                echo '</li>';
                            }
                            
                        }
                        echo '      </ul>';
                        echo '  </div>';
                        echo '</div>';
                        $no++;
                    }
                }
            ?>
        </div>
    </div>
<?php } ?>
<script>
    $('#akses_edit').change(function(){
        var akses = $('#akses_edit').val();
        $('#FormStandarFiturEdit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/EntitasAkses/FormStandarFitur.php',
            data 	    :  {akses: akses},
            enctype     : 'multipart/form-data',
            success     : function(data){
                $('#FormStandarFiturEdit').html(data);
            }
        });
    });
</script>