<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_file_store
    if(empty($_POST['id_file_store'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      id_file_store Data Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_file_store=$_POST['id_file_store'];
        $id_referensi_bukti=getDataDetail($Conn,'file_store','id_file_store',$id_file_store,'id_referensi_bukti');
        $nama_bukti=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'nama_bukti');
        $deskripsi=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'deskripsi');
        $max_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'max_file');
        $type_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'type_file');
?>
        <input type="hidden" name="id_file_store" value="<?php echo "$id_file_store"; ?>">
        <div class="row mb-3">
            <div class="col col-md-12 text-center">
                <small class="credit">
                    <code class="text text-dark">Nama Dokumen/Lampiran</code>
                </small>
            </div>
            <div class="col col-md-12 text-center"><b>"<?php echo "$nama_bukti"; ?>"</b></div>
        </div>
        <div class="row mb-3">
            <div class="col col-md-12 text-center">
                <small class="credit">
                    <code class="text text-dark">
                        Dengan membuka kunci, maka pihak desa bisa melakukan perubahan pada dokumen tersebut.
                    </code>
                </small>
            </div>
        </div>
<?php
    }
?>