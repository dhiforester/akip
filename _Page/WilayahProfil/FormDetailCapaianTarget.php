<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_target_capaian
    if(empty($_POST['id_target_capaian'])){
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger mb-3">';
        echo '          ID Target Capaian Tidak Boleh Kosong';
        echo '      </div>';
        echo '  </div>';
    }else{
        $id_target_capaian=$_POST['id_target_capaian'];
        //Buka data
        $id_wilayah=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'id_wilayah');
        $periode=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'periode');
        $target_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_miskin');
        $capaian_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_miskin');
        $persen_miskin=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_miskin');
        $target_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_stunting');
        $capaian_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_stunting');
        $persen_stunting=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_stunting');
        $target_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_ikm');
        $capaian_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_ikm');
        $persen_ikm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_ikm');
        $target_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'target_idm');
        $capaian_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'capaian_idm');
        $persen_idm=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'persen_idm');
        $updatetime=getDataDetail($Conn,'target_capaian','id_target_capaian',$id_target_capaian,'updatetime');
?>
    <div class="row">
        <div class="col-md-12">
            <ol>
                <li class="mb-3">
                    <b>Keluarga Miskin</b>
                    <ul>
                        <li>
                            Target : <code class="text-grayish"><?php echo "$target_miskin"; ?></code>
                        </li>
                        <li>
                            Capaian : <code class="text-grayish"><?php echo "$capaian_miskin"; ?></code>
                        </li>
                        <li>
                            Persentase : <code class="text-grayish"><?php echo "$persen_miskin %"; ?></code>
                        </li>
                    </ul>
                </li>
                <li class="mb-3">
                    <b>Pencegahan Stunting</b>
                    <ul>
                        <li>
                            Target : <code class="text-grayish"><?php echo "$target_stunting"; ?></code>
                        </li>
                        <li>
                            Capaian : <code class="text-grayish"><?php echo "$capaian_stunting"; ?></code>
                        </li>
                        <li>
                            Persentase : <code class="text-grayish"><?php echo "$persen_stunting %"; ?></code>
                        </li>
                    </ul>
                </li>
                <li class="mb-3">
                    <b>Indeks Kepuasan Masyarakat</b>
                    <ul>
                        <li>
                            Target : <code class="text-grayish"><?php echo "$target_ikm"; ?></code>
                        </li>
                        <li>
                            Capaian : <code class="text-grayish"><?php echo "$capaian_ikm"; ?></code>
                        </li>
                        <li>
                            Persentase : <code class="text-grayish"><?php echo "$persen_ikm %"; ?></code>
                        </li>
                    </ul>
                </li>
                <li class="mb-3">
                    <b>Indeks Desa Membangun</b>
                    <ul>
                        <li>
                            Target : <code class="text-grayish"><?php echo "$target_idm"; ?></code>
                        </li>
                        <li>
                            Capaian : <code class="text-grayish"><?php echo "$capaian_idm"; ?></code>
                        </li>
                        <li>
                            Persentase : <code class="text-grayish"><?php echo "$persen_idm %"; ?></code>
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>
<?php } ?>