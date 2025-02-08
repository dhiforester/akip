<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Sasaran Perjanjian Kinerja
    if(empty($_POST['id_perjanjian_sasaran'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Perjanjian Kinerja Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_perjanjian_sasaran=$_POST['id_perjanjian_sasaran'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_perjanjian_sasaran)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Sasaran Perjanjian Kinerja Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM perjanjian_sasaran WHERE id_perjanjian_sasaran='$id_perjanjian_sasaran'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_perjanjian_sasaran'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Sasaran Perjanjian Kinerja Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $sasaran=$Data['sasaran'];
?>
                <input type="hidden" name="id_perjanjian_sasaran" value="<?php echo "$id_perjanjian_sasaran"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12 text-center text-danger">
                        <b>"<?php echo "$sasaran"; ?>"</b>
                    </div>
                </div>
<?php
            }
        }
    }
?>