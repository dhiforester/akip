<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-danger text-danger">ID Wilayah Tidak Boleh Kosong!</div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
?>
    <input type="hidden" name="id_wilayah" value="<?php echo $id_wilayah; ?>">
    <input type="hidden" name="akses" value="Desa">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kontak">Kontak/HP</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak" class="form-control" placeholder="+62">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="email">Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_akses_entitas">Entitas</label>
        </div>
        <div class="col-md-8">
            <select name="id_akses_entitas" id="id_akses_entitas" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $query = mysqli_query($Conn, "SELECT*FROM akses_entitas WHERE akses='Desa'");
                    while ($data = mysqli_fetch_array($query)) {
                        $id_akses_entitas= $data['id_akses_entitas'];
                        $entitas= $data['entitas'];
                        echo '<option value="'.$id_akses_entitas.'">'.$entitas.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="foto">Foto</label>
        </div>
        <div class="col-md-8">
            <input type="file" name="foto" id="foto" class="form-control">
            <code class="text-dark">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="password1">Password</label>
        </div>
        <div class="col-md-8">
            <input type="password" name="password1" id="password1" class="form-control">
            <code class="text-dark">Password hanya boleh terdiri dari 6-20 karakter angka dan huruf</code>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="password2">Ulangi Password</label>
        </div>
        <div class="col-md-8">
            <input type="password" name="password2" id="password2" class="form-control">
            <small class="credit">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Tampilkan" id="TampilkanPassword" name="TampilkanPassword">
                    <label class="form-check-label" for="TampilkanPassword">
                        Tampilkan Password
                    </label>
                </div>
            </small>
        </div>
    </div>
<?php } ?>

<script>
    //Kondisi saat tampilkan password
    $('.form-check-input').click(function(){
        if($(this).is(':checked')){
            $('#password1').attr('type','text');
            $('#password2').attr('type','text');
        }else{
            $('#password1').attr('type','password');
            $('#password2').attr('type','password');
        }
    });
</script>