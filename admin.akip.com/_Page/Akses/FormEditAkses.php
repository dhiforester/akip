<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '
            <div class="alert alert-danger text-center">ID Akses Tidak Boleh Kosong!</div>
        ';
    }else{
        if(empty($SessionIdAkses)){
            echo '
                <div class="alert alert-danger text-center">Sesi Akses Sudah Berakhir! Silahkan Login Ulang!</div>
            ';
        }else{
            $id_akses=$_POST['id_akses'];
            //Buka Data Akses
            $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses= ?");
            $Qry->bind_param("s", $id_akses);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="alert alert-danger text-center">Terjadi Kesalahan Pada Saat Membuka Data Akses.<br>Error : '.$error.'</div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_akses'])){
                    echo '
                        <div class="alert alert-danger text-center">Data Akses Tidak Ditemukan.<br>Error : '.$id_akses.'</div>
                    ';
                }else{
                    //Buka Data
                    $nama=$Data['nama'];
                    $email=$Data['email'];
                    $kontak=$Data['kontak'];
                    //Tampilkan Data
                    echo '
                        <input type="hidden" name="id_akses" value="'.$id_akses.'">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_edit">Nama Pengguna</label>
                                <input type="text" name="nama" id="nama_edit" class="form-control" value="'.$nama.'" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email_edit">Alamat Email</label>
                                <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="'.$email.'" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="kontak_edit">Kontak</label>
                                <input type="tel" name="kontak" id="kontak_edit" class="form-control" pattern="[0-9]+" inputmode="numeric" value="'.$kontak.'" placeholder="62" required>
                            </div>
                        </div>
                    ';
                }
            }
        }
    }
?>