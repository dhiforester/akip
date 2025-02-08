<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'scSId4dAFP');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        include "_Config/SettingEmail.php";
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengaturan email gateway.';
                    echo '  Hubungkan aplikasi dengan akun web mail untuk mempermudah pengguna pada saat melakukan validasi akun.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="javascript:void(0);" id="ProsesSettingEmail">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-envelope"></i> Email Gateway
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="url_service">URL Service</i></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="url_service" id="url_service" class="form-control" required value="<?php echo "$url_service"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="url_provider">URL Provider SMTP</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="url_provider" id="url_provider" class="form-control" required value="<?php echo "$url_provider"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="port_gateway">PORT</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="port_gateway" id="port_gateway" class="form-control" required value="<?php echo "$port_gateway"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="email_gateway">Alamat Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="email_gateway" id="email_gateway" class="form-control" required value="<?php echo "$email_gateway"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="password_gateway">Password</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="password_gateway" id="password_gateway" class="form-control" required value="<?php echo "$password_gateway"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="nama_pengirim">Nama Pengirim</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required value="<?php echo "$nama_pengirim"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-right" id="NotifikasiSimpanSettingEmail">
                                    <small class="text-dark">Pastikan pengaturan email anda sudah benar</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#ModalTestSendEmail">
                                <i class="bi bi-send"></i> Coba Kirim Email
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>