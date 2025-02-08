<div class="card mt-5">
    <div class="card-header">
        <b class="card-title">Detail Akses</b>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-4 text-center">
                <img src="assets/img/User/<?php echo "$SessionGambar"; ?>" alt="" width="70%" class="rounded-circle">
            </div>
            <div class="col-md-10 text-left">
                <div class="row mt-2"> 
                    <div class="col col-md-12"><dt>1. Identitas Pengguna</dt></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col col-md-6"><small class="credit">Nama Lengkap</small></div>
                    <div class="col col-md-6"><small class="credit"><?php echo "$SessionNama"; ?></small></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col col-md-6"><small class="credit">Email Akses</small></div>
                    <div class="col col-md-6"><small class="credit"><?php echo "$SessionEmail"; ?></small></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col col-md-6"><small class="credit">Kontak Akses</small></div>
                    <div class="col col-md-6"><small class="credit"><?php echo "$SessionKontak"; ?></small></div>
                </div>
                <div class="row mt-2 border-1 border-black"> 
                    <div class="col col-md-6"><small class="credit">Level Akses</small></div>
                    <div class="col col-md-6"><small class="credit"><?php echo "$SessionAkses"; ?></small></div>
                </div>
                <?php 
                    if($SessionAkses=="Kecamatan"){ 
                        $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                        $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                        $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                ?>
                    <div class="row mt-2"> 
                        <div class="col col-md-12"><dt>2. Otoritas Pengguna</dt></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Provinsi</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaPropinsi"; ?></small></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Kabupaten/Kota</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaKabupaten"; ?></small></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Kecamatan</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaKecamatan"; ?></small></div>
                    </div>
                <?php } ?>
                <?php 
                    if($SessionAkses=="Desa"){ 
                        $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                        $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                        $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                        $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
                ?>
                    <div class="row mt-2"> 
                        <div class="col col-md-12"><dt>2. Otoritas Pengguna</dt></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Provinsi</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaPropinsi"; ?></small></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Kabupaten/Kota</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaKabupaten"; ?></small></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Kecamatan</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaKecamatan"; ?></small></div>
                    </div>
                    <div class="row mt-2"> 
                        <div class="col col-md-6"><small class="credit">Desa</small></div>
                        <div class="col col-md-6"><small class="credit"><?php echo "$NamaDesa"; ?></small></div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-5 text-left">
                
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-2 mb-2">
                <a href="index.php?Page=MyProfile&Sub=EditProfile&id_akses=<?php echo "$SessionIdAkses"; ?>" class="btn btn-sm btn-success btn-block">
                    <i class="bi bi-pencil-square"></i> Ubah Profil
                </a>
            </div>
            <div class="col-md-2 mb-2">
                <a href="index.php?Page=MyProfile&Sub=ChangePassword&id_akses=<?php echo "$SessionIdAkses"; ?>" class="btn btn-sm btn-success btn-block">
                    <i class="bi bi-person-check"></i> Ganti Password
                </a>
            </div>
        </div>
    </div>
</div>