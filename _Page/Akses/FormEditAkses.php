<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['id_akses'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Akses Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Buka data askes
        $nama=getDataDetail($Conn,'akses','id_akses',$id_akses,'nama');
        $kontak=getDataDetail($Conn,'akses','id_akses',$id_akses,'kontak');
        $email=getDataDetail($Conn,'akses','id_akses',$id_akses,'email');
        $akses=getDataDetail($Conn,'akses','id_akses',$id_akses,'akses');
        $id_akses_entitas=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_akses_entitas');
        $id_wilayah=getDataDetail($Conn,'akses','id_akses',$id_akses,'id_wilayah');
        $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
?>
    <input type="hidden" name="id_akses" value="<?php echo "$id_akses"; ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama_edit">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kontak_edit">Kontak/HP</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak_edit" class="form-control" placeholder="+62" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="email_edit">Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email_edit" class="form-control" placeholder="email@domain.com" value="<?php echo "$email"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="akses_edit">Level Akses</label>
        </div>
        <div class="col-md-8">
            <select name="akses" id="akses_edit" class="form-control">
                <option <?php if($akses==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($akses=="Admin"){echo "selected";} ?> value="Admin">Admin</option>
                <option <?php if($akses=="Provinsi"){echo "selected";} ?> value="Provinsi">Provinsi</option>
                <option <?php if($akses=="Kabupaten"){echo "selected";} ?> value="Kabupaten">Kabupaten/Kota</option>
                <option <?php if($akses=="Kecamatan"){echo "selected";} ?> value="Kecamatan">Kecamatan</option>
                <option <?php if($akses=="Desa"){echo "selected";} ?> value="Desa">Desa/Kelurahan</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_akses_entitas_edit">Entitas</label>
        </div>
        <div class="col-md-8">
            <select name="id_akses_entitas" id="id_akses_entitas_edit" class="form-control">
                <option <?php if($id_akses_entitas==""){echo "selected";} ?> value="">Pilih</option>
                <?php
                    //Buka Entitas Akses
                    $query = mysqli_query($Conn, "SELECT*FROM akses_entitas WHERE akses='$akses' ORDER BY entitas ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $IdAksesEntitasList= $data['id_akses_entitas'];
                        $entitas= $data['entitas'];
                        if($IdAksesEntitasList==$id_akses_entitas){
                            echo '<option selected value="'.$IdAksesEntitasList.'">'.$entitas.'</option>';
                        }else{
                            echo '<option value="'.$IdAksesEntitasList.'">'.$entitas.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div id="FormPilihWilayahEdit">
        <!-- Menampilkan Form Wilayah -->
        <?php
            if($akses=="Provinsi"||$akses=="Kabupaten"||$akses=="Kecamatan"||$akses=="Desa"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="provinsi_edit">Provinsi</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="provinsi" id="provinsi_edit">';
                echo '          <option value="">Pilih</option>';
                                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Propinsi'");
                                while ($data = mysqli_fetch_array($query)) {
                                    $ListIdWilayah= $data['id_wilayah'];
                                    $ListProvinsi= $data['propinsi'];
                                    if($NamaPropinsi==$ListProvinsi){
                                        echo '<option selected value="'.$ListIdWilayah.'">'.$ListProvinsi.'</option>';
                                    }else{
                                        echo '<option value="'.$ListIdWilayah.'">'.$ListProvinsi.'</option>';
                                    }
                                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }
            if($akses=="Kabupaten"||$akses=="Kecamatan"||$akses=="Desa"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="kabupaten_edit">Kabupaten</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="kabupaten" id="kabupaten_edit">';
                echo '          <option value="">Pilih</option>';
                                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE propinsi='$NamaPropinsi' AND kategori='Kabupaten'");
                                while ($data = mysqli_fetch_array($query)) {
                                    $ListIdWilayah= $data['id_wilayah'];
                                    $ListKabupaten= $data['kabupaten'];
                                    if($NamaKabupaten==$ListKabupaten){
                                        echo '<option selected value="'.$ListIdWilayah.'">'.$ListKabupaten.'</option>';
                                    }else{
                                        echo '<option value="'.$ListIdWilayah.'">'.$ListKabupaten.'</option>';
                                    }
                                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }
            if($akses=="Kecamatan"||$akses=="Desa"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="kecamatan_edit">Kecamatan</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="kecamatan" id="kecamatan_edit">';
                echo '          <option value="">Pilih</option>';
                                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='Kecamatan'");
                                while ($data = mysqli_fetch_array($query)) {
                                    $ListIdWilayah= $data['id_wilayah'];
                                    $ListKecamatan= $data['kecamatan'];
                                    if($NamaKecamatan==$ListKecamatan){
                                        echo '<option selected value="'.$ListIdWilayah.'">'.$ListKecamatan.'</option>';
                                    }else{
                                        echo '<option value="'.$ListIdWilayah.'">'.$ListKecamatan.'</option>';
                                    }
                                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }
            if($akses=="Desa"){
                echo '<div class="row mb-3">';
                echo '  <div class="col-md-4">';
                echo '      <label for="desa_edit">Desa</label>';
                echo '  </div>';
                echo '  <div class="col-md-8">';
                echo '      <select class="form-control" name="desa" id="desa_edit">';
                echo '          <option value="">Pilih</option>';
                                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'");
                                while ($data = mysqli_fetch_array($query)) {
                                    $ListIdWilayah= $data['id_wilayah'];
                                    $ListDesa= $data['desa'];
                                    if($NamaDesa==$ListDesa){
                                        echo '<option selected value="'.$ListIdWilayah.'">'.$ListDesa.'</option>';
                                    }else{
                                        echo '<option value="'.$ListIdWilayah.'">'.$ListDesa.'</option>';
                                    }
                                }
                echo '      </select>';
                echo '  </div>';
                echo '</div>';
            }
        ?>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="foto_edit">Foto</label>
        </div>
        <div class="col-md-8">
            <input type="file" name="foto" id="foto_edit" class="form-control">
            <code class="text-dark">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</code>
        </div>
    </div>
<?php } ?>
<script>
    //Ketika Akses Diubah, Tampilkan Wilayah
    $('#akses_edit').change(function(){
        var akses = $('#akses_edit').val();
        $('#FormPilihWilayahEdit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/FormPilihWilayahEdit.php',
            data 	    :  {akses: akses},
            success     : function(data){
                $('#FormPilihWilayahEdit').html(data);
            }
        });
        //Menampilkan List Entitas
        $('#id_akses_entitas_edit').html('<option value="">Loading...</option>>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/FormPilihEntitas.php',
            data 	    :  {akses: akses},
            success     : function(data){
                $('#id_akses_entitas_edit').html(data);
            }
        });
    });
    //Ketika Propinsi Dipilih
    $('#provinsi_edit').change(function(){
        var id_wilayah = $('#provinsi_edit').val();
        $('#kabupaten_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKabupaten.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kabupaten_edit').html(data);
            }
        });
        //Kecamatan dan Desa Reset
        $('#kecamatan_edit').html('<option value="">Pilih</option>');
        $('#desa_edit').html('<option value="">Pilih</option>');
    });
    //Ketika Kabupaten Dipilih
    $('#kabupaten_edit').change(function(){
        var id_wilayah = $('#kabupaten_edit').val();
        $('#kecamatan_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListKecamatan.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#kecamatan_edit').html(data);
            }
        });
        //Desa Reset
        $('#desa').html('<option value="">Pilih</option>');
    });
    //Ketika Kecamatan Dipilih
    $('#kecamatan_edit').change(function(){
        var id_wilayah = $('#kecamatan_edit').val();
        $('#desa_edit').html('Loading...');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Akses/ListDesa.php',
            data 	    :  {id_wilayah: id_wilayah},
            success     : function(data){
                $('#desa_edit').html(data);
            }
        });
    });
</script>