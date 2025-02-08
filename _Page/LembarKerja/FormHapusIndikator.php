<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap id_capaian
    if(empty($_POST['id_capaian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Capaian Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_capaian=$_POST['id_capaian'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_capaian)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Capaian Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM capaian WHERE id_capaian='$id_capaian'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_capaian'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '     ID capaian Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $indikator=$Data['indikator'];
                $json_data_fitur = ReferensiTargetCapaian();
                $NamaLabel=CekParameterCapaianTarget($json_data_fitur,$indikator,'label_title');
?>
                <input type="hidden" name="id_capaian" value="<?php echo "$id_capaian"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        Indikator Capaian Perjanjian Kinerja
                        <p><b>"<?php echo "$NamaLabel"; ?>"</b></p>
                    </div>
                </div>
<?php
            }
        }
    }
?>