<?php
    //Koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Tangkap Variabel
    if(empty($_POST['id_akses'])){
        echo '<code class="text-danger">ID Akses Tidak Boleh Kosong!</code>';
    }else{
        $id_akses=$_POST['id_akses'];
        $akses=getDataDetail($Conn,'akses','id_akses',$id_akses,'akses');
        $id_akses_entitas=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_akses_entitas');
        $StandarFitur=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
        $StandarFitur = json_decode($StandarFitur, true);
        if(empty(count($StandarFitur))){
            echo '<code class="text-danger">Tidak Ada Data Ijin Akses Yang Ditangkap!</code>';
        }else{
?>
        <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <?php
                        foreach ($StandarFitur as $item) {
                            $id_akses_fitur=$item['id_akses_fitur'];
                            $kode=$item['kode'];
                            $nama=$item['nama'];
                            //Cek apakah akun tersebut mempunyai ijin tersebut
                            $QryIjin = mysqli_query($Conn,"SELECT * FROM akses_ijin WHERE id_akses='$id_akses' AND kode='$kode'")or die(mysqli_error($Conn));
                            $DataIjin = mysqli_fetch_array($QryIjin);
                            if(empty($DataIjin['id_akses_ijin'])){
                                //Menampilkan List Berdasarkan Kategori
                                echo '<li>';
                                echo '  <input type="checkbox" name="id_akses_fitur[]" id="'.$kode.'" value="'.$id_akses_fitur.'">';
                                echo '  <label for="'.$kode.'">'.$nama.'</label>';
                                echo '</li>';
                            }else{
                                //Menampilkan List Berdasarkan Kategori
                                echo '<li>';
                                echo '  <input type="checkbox" checked name="id_akses_fitur[]" id="'.$kode.'" value="'.$id_akses_fitur.'">';
                                echo '  <label for="'.$kode.'">'.$nama.'</label>';
                                echo '</li>';
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
<?php
        }
    }
?>