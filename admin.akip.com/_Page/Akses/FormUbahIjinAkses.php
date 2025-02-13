<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Akses Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $akses=getDataDetail($Conn,'akses','id_akses',$id_akses,'akses');
        //Buka Standar Fitur
?>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <?php
        //Menampilkan List Ijin Akses Berdasarkan Entitias Akses
        $query1 = mysqli_query($Conn, "SELECT DISTINCT kategori FROM akses_fitur WHERE akses='$akses'");
        while ($data1 = mysqli_fetch_array($query1)) {
            $kategori= $data1['kategori'];
            echo '<div class="row mb-3">';
            echo '  <ul class="col-md-12">';
            echo '      <b>'.$kategori.'</b>';
            echo '      <ul>';
            //Menampilkan List Berdasarkan Kategori
            $query2 = mysqli_query($Conn, "SELECT * FROM akses_fitur WHERE kategori='$kategori' AND akses='$akses'");
            while ($data2 = mysqli_fetch_array($query2)) {
                $id_akses_fitur= $data2['id_akses_fitur'];
                $nama= $data2['nama'];
                $kode= $data2['kode'];
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
            echo '      </ul>';
            echo '  </div>';
            echo '</div>';
        }

    ?>
<?php } ?>