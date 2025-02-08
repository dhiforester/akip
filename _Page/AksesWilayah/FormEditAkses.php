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
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id_wilayah_desa">Desa</label>
        </div>
        <div class="col-md-8">
            <select name="id_wilayah_desa" id="id_wilayah_desa" class="form-control">
                <option value="">Pilih</option>
                <?php
                    $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                    $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa' ORDER BY desa ASC");
                    while ($data = mysqli_fetch_array($query)) {
                        $IdWilayahList= $data['id_wilayah'];
                        $desa= $data['desa'];
                        if($IdWilayahList==$id_wilayah){
                            echo '<option selected value="'.$IdWilayahList.'">'.$desa.'</option>';
                        }else{
                            echo '<option value="'.$IdWilayahList.'">'.$desa.'</option>';
                        }
                        
                    }
                ?>
            </select>
        </div>
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
   
</script>