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
                    $foto=$Data['foto'];
                    $timestamp_creat=$Data['timestamp_creat'];
                    if(empty($foto)){
                        $url_foto='assets/img/User/No-Image.png';
                    }else{
                        $url_foto='assets/img/User/'.$foto.'';
                    }
                    $strtotime=strtotime($timestamp_creat);
                    $datetime_creat=date('d/m/Y H:i',$strtotime);
                    //Tampilkan Data
                    echo '
                        <div class="row mb-4">
                            <div class="col-md-12 text-center mb-3">
                                <img src="'.$url_foto.'" alt="Image" width="200px" height="200px" class="rounded-circle">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"><small>Nama</small></div>
                            <div class="col-8"><small class="text-grayish">'.$nama.'</small></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><small>Email</small></div>
                            <div class="col-8"><small class="text-grayish">'.$email.'</small></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><small>Kontak</small></div>
                            <div class="col-8"><small class="text-grayish">'.$kontak.'</small></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><small>Datetime</small></div>
                            <div class="col-8"><small class="text-grayish">'.$datetime_creat.'</small></div>
                        </div>
                    ';
                }
            }
        }
    }
?>