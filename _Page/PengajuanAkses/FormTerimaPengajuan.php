<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Pengajuan Akses Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
        $email=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'email');
?>
        <input type="hidden" name="id_akses_pengajuan" value="<?php echo "$id_akses_pengajuan"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                Apabila anda memutuskan untuk menerima pengajuan akses ini, maka sistem akan menambahkan akun akses yang bersangkutan langsung pada halaman akses pengguna.
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Nama</div>
            <div class="col-md-8">
                <code class="text text-grayish"><?php echo "$nama"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Email</div>
            <div class="col-md-8">
                <code class="text text-grayish"><?php echo "$email"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="password">Password</label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" name="password" id="PasswordPenerima" class="form-control">
                    <button type="button" class="btn btn-sm btn-dark" id="GeneratePassword" title="Generate Password Otomatis">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
                
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for=""></label>
            </div>
            <div class="col-md-8">
                <input type="checkbox" checked name="kirim_email" id="kirim_email" value="<?php echo "$email"; ?>">
                <code class="text-dark">
                    <label for="kirim_email">Kirim Password Ke Email Pemohon</label>
                </code>
            </div>
        </div>
<?php } ?>