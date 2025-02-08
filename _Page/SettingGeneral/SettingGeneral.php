<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'POGtxosrhg');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman pengaturan umum.';
                    echo '  Atur tampilan, meta tag dan base URL yang digunakan aplikasi sebagai pengaturan standar yang akan ditampilkan kepada pengguna.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="javascript:void(0);" id="ProsesSettingGeneral">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Form Pengaturan Aplikasi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="title_page">Judul Aplikasi</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="title_page" id="title_page" class="form-control" placeholder="Your Business" value="<?php echo "$title_page"; ?>">
                                    <small>Maksimal 20 karakter</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="kata_kunci">Kata Kunci</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="kata_kunci" id="kata_kunci" class="form-control" value="<?php echo "$kata_kunci"; ?>">
                                    <small>(Ex: keyword1, keyword2, keyword3)</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="deskripsi">Deskripsi</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"><?php echo "$deskripsi"; ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="alamat_bisnis">Alamat Operasional</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="alamat_bisnis" id="alamat_bisnis" cols="30" rows="3" class="form-control"><?php echo "$alamat_bisnis"; ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="email">Alamat Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email_bisnis" id="email_bisnis" class="form-control" placeholder="email@domain.com" value="<?php echo "$email_bisnis"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="telepon_bisnis">Kontak/HP</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="telepon_bisnis" id="telepon_bisnis" class="form-control" placeholder="+62" value="<?php echo "$telepon_bisnis"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="favicon">Favicon</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="favicon" id="favicon" class="form-control">
                                    <small>
                                        Maximum Ukuran File 2 Mb 
                                        <?php
                                            if(!empty($favicon)){
                                                echo '<a href="assets/img/'.$favicon.'" target="_blank">Lihat Favicon</a>';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="logo">Logo</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="logo" id="logo" class="form-control">
                                    <small>
                                        Maximum Ukuran File 2 Mb
                                        <?php
                                            if(!empty($logo)){
                                                echo '<a href="assets/img/'.$logo.'" target="_blank">Lihat Logo</a>';
                                            }
                                        ?>
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="base_url">Base URL</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="base_url" id="base_url" class="form-control" placeholder="https://" value="<?php echo "$base_url"; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="id_wilayah">Base URL</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="id_wilayah" id="id_wilayah" class="form-control" value="<?php echo "$SettingIdWilayahUtama"; ?>">
                                    <small>
                                        Masukan ID wilayah Kabupaten. Apabila ID tidak valid/kosong maka sistem akan menampilkan dashboard umum secara nasional.
                                    </small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9 text-right" id="NotifikasiSimpanSettingGeneral">
                                    <small class="text-dark">Pastikan pengaturan yang anda input sudah sesuai</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>