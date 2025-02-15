<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');
    
    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');

    //Sesi Akses
    if (empty($SessionIdAkses)) {
        echo '
            <div class="alert alert-danger">
                Sesi Akses Sudah Berakhir! Silahkan Login Ulang!
            </div>
        ';
    }else{
        //Tangkap Data
        if(empty($_POST['id_uraian'])){
            echo '
                <div class="alert alert-danger">
                    ID Uraian Tidak Boleh Kosong!
                </div>
            ';
        }else{
            if(empty($_POST['id_lampiran'])){
                echo '
                    <div class="alert alert-danger">
                        ID Lampiran Tidak Boleh Kosong!
                    </div>
                ';
            }else{
                if(empty($_POST['id_kriteria'])){
                    echo '
                        <div class="alert alert-danger">
                            ID Kriteria Tidak Boleh Kosong!
                        </div>
                    ';
                }else{
                    $id_uraian=$_POST['id_uraian'];
                    $id_lampiran=$_POST['id_lampiran'];
                    $id_kriteria=$_POST['id_kriteria'];
                    $Qry = $Conn->prepare("SELECT * FROM uraian WHERE id_uraian = ?");
                    $Qry->bind_param("s", $id_uraian);
                    if (!$Qry->execute()) {
                        $error=$Conn->error;
                        echo '
                            <div class="alert alert-danger">
                                Terjadi Kesalahan Pada Saat Membuka Data Uraian <br>
                                Error : '.$error.'
                            </div>
                        ';
                    }else{
                        $Result = $Qry->get_result();
                        $Data = $Result->fetch_assoc();
                        $Qry->close();
                        if(empty($Data['id_uraian'])){
                            echo '
                                <div class="alert alert-danger">
                                    Data Tidak Ditemukan!
                                </div>
                            ';
                        }else{
                            //Buka Data
                            $id_uraian=$Data['id_uraian'];
                            $id_kriteria=$Data['id_kriteria'];
                            $id_komponen_sub=$Data['id_komponen_sub'];
                            $id_komponen=$Data['id_komponen'];
                            $id_evaluasi_periode=$Data['id_evaluasi_periode'];
                            $kode=$Data['kode'];
                            $nama=$Data['nama'];
                            $alternatif=$Data['alternatif'];
                            $lampiran=$Data['lampiran'];
                            $bobot=$Data['bobot'];
                            //Buka Data Lampiran Menjadi Arry
                            $lampiran_arry=json_decode($lampiran, true);
                            foreach($lampiran_arry as $lampiran_list){
                                if($lampiran_list['id_lampiran']==$id_lampiran){
                                    $nama_dokumen=$lampiran_list['nama'];
                                    $lampiran_uraian=$lampiran_list['lampiran_uraian'];
                                    $size_max=$lampiran_list['size_max'];
                                }
                            }
                            $size_max_mb = $size_max / (1024 * 1024);

?>
                    <input type="hidden" name="id_uraian" id="id_uraian_for_hapus_lampiran" value="<?php echo $id_uraian; ?>">
                    <input type="hidden" name="id_lampiran" id="id_lampiran_for_hapus_lampiran" value="<?php echo $id_lampiran; ?>">
                    <input type="hidden" name="id_kriteria" id="id_kriteria_for_hapus_lampiran" value="<?php echo $id_kriteria; ?>">
                    <div class="row mb-3">
                        <div class="col-4">
                            <small>ID Lampiran</small>
                        </div>
                        <div class="col-8">
                            <small class="text text-grayish"><?php echo "$id_lampiran"; ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <small>Nama Lampiran</small>
                        </div>
                        <div class="col-8">
                            <small class="text text-grayish"><?php echo $nama; ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <small>Mandatori</small>
                        </div>
                        <div class="col-8">
                            <small class="text text-grayish"><?php echo $lampiran_uraian; ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <small>Max Size</small>
                        </div>
                        <div class="col-8">
                            <small class="text text-grayish"><?php echo "$size_max_mb MB"; ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            Apakah Anda Yakin Akan Menghapus Data Tersebut?
                        </div>
                    </div>
<?php
                        }
                    }
                }
            }
        }
    }
?>