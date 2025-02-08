<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //Tangkap id_wilayah
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $tingkat=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'tingkat');
        $jenis=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'jenis');
        $nama=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'nama');
        $gelar_pimpinan=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'gelar_pimpinan');
        $nama_pimpinan=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'nama_pimpinan');
        $visi=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'visi');
        $misi=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'misi');
        $alamat=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'alamat');
        $kontak=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'kontak');
        $tahun=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'tahun');
        $dasar_hukum=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'dasar_hukum');
        $updatetime=getDataDetail($Conn,'wilayah_profile','id_wilayah',$id_wilayah,'updatetime');
        $strtotime=strtotime($updatetime);
        $updatetime=date('d/m/Y H:i',$strtotime);
        //Informasi Reverensi
        $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kategori');
        $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
        $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
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

<?php } ?>