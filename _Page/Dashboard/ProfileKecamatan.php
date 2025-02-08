<?php
include "../../_Config/Connection.php";
include "../../_Config/Session.php";
include "../../_Config/Function.php";
include "../../_Config/SettingGeneral.php";
//Time Zone
date_default_timezone_set('Asia/Jakarta');
//Time Now Tmp
$now=date('Y-m-d H:i:s');
if(empty($_POST['id_wilayah'])){
    echo '<div class="row">';
    echo '  <div class="col-md-12 text-center text-danger">';
    echo '      ID Wilayah Tidak Boleh Kosong!';
    echo '  </div>';
    echo '</div>';
}else{
    $id_wilayah=$_POST['id_wilayah'];
    //Buka Nama Kecamatan
    $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
    $JumlahDesa=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'"));
    if(empty($JumlahDesa)){
        echo '<div class="card-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center text-danger">';
        echo '          Data Desa Tidak Ditemukan';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        //Arraykan Desa
        $JumlahPendudukTingkatKecamatan=0;
        $JumlahDesaTargetCapaian=0;
        $JumlahTragetCapaianKkMiskin=0;
        $JumlahTragetCapaianStunting=0;
        $JumlahTragetCapaianIkm=0;
        $JumlahTragetCapaianIdm=0;
        $QryDesa = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kabupaten='$NamaWilayahOfficial' AND kecamatan='$NamaKecamatan' AND kategori='desa'");
        while ($DataDesa = mysqli_fetch_array($QryDesa)) {
            $id_wilayah_desa= $DataDesa['id_wilayah'];
            //Jumlah Penduduk
            $JumlahPenduduk=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM penduduk WHERE id_wilayah='$id_wilayah_desa' AND hidup='Hidup'"));
            $JumlahPendudukTingkatKecamatan=$JumlahPendudukTingkatKecamatan+$JumlahPenduduk;
            $ValidasiTargetCapaian=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM target_capaian WHERE id_wilayah='$id_wilayah_desa'"));
            if(!empty($ValidasiTargetCapaian)){
                $JumlahDesaTargetCapaian=$JumlahDesaTargetCapaian+1;
                //KK Miskin
                $persen_miskin=getDataDetail($Conn,'target_capaian','id_wilayah',$id_wilayah_desa,'persen_miskin');
                $JumlahTragetCapaianKkMiskin=$JumlahTragetCapaianKkMiskin+$persen_miskin;
                //Stunting
                $persen_stunting=getDataDetail($Conn,'target_capaian','id_wilayah',$id_wilayah_desa,'persen_stunting');
                $JumlahTragetCapaianStunting=$JumlahTragetCapaianStunting+$persen_stunting;
                //IKM
                $persen_ikm=getDataDetail($Conn,'target_capaian','id_wilayah',$id_wilayah_desa,'persen_ikm');
                $JumlahTragetCapaianIkm=$JumlahTragetCapaianIkm+$persen_ikm;
                //IDM
                $persen_idm=getDataDetail($Conn,'target_capaian','id_wilayah',$id_wilayah_desa,'persen_idm');
                $JumlahTragetCapaianIdm=$JumlahTragetCapaianIdm+$persen_idm;
            }else{
                $JumlahDesaTargetCapaian=$JumlahDesaTargetCapaian+0;
                //KK Miskin
                $persen_miskin=0;
                $JumlahTragetCapaianKkMiskin=$JumlahTragetCapaianKkMiskin+0;
                //Stunting
                $JumlahTragetCapaianStunting=$JumlahTragetCapaianStunting+0;
                //Ikm
                $JumlahTragetCapaianIkm=$JumlahTragetCapaianIkm+0;
                //IDM
                $JumlahTragetCapaianIdm=$JumlahTragetCapaianIdm+0;
            }
        }
        if(!empty($JumlahTragetCapaianKkMiskin)){
            $RataRataKkMiskin=$JumlahTragetCapaianKkMiskin/$JumlahDesaTargetCapaian;
        }else{
            $RataRataKkMiskin=0;
        }
        if(!empty($JumlahTragetCapaianStunting)){
            $RataRataStunting=$JumlahTragetCapaianStunting/$JumlahDesaTargetCapaian;
        }else{
            $RataRataStunting=0;
        }
        if(!empty($JumlahTragetCapaianIkm)){
            $RataRataIkm=$JumlahTragetCapaianIkm/$JumlahDesaTargetCapaian;
        }else{
            $RataRataIkm=0;
        }
        if(!empty($JumlahTragetCapaianIdm)){
            $RataRataIdm=$JumlahTragetCapaianIdm/$JumlahDesaTargetCapaian;
        }else{
            $RataRataIdm=0;
        }
?>
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li>
                        <small class="credit">
                            Jumlah Desa : <code class="text-secondary"><?php echo "$JumlahDesa"; ?></code>
                        </small>
                    </li>
                    <li>
                        <small class="credit">
                            Data Penduduk : <code class="text-secondary"><?php echo "$JumlahPendudukTingkatKecamatan Jiwa"; ?></code>
                        </small>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <small class="credit">
                            Rata-Rata Capaian KK Miskin : <code class="text-secondary"><?php echo "$RataRataKkMiskin %"; ?></code>
                        </small>
                    </li>
                    <li>
                        <small class="credit">
                            Rata-Rata Capaian Stunting : <code class="text-secondary"><?php echo "$RataRataStunting %"; ?></code>
                        </small>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <small class="credit">
                            Rata-Rata IKM : <code class="text-secondary"><?php echo "$RataRataIkm %"; ?></code>
                        </small>
                    </li>
                    <li>
                        <small class="credit">
                            Rata-Rata IDM : <code class="text-secondary"><?php echo "$RataRataIdm %"; ?></code>
                        </small>
                    </li>
                </ul>
            </div>
        </div>
<?php }} ?>