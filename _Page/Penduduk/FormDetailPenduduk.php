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
    <div class="row mb-3">
        <div class="col col-md-12"><b>A. Identitas Penduduk</b></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">No. KTP (NIK)</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$nik"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">No Kartu Keluarga</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$kk"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Nama Lengkap</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$nama"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Tempat Lahir</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$tempat_lahir"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Tanggal Lahir</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$tanggal_lahir"; ?></code></div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col col-md-12"></div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col col-md-12"><b>B. Kontak & Alamat Tinggal</b></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Kontak</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$kontak"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Provinsi</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$propinsi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Kabupaten/Kota</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$kabupaten"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Kecamatan</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$kecamatan"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Desa/Keluarahan</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$desa"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Alamat</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$alamat"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Nama Lengkap</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$nama"; ?></code></div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col col-md-12"></div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col col-md-12"><b>C. Gender, Status & Pekerjaan</b></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Gender</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$gender"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Status Pernikahan</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$pernikahan"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Pekerjaan</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$pekerjaan"; ?></code></div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col col-md-12"></div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col col-md-12"><b>D. Status Data Penduduk</b></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Hidup/Mati</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$hidup"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-6">Keberadaan</div>
        <div class="col col-md-6"><code class="text text-grayish"><?php echo "$keberadaan"; ?></code></div>
    </div>
<?php } ?>