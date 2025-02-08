<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_penduduk
    if(empty($_POST['id_penduduk'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_penduduk=$_POST['id_penduduk'];
        $nik=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'nik');
        $kk=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'kk');
        $nama=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'nama');
        $kontak=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'kontak');
        $alamat=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'alamat');
        $id_wilayah=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'id_wilayah');
        $propinsi=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'propinsi');
        $kabupaten=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'kabupaten');
        $kecamatan=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'kecamatan');
        $desa=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'desa');
        $gender=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'gender');
        $pernikahan=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'pernikahan');
        $pekerjaan=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'pekerjaan');
        $tempat_lahir=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'tempat_lahir');
        $tanggal_lahir=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'tanggal_lahir');
        $hidup=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'hidup');
        $keberadaan=getDataDetail($Conn,'penduduk','id_penduduk',$id_penduduk,'keberadaan');
?>
    <input type="hidden" name="id_penduduk" id="id_penduduk" class="form-control" value="<?php echo "$id_penduduk"; ?>">
    <div class="row mb-3">
        <div class="col-md-12">
            <b>A. Identitas Penduduk</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nik">Nomor KTP (NIK)</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nik" id="nik" class="form-control" value="<?php echo "$nik"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kk">Kartu Keluarga (KK)</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kk" id="kk" class="form-control" value="<?php echo "$kk"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama">Nama Lengkap</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo "$nama"; ?>">
        </div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col-md-12 mt-3">
            <b>B. Kontak & Alamat</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="kontak">Kontak/HP</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="kontak" id="kontak" class="form-control" placeholder="+62" value="<?php echo "$kontak"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="alamat">Alamat Tinggal</label>
        </div>
        <div class="col-md-8">
            <textarea name="alamat" id="alamat" class="form-control"><?php echo "$alamat"; ?></textarea>
        </div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col-md-12 mt-3">
            <b>C. Tempat, Tanggal Lahir</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="tempat_lahir">Tempat Lahir</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php echo "$tempat_lahir"; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="tanggal_lahir">Tanggal Lahir</label>
        </div>
        <div class="col-md-8">
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?php echo "$tanggal_lahir"; ?>">
        </div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col-md-12 mt-3">
            <b>D. Status  Pernikahan</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="gender">Gender</label>
        </div>
        <div class="col-md-8">
            <select name="gender" id="gender" class="form-control">
                <option <?php if($gender==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($gender=="Laki-laki"){echo "selected";} ?> value="Laki-laki">Laki-laki</option>
                <option <?php if($gender=="Perempuan"){echo "selected";} ?> value="Perempuan">Perempuan</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="pernikahan">Status Pernikahan</label>
        </div>
        <div class="col-md-8">
            <select name="pernikahan" id="pernikahan" class="form-control">
                <option <?php if($pernikahan==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($pernikahan=="Lajang"){echo "selected";} ?> value="Lajang">Lajang</option>
                <option <?php if($pernikahan=="Menikah"){echo "selected";} ?> value="Menikah">Menikah</option>
                <option <?php if($pernikahan=="Janda"){echo "selected";} ?> value="Janda">Janda</option>
                <option <?php if($pernikahan=="Duda"){echo "selected";} ?> value="Duda">Duda</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="pekerjaan">Pekerjaan</label>
        </div>
        <div class="col-md-8">
            <select name="pekerjaan" id="pekerjaan" class="form-control">
                <option <?php if($pekerjaan==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($pekerjaan=="Tidak Bekerja"){echo "selected";} ?> value="Tidak Bekerja">Tidak Bekerja</option>
                <option <?php if($pekerjaan=="Pelajar"){echo "selected";} ?> value="Pelajar">Pelajar</option>
                <option <?php if($pekerjaan=="Wirausaha, Pedagang"){echo "selected";} ?> value="Wirausaha, Pedagang">Wirausaha, Pedagang</option>
                <option <?php if($pekerjaan=="Karyawan Swasta"){echo "selected";} ?> value="Karyawan Swasta">Karyawan Swasta</option>
                <option <?php if($pekerjaan=="PNS, TNI POLRI"){echo "selected";} ?> value="PNS, TNI POLRI">PNS, TNI POLRI</option>
            </select>
        </div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col-md-12 mt-3">
            <b>E. Status Keberadaan</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="hidup">Hidup/Mati</label>
        </div>
        <div class="col-md-8">
            <select name="hidup" id="hidup" class="form-control">
                <option <?php if($hidup=="Hidup"){echo "selected";} ?> value="Hidup">Hidup</option>
                <option <?php if($hidup=="Mati"){echo "selected";} ?> value="Mati">Mati</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="keberadaan">Keberadaan</label>
        </div>
        <div class="col-md-8">
            <select name="keberadaan" id="keberadaan" class="form-control">
                <option <?php if($keberadaan=="Ada"){echo "selected";} ?> value="Ada">Ada</option>
                <option <?php if($keberadaan=="Pindah"){echo "selected";} ?> value="Pindah">Pindah</option>
            </select>
        </div>
    </div>
<?php } ?>