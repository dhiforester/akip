<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    //Tangkap id_akses
    if(empty($_GET['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_GET['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $nama_akses= $DataDetailAkses['nama'];
        $kontak_akses= $DataDetailAkses['kontak'];
        $email_akses = $DataDetailAkses['email'];
        $password= $DataDetailAkses['password'];
        $Akses= $DataDetailAkses['akses'];
?>
    <form action="javascript:void(0);" id="ProsesEditAkses123">
        <div class="card mt-5">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?Page=MyProfile" class="btn btn-md btn-block btn-dark">
                            <i class="bi bi-arrow-90deg-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" name="id_akses" id="id_akses_edit" value="<?php echo "$id_akses"; ?>">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="nama">Nama Lengkap</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="nama" id="nama_akses_edit" class="form-control" value="<?php echo "$nama_akses"; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="kontak_akses_edit">Nomor Kontak</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="kontak" id="kontak_akses_edit" class="form-control" value="<?php echo "$kontak_akses"; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="email_akses">Alamat Email</label>
                    </div>
                    <div class="col-md-9">
                        <input type="email" name="email" id="email_akses_edit" class="form-control" value="<?php echo "$email_akses"; ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="image_akses">Photo Profile</label>
                    </div>
                    <div class="col-md-9">
                        <input type="file" name="image_akses" id="image_akses_edit" class="form-control">
                        <small class="credit">Maksimal file 2 Mb (PNG, JPG, JPEG, GIF)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9" id="NotifikasiEditProfile">
                        <small class="text-primary">Pastikan bahwa data yang anda input sudah sesuai</small>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-md btn-primary w-100">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>