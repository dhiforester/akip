<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID APBDES
    if(empty($_POST['id_apbdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID APBDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_apbdes=$_POST['id_apbdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_apbdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID APBDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qry = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_apbdes='$id_apbdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Data = mysqli_fetch_array($Qry);
            if(empty($Data['id_apbdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID APBDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $periode=$Data['periode'];
?>
                <input type="hidden" name="id_apbdes" value="<?php echo "$id_apbdes"; ?>">
                <div class="row">
                    <div class="col-md-12">
                        Template APBDES ini memiliki format <i>excel</i> yang kemudian dapat anda isi dengan nilai anggaran pada 
                        masing-masing bidang anggaran (kegiatan). Adapun ketentuan pengisian perlu memperhatikan hal berikut ini:
                        <ul>
                            <li>
                                Template ini disediakan untuk pengisian APBDES pada masing-masing anggaran bidang kegiatan pada satu periode.
                            </li>
                            <li>
                                Pastikan kolom yang ada pada template terdiri dari Kode Rekening, Nama Bidang/kegiatan dan Nilai anggaran.
                            </li>
                            <li>
                                Pastikan bahwa kode rekening sesuai dengan referensi pedoman penyusunan APBDES kabupaten.
                            </li>
                            <li>Sistem hanya akan memproses kode rekening kegiatan</li>
                        </ul>
                    </div>
                </div>
<?php
            }
        }
    }
?>