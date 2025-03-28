<?php
    date_default_timezone_set('Asia/Jakarta');
    //Membuka Data Akses Berdasarkan SessionIdAkses
    $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses= ?");
    $Qry->bind_param("s", $SessionIdAkses);
    if (!$Qry->execute()) {
        $error=$Conn->error;
        echo '
            <div class="alert alert-danger">
                <small>'.$error.'</small>
            </div>
        ';
    }else{
        $Result = $Qry->get_result();
        $Data = $Result->fetch_assoc();
        $Qry->close();
        if(empty($Data['id_akses'])){
            echo '
                <div class="alert alert-danger">
                    <small>Profil Akses Anda Tidak Ditemukan ID: '.$SessionIdAkses.'</small>
                </div>
            ';
        }else{
            //Buka Data
            $nama=$Data['nama'];
            $kontak=$Data['kontak'];
            $email=$Data['email'];
            $akses=$Data['akses'];
            $timestamp_creat=$Data['timestamp_creat'];
            $foto=$Data['foto'];
            if(empty($foto)){
                $foto="No-Image.png";
            }
            $strtotime=strtotime($timestamp_creat);
            $UpdateTime=date('d/m/Y H:i T',$strtotime);
?>
        <div class="row mb-3">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '  <small class="modal-text">';
                    echo '      Berikut ini adalah halaman profil pengguna. Hanya anda yang bisa melihat informasi pada halaman ini. ';
                    echo '      Anda bisa mengelola informasi profil, mengubah foto dan password anda sendiri.';
                    echo '      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '  </small>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title">
                            <i class="bi bi-info-circle"></i> Informasi Pengguna
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 mb-3 text-center">
                                <img src="assets/img/User/<?php echo "$foto"; ?>" alt="" width="180px" height="180px" class="rounded-circle">
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <small>Nama</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish"><?php echo "$nama"; ?></small>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <small>Email</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish"><?php echo "$email"; ?></small>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <small>Kontak/HP</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish"><?php echo "$kontak"; ?></small>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <small>Akses</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish"><?php echo "$akses"; ?></small>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <small>Created</small>
                                    </div>
                                    <div class="col-8">
                                        <small class="text text-grayish"><?php echo "$UpdateTime"; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-floating btn-md btn-outline-grayish">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-floating btn-md btn-outline-grayish">
                            <i class="bi bi-key"></i>
                        </button>
                        <button type="button" class="btn btn-floating btn-md btn-outline-grayish">
                            <i class="bi bi-image"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b class="card-title"><i class="bi bi-bar-chart"></i> Log Aktivitas</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12" id="MenampilkanTabelAktivitas">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
?>