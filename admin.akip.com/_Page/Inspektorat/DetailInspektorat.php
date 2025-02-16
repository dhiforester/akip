<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    if (empty($SessionIdAkses)) {
        echo '
            <div class="alert alert-danger">
                Sesi Akses Sudah Berakhir! Silahkan Login Ulang!
            </div>
        ';
    }else{
        if(empty($_POST['id'])){
            echo '
                <div class="alert alert-danger">
                    ID Inspektorat Tidak Boleh Kosong!
                </div>
            ';
        }else{
            // Assign dan sanitasi nilai variabel
            $id_inspektorat = validateAndSanitizeInput($_POST['id']);

            $Qry = $Conn->prepare("SELECT * FROM inspektorat WHERE id_inspektorat= ?");
            $Qry->bind_param("s", $id_inspektorat);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="alert alert-danger">
                        Terjadi Kesalahan!<br>
                        Keterangan : '.$error.'
                    </div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_inspektorat'])){
                    echo '
                        <div class="alert alert-danger">
                            Data Yang Anda Pilih Tidak Ditemukan!
                        </div>
                    ';
                }else{
                    //Buka Data
                    $id_inspektorat=$Data['id_inspektorat'];
                    $id_provinsi=$Data['id_provinsi'];
                    $id_kabkot=$Data['id_kabkot'];
                    $nama_inspektorat=$Data['nama_inspektorat'];
                    $telepon=$Data['telepon'];
                    $alamat=$Data['alamat'];
                     //Buka Nama Provinsi
                    $provinsi=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');
                    $kabkot=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
                    echo '
                        <div class="row mb-2">
                            <div class="col-4"><small>Inspektorat</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$nama_inspektorat.'</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><small>Kontak/Telepon</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$telepon.'</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><small>Alamat</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$alamat.'</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><small>Provinsi</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$provinsi.'</small></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><small>Kabupaten/Kota</small></div>
                            <div class="col-8"><small class="text text-grayish">'.$kabkot.'</small></div>
                        </div>
                    ';
                }
            }
        }
    }
?>
