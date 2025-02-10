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
                    <div class="col-6 col-md-3"><small class="credit">Nama</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$SessionNama"; ?></small></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-6 col-md-3"><small class="credit">Email</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$SessionEmail"; ?></small></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-6 col-md-3"><small class="credit">Kontak</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$SessionKontak"; ?></small></div>
                </div>
                <div class="row mt-2 border-1 border-black"> 
                    <div class="col-6 col-md-3"><small class="credit">Tgl.Daftar</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$SessionAksesCreat"; ?></small></div>
                </div>
                <div class="row mt-2 border-1 border-black"> 
                    <div class="col-6 col-md-3"><small class="credit">Akses</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$SessionAkses"; ?></small></div>
                </div>
                <div class="row mt-2 border-1 border-black"> 
                    <div class="col-6 col-md-3"><small class="credit">Session Expired</small></div>
                    <div class="col-6 col-md-9"><small class="credit"><?php echo "$session_timestamp_expired"; ?></small></div>
                </div>
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