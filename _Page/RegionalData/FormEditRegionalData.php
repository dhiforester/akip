<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Tangkap id_wilayah
    if(empty($_POST['id_wilayah'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-6 mb-3">';
        echo '          ID Wilayah Tidak Dapat Ditangkap Oleh Sistem.';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        //Buka data askes
        $QryWilayah = mysqli_query($Conn,"SELECT * FROM wilayah WHERE id_wilayah='$id_wilayah'")or die(mysqli_error($Conn));
        $DataWilayah = mysqli_fetch_array($QryWilayah);
        $id_wilayah= $DataWilayah['id_wilayah'];
        $kategori= $DataWilayah['kategori'];
        $propinsi= $DataWilayah['propinsi'];
        $kabupaten= $DataWilayah['kabupaten'];
        $kecamatan= $DataWilayah['kecamatan'];
        $desa= $DataWilayah['desa'];
?>
    <input type="hidden" name="id_wilayah" id="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
    <div class="row">
        <div class="col-md-12 mt-3">
            <label for="kategori">Kategori</label>
            <input type="text" readonly name="kategori" id="kategori" class="form-control" value="<?php echo "$kategori"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="propinsi">Provinsi</label>
            <input type="text" name="propinsi" id="propinsi" class="form-control" value="<?php echo "$propinsi"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="kabupaten">Kabupaten</label>
            <input type="text" name="kabupaten" id="kabupaten" class="form-control" value="<?php echo "$kabupaten"; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?php echo "$kecamatan"; ?>">
        </div>
        <div class="col-md-6 mt-3">
            <label for="desa">Desa</label>
            <input type="text" name="desa" id="desa" class="form-control" value="<?php echo "$desa"; ?>">
        </div>
    </div>
<?php } ?>