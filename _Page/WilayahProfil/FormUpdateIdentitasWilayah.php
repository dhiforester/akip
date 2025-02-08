<?php 
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Buka Data
    $id_wilayah_profile=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'id_wilayah_profile');
    $tingkat=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'tingkat');
    $jenis=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'jenis');
    $nama=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'nama');
    $gelar_pimpinan=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'gelar_pimpinan');
    $nama_pimpinan=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'nama_pimpinan');
    $visi=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'visi');
    $misi=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'misi');
    $alamat=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'alamat');
    $kontak=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'kontak');
    $tahun=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'tahun');
    $dasar_hukum=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'dasar_hukum');
    $updatetime=getDataDetail($Conn,'wilayah_profile','id_wilayah',$SessionIdWilayah,'updatetime');
?>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="tingkat">Tingkat Wilayah</label>
    </div>
    <div class="col-md-8">
        <select name="tingkat" id="tingkat" class="form-control">
            <option <?php if($tingkat==""){echo "selected";} ?> value="">Pilih</option>
            <option <?php if($tingkat=="1"){echo "selected";} ?> value="1">1</option>
            <option <?php if($tingkat=="2"){echo "selected";} ?> value="2">2</option>
            <option <?php if($tingkat=="3"){echo "selected";} ?> value="3">3</option>
            <option <?php if($tingkat=="4"){echo "selected";} ?> value="4">4</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="jenis">Jenis Wilayah</label>
    </div>
    <div class="col-md-8">
        <select name="jenis" id="jenis" class="form-control">
            <option <?php if($jenis==""){echo "selected";} ?> value="">Pilih</option>
            <option <?php if($jenis=="Provinsi"){echo "selected";} ?> value="Provinsi">Provinsi</option>
            <option <?php if($jenis=="Kabupaten"){echo "selected";} ?> value="Kabupaten">Kabupaten</option>
            <option <?php if($jenis=="Kota"){echo "selected";} ?> value="Kota">Kota</option>
            <option <?php if($jenis=="Kecamatan"){echo "selected";} ?> value="Kecamatan">Kecamatan</option>
            <option <?php if($jenis=="Kelurahan"){echo "selected";} ?> value="Kelurahan">Kelurahan</option>
            <option <?php if($jenis=="Desa"){echo "selected";} ?> value="Desa">Desa</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="nama">Nama Wilayah</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="nama" class="form-control" value="<?php echo "$nama"; ?>">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="gelar_pimpinan">Gelar Pimpinan</label>
    </div>
    <div class="col-md-8">
        <select name="gelar_pimpinan" id="gelar_pimpinan" class="form-control">
            <option <?php if($gelar_pimpinan==""){echo "selected";} ?> value="">Pilih</option>
            <option <?php if($gelar_pimpinan=="Gubernur"){echo "selected";} ?> value="Gubernur">Gubernur</option>
            <option <?php if($gelar_pimpinan=="Wali Kota"){echo "selected";} ?> value="Wali Kota">Wali Kota</option>
            <option <?php if($gelar_pimpinan=="Bupati"){echo "selected";} ?> value="Bupati">Bupati</option>
            <option <?php if($gelar_pimpinan=="Camat"){echo "selected";} ?> value="Camat">Camat</option>
            <option <?php if($gelar_pimpinan=="Kelurahan"){echo "selected";} ?> value="Kelurahan">Kelurahan</option>
            <option <?php if($gelar_pimpinan=="Kepala Desa"){echo "selected";} ?> value="Kepala Desa">Kepala Desa</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="nama_pimpinan">Nama Pimpinan</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="nama_pimpinan" class="form-control" value="<?php echo "$nama_pimpinan"; ?>">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="visi">Visi</label>
    </div>
    <div class="col-md-8">
        <textarea name="visi" id="visi" class="form-control"><?php echo "$visi"; ?></textarea>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="misi">Misi</label>
    </div>
    <div class="col-md-8">
        <textarea name="misi" id="misi" class="form-control"><?php echo "$misi"; ?></textarea>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="alamat">Alamat Kantor</label>
    </div>
    <div class="col-md-8">
        <textarea name="alamat" id="alamat" class="form-control"><?php echo "$alamat"; ?></textarea>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kontak">Telepon/Kontak</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="kontak" class="form-control" value="<?php echo "$kontak"; ?>">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="tahun">Tahun Berdiri</label>
    </div>
    <div class="col-md-8">
        <input type="number" name="tahun" class="form-control" value="<?php echo "$tahun"; ?>">
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <label for="dasar_hukum">Dasar Hukum</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="dasar_hukum" class="form-control" value="<?php echo "$dasar_hukum"; ?>">
        <small class="credit">Dasar Hukum Pendirian</small>
    </div>
</div>