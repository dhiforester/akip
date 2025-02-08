<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap GetUploadDraft
    if(empty($_POST['GetUploadDraft'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      Parameter Data Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $GetUploadDraft=$_POST['GetUploadDraft'];
        $explode=explode(',',$GetUploadDraft);
        if(empty($explode['0'])){
            echo '<div class="row">';
            echo '  <div class="col col-md-12 text-center text-danger">';
            echo '      ID Evaluasi Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($explode['1'])){
                echo '<div class="row">';
                echo '  <div class="col col-md-12 text-center text-danger">';
                echo '      ID Reverensi Bukti Jawaban Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_evaluasi=$explode['0'];
                $id_referensi_bukti=$explode['1'];
                //Buka Data Referensi
                $nama_bukti=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'nama_bukti');
                $type_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'type_file');
                $max_file=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'max_file');
                $deskripsi=getDataDetail($Conn,'referensi_bukti','id_referensi_bukti',$id_referensi_bukti,'deskripsi');
?>
                <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                <input type="hidden" name="id_referensi_bukti" value="<?php echo "$id_referensi_bukti"; ?>">
                <div class="row mb-3">
                    <div class="col col-md-3"><b>Nama Berkas</b></div>
                    <div class="col col-md-9">
                        <small class="credit">
                            <code class="text text-dark"><?php echo "$nama_bukti"; ?></code>
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col col-md-3"><b>Deskripsi</b></div>
                    <div class="col col-md-9">
                        <small class="credit">
                            <code class="text text-dark"><?php echo "$deskripsi"; ?></code>
                        </small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col col-md-3">
                        <label for="file_draft">
                            <b>Upload File</b>
                        </label>
                    </div>
                    <div class="col col-md-9">
                        <input type="file" class="form-control" name="file_draft" id="file_draft">
                        <small class="credit">
                            <code class="text-dark">
                                Keterangan :
                                <ol>
                                    <li>File Maksimal <?php echo "$max_file MB"; ?></li>
                                    <li>
                                        Format File 
                                        <?php 
                                            $DataTipe = json_decode($type_file, true);
                                            foreach($DataTipe as $ListTipe){
                                                $Tipe=$ListTipe['type'];
                                                $TipeName=MimeTiTipe($Tipe);
                                                echo "$TipeName, ";
                                            }
                                        ?>
                                    </li>
                                </ol>
                            </code>
                        </small>
                    </div>
                </div>
<?php
            }
        }
    }
?>