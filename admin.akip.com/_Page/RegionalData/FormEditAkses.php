<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    //Validasi Session
    if(empty($SessionIdAkses)){
        echo '
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        Sesi Akses Sudah Berakhir. Silahkan Login Ulang!
                    </div>
                </div>
            </div>
        ';
    }else{
        if(empty($_POST['id_akses'])){
            echo '
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            ID Akses Tidak Boleh Kosong!
                        </div>
                    </div>
                </div>
            ';
        }else{
            $id_akses = validateAndSanitizeInput($_POST['id_akses']);
            
            //Buka Data Akses
            $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses = ?");
            $Qry->bind_param("s", $id_akses);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Error: '.$error.'
                            </div>
                        </div>
                    </div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_akses'])){
                    echo '
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    Data Akses Tidak Ditemukan!
                                </div>
                            </div>
                        </div>
                    ';
                }else{
                    //Buka Data
                    $id_provinsi=$Data['id_provinsi'];
                    $id_kabkot=$Data['id_kabkot'];
                    $id_opd=$Data['id_opd'];
                    $nama=$Data['nama'];
                    $email=$Data['email'];
                    $kontak=$Data['kontak'];

                    echo '
                        <input type="hidden" name="id_akses" value="'.$id_akses.'">
                        <input type="hidden" name="id_opd" id="put_id_opd_for_edit_akses" value="'.$id_opd.'">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="nama_edit">Nama Pengguna</label>
                                <input type="text" name="nama" id="nama_edit" class="form-control" value="'.$nama.'">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="email_edit">Alamat Email</label>
                                <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="'.$email.'">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="kontak_edit">Kontak</label>
                                <input type="text" name="kontak" id="kontak_edit" class="form-control" inputmode="numeric" placeholder="62" value="'.$kontak.'">
                            </div>
                        </div>
                    ';
                }
            }
        }
    }
?>
