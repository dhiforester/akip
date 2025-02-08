<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Ijin Akses Ke Form Ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'uWNzEv9I7I');
    if(empty($IjinAksesSaya)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Anda Tidak Memiliki Ijin Akses Untuk Masuk Ke Halaman Ini!';
        echo '  </div>';
        echo '</div>';
    }else{
        //Menangkap Data id_perjanjian_kinerja
        if(empty($_POST['id_perjanjian_kinerja'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Perjanjian Kinerja Data Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_perjanjian_kinerja=$_POST['id_perjanjian_kinerja'];
            //Validasi Hanya Boleh Angka
            if(!preg_match('/^[0-9]+$/', $id_perjanjian_kinerja)) {
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
                echo '  </div>';
                echo '</div>';
            }else{
                //Validasi Keberadaan Data Perjanjian Kinerja
                $Qry = mysqli_query($Conn,"SELECT * FROM perjanjian_kinerja WHERE id_perjanjian_kinerja='$id_perjanjian_kinerja'")or die(mysqli_error($Conn));
                $DataPerjanjianKinerja = mysqli_fetch_array($Qry);
                if(empty($DataPerjanjianKinerja['id_perjanjian_kinerja'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID Evaluasi Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $kategori=$DataPerjanjianKinerja['kategori'];
                    $tanggal=$DataPerjanjianKinerja['tanggal'];
                    $nama_1=$DataPerjanjianKinerja['nama_1'];
                    $jabatan_1=$DataPerjanjianKinerja['jabatan_1'];
                    $nama_2=$DataPerjanjianKinerja['nama_2'];
                    $jabatan_2=$DataPerjanjianKinerja['jabatan_2'];
?>
                    <input type="hidden" name="id_perjanjian_kinerja" value="<?php echo "$id_perjanjian_kinerja"; ?>">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>1. Informasi Perjanjian</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="tanggal">1.1 Tanggal</label>
                        </div>
                        <div class="col-md-9">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo "$tanggal"; ?>">
                            <small class="credit">
                                <code class="text-dark">Tanggal Perjanjian Kinerja Sesuai Dokumen</code>
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="kategori">1.2 Kategori Perjanjian</label>
                        </div>
                        <div class="col-md-9">
                            <select name="kategori" id="kategori" class="form-control">
                                <option <?php if($kategori==""){echo "selected";} ?> value="">Pilih</option>
                                <option <?php if($kategori=="Kades-Camat"){echo "selected";} ?> value="Kades-Camat">Kepala Desa Dengan Camat</option>
                                <option <?php if($kategori=="Perangkat-Kades"){echo "selected";} ?> value="Perangkat-Kades">Perangkat Desa Dengan Kepala Desa</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>2. Pihak Pertama</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="nama_1">2.1 Nama</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_1" id="nama_1" class="form-control" value="<?php echo "$nama_1" ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jabatan_1">2.2 Jabatan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jabatan_1" id="jabatan_1" class="form-control" value="<?php echo "$jabatan_1" ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <b>3. Pihak Kedua</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="nama_2">3.1 Nama</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nama_2" id="nama_2" class="form-control" value="<?php echo "$nama_2" ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="jabatan_2">3.2 Jabatan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="jabatan_2" id="jabatan_2" class="form-control" value="<?php echo "$jabatan_2" ?>">
                        </div>
                    </div>
<?php
                }
            }
        }
    }
?>