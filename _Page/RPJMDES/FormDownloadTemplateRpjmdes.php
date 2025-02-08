<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Evaluasi
    if(empty($_POST['id_rpjmdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rpjmdes=$_POST['id_rpjmdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $periode_rpjmdes=$DataRpjmdes['periode'];
                $kepala_desa=$DataRpjmdes['kepala_desa'];
                $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                //Explode
                $explode=explode('-',$periode_rpjmdes);
                $periode_awal=$explode['0'];
                $periode_akhir=$explode['1'];
?>
                <input type="hidden" name="id_rpjmdes" value="<?php echo "$id_rpjmdes"; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <label for="periode_tahun">Pilih Tahun Anggaran</label>
                        <select name="periode_tahun" id="periode_tahun" class="form-control">
                            <option value="">Pilih</option>
                            <?php
                                for ($tahun = $periode_awal; $tahun <= $periode_akhir; $tahun++) {
                                    echo '<option value="'.$tahun.'">'.$tahun.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Template RPJMDES ini memiliki format <i>excel</i> yang kemudian dapat anda isi dengan nilai anggaran pada 
                        masing-masing bidang anggaran (kegiatan). Adapun ketentuan pengisian perlu memperhatikan hal berikut ini:
                        <ul>
                            <li>
                                Template ini disediakan untuk pengisian RPJMDES pada masing-masing anggaran bidang kegiatan pada satu periode satu tahun.
                            </li>
                            <li>
                                Cara paling umum dan mudah yang dapat dilakukan, yaitu dengan membagi data RPJMDES yang anda miliki menjadi data/file menjadi data pertahun.
                            </li>
                            <li>
                                Pastikan kolom yang ada pada template terdiri dari Kode Rekening, Nama Bidang/kegiatan dan Nilai anggaran.
                            </li>
                            <li>
                                Pastikan bahwa kode rekening sesuai dengan referensi pedoman penyusunan RPJMDES kabupaten.
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