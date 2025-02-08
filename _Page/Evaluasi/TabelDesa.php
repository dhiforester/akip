<?php
include "../../_Config/Connection.php";
include "../../_Config/Session.php";
include "../../_Config/Function.php";
include "../../_Config/SettingGeneral.php";
//Time Zone
date_default_timezone_set('Asia/Jakarta');
$now=date('Y-m-d H:i:s');
if(empty($_POST['id_wilayah'])){
    echo '<div class="row">';
    echo '  <div class="col-md-12 text-center text-danger">';
    echo '      ID Wilayah Tidak Boleh Kosong!';
    echo '  </div>';
    echo '</div>';
}else{
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Evaluasi Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $id_evaluasi=$_POST['id_evaluasi'];
        //Buka Nama Kecamatan
        $NamaPropinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
        $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
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
?>
        <div class="row">
            <div class="col-md-12">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td align="center"><b>No</b></td>
                                <td align="center"><b>Desa/Kelurahan</b></td>
                                <td align="center"><b>KK Miskin</b></td>
                                <td align="center"><b>Stunting</b></td>
                                <td align="center"><b>IKM</b></td>
                                <td align="center"><b>IDM</b></td>
                                <td align="center"><b>SAKIP</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $QryDesa = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'");
                                while ($DataDesa = mysqli_fetch_array($QryDesa)) {
                                    $id_wilayah_desa= $DataDesa['id_wilayah'];
                                    $NamaDesa= $DataDesa['desa'];
                                    //Buka Nama Desa
                                    $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah_desa,'desa');
                                    $CapaianKkMiskin=getCapaianRound($Conn,$id_evaluasi,$id_wilayah_desa,'Miskin','capaian');
                                    $CapaianStunting=getCapaianRound($Conn,$id_evaluasi,$id_wilayah_desa,'Stunting','capaian');
                                    $CapaianIkm=getCapaianRound($Conn,$id_evaluasi,$id_wilayah_desa,'IKM','capaian');
                                    $CapaianIdm=getCapaianRound($Conn,$id_evaluasi,$id_wilayah_desa,'IDM','capaian');
                                    $SkorSakip=evaluasi_rekap($Conn,$id_evaluasi,$id_wilayah_desa,'skor');
                                    echo '<tr>';
                                    echo '  <td align="center">'.$no.'</td>';
                                    echo '  <td align="left">';
                                    echo '      <a href="index.php?Page=LembarKerja&id='.$id_evaluasi.'&id_wilayah='.$id_wilayah_desa.'" class="text-primary">'.$NamaDesa.'</a>';
                                    echo '  </td>';
                                    echo '  <td align="center">'.$CapaianKkMiskin.'</td>';
                                    echo '  <td align="center">'.$CapaianStunting.'</td>';
                                    echo '  <td align="center">'.$CapaianIkm.'</td>';
                                    echo '  <td align="center">'.$CapaianIdm.'</td>';
                                    echo '  <td align="center">'.$SkorSakip.'</td>';
                                    echo '</tr>';
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php 
            }
        }
    }
?>