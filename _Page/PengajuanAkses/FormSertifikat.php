<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Validasi Akses
    if(empty($SessionIdAkses)){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Sesi Login Sudah Berakhir! Silahkan Login Ulang!';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['id_akses_pengajuan'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Pengajuan Akses Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
            $id_wilayah=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'id_wilayah');
            $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
            $email=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'email');
            $tanggal=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'tanggal');
            //Format Tanggal
            $strtotime=strtotime($tanggal);
            $TanggalFormat=date('d/m/Y', $strtotime);
            $id_akses=getDataDetail($Conn,'akses','email',$email,'id_akses');
            if(empty($id_akses)){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      Pengajuan akses belum diterima, atau mungkin terjadi kesalahan pada saat membuatkan akses';
                echo '  </div>';
                echo '</div>';
            }else{
                //Buat Token
                $token_dokumen="Sertifikat-$id_akses_pengajuan-$id_wilayah-$strtotime-$id_akses";
                $base64String = base64_encode($token_dokumen);
?>
        <div class="row mb-3">
            <div class="col col-md-3">Tanggal</div>
            <div class="col col-md-9">
                <code class="text text-grayish"><?php echo "$TanggalFormat"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-3">Nama</div>
            <div class="col col-md-9">
                <code class="text text-grayish"><?php echo "$nama"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-3">Email</div>
            <div class="col col-md-9">
                <code class="text text-grayish"><?php echo "$email"; ?></code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-3">Document Name</div>
            <div class="col col-md-9">
                <code class="text text-grayish">Sertifikat Bimtek</code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-3">Filetype</div>
            <div class="col col-md-9">
                <code class="text text-grayish">.PDF</code>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-3">
                <label for="url">URL</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <input type="text" name="url" class="form-control" id="url" value="<?php echo "$base_url/GenerateDocument.php?id=$base64String"; ?>">
                    <a href="<?php echo "$base_url/GenerateDocument.php?id=$base64String"; ?>" target="_blank" class="btn btn-md btn-primary">
                        <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        </div>
<?php 
            } 
        } 
    } 
?>