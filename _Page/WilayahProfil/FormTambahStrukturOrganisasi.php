<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
?>
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
        <label for="jabatan">Jabatan</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="jabatan" id="jabatan" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="NIP">NIP</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="NIP" id="NIP" class="form-control">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="part_of">Atasan</label>
    </div>
    <div class="col-md-8">
        <select name="part_of" id="part_of" class="form-control">
            <option value="">Pilih</option>
            <?php
                $QrySo = "SELECT * FROM struktur_organisasi WHERE id_wilayah='$SessionIdWilayah'";
                $DataSo  =mysqli_query($Conn, $QrySo);
                while($x = mysqli_fetch_array($DataSo)){
                    $id_struktur_organisasi= $x["id_struktur_organisasi"];
                    $nama= $x["nama"];
                    $jabatan= $x["jabatan"];
                    echo '<option value="'.$id_struktur_organisasi.'">'.$nama.' ('.$jabatan.')</option>';
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
        <small class="credit">Maximum File 2 Mb (PNG, JPG, JPEG, GIF)</small>
    </div>
</div>