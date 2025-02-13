<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          Access ID Data Undefined.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
?>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="password1">Password</label>
            <input type="password" name="password1" id="password1_edit" class="form-control">
            <small class="credit">Password hanya boleh terdiri dari 6-20 karakter angka dan huruf</small>
        </div>
        <div class="col-md-12 mt-3">
            <label for="password2">Ulangi Password</label>
            <input type="password" name="password2" id="password2_edit" class="form-control">
            <small class="credit">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword2" name="TampilkanPassword2">
                    <label class="form-check-label" for="TampilkanPassword2">
                        Tampilkan Password
                    </label>
                </div>
            </small>
        </div>
    </div>
<?php } ?>