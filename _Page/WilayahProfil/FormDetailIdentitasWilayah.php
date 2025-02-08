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
    $strtotime=strtotime($updatetime);
    $updatetime=date('d/m/Y H:i',$strtotime);
    //Informasi Reverensi
    $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kategori');
    $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
    $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
    $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
    $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
    if(empty($id_wilayah_profile)){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '  Wilayah otoritas yang anda kelola belum memiliki profil.';
        echo '  Silahkan lakukan pembaharuan data informasi profil wilayah anda sesuai referensi yang anda miliki.';
        echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }else{
        
    }
?>
    <div class="row mb-3">
        <div class="col md-12 mt-3">
            <b>A. Referensi Wilayah</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Kategori</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$KategoriWilayah"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Provinsi</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$ProvinsiWilayah"; ?></code></div>
    </div>
    <div class="row mb-3">
    <div class="col col-md-3">Kabupaten/Kota</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$KabupatenWilayah"; ?></code></div>
    </div>
    <div class="row mb-3">
    <div class="col col-md-3">Kecamatan</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$KecamatanWilayah"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Kelurahan/Desa</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$DesaWilayah"; ?></code></div>
    </div>
    <div class="row mb-3 border-1 border-top">
        <div class="col md-12 mt-3">
            <b>B. Profil Wilayah</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Tingkat</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$tingkat"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Kategori</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$jenis"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Nama Wilayah</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$nama"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Pimpinan</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$gelar_pimpinan"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Nama Pimpinan</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$nama_pimpinan"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Visi</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$visi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Misi</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$misi"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Alamat Kantor</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$alamat"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Telepon/Kontak</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$kontak"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Tahun Berdiri</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$tahun"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Dasar Hukum</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$dasar_hukum"; ?></code></div>
    </div>
    <div class="row mb-3">
        <div class="col col-md-3">Update</div>
        <div class="col md-9"><code class="text-grayish"><?php echo "$updatetime"; ?></code></div>
    </div>