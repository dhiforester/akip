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
    $id_wilayah=$_POST['id_wilayah'];
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
                <ul>
                    <li>
                        <small class="credit">
                            Jumlah Desa : <code class="text-secondary"><?php echo "$JumlahDesa"; ?></code>
                        </small>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td align="center"><b>No</b></td>
                                <td align="center"><b>Desa/Kelurahan</b></td>
                                <td align="center"><b>Profil</b></td>
                                <td align="center"><b>Demografi</b></td>
                                <td align="center"><b>Capaian Target</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $QryDesa = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'");
                                while ($DataDesa = mysqli_fetch_array($QryDesa)) {
                                    $id_wilayah_desa= $DataDesa['id_wilayah'];
                                    $NamaDesa= $DataDesa['desa'];
                                    //Data Profile
                                    $JumlahProfil=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah_profile WHERE id_wilayah='$id_wilayah_desa'"));
                                    $JumlahDemografi=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah_demografi WHERE id_wilayah='$id_wilayah_desa'"));
                                    $JumlahTargetCapaian=mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM target_capaian WHERE id_wilayah='$id_wilayah_desa'"));
                                    //Routing
                                    if(!empty($JumlahProfil)){
                                        $LabelJumlahProfile='<a href="index.php?Page=WilayahProfilAdmin&Sub=DetailProfile&id_wilayah='.$id_wilayah_desa.'" class="btn btn-primary">View</a>';
                                    }else{
                                        $LabelJumlahProfile='<a href="javascript:void(0);" class="btn btn-grayish">None</a>';
                                    }
                                    if(!empty($JumlahDemografi)){
                                        $LabelDemografi='<a href="index.php?Page=WilayahProfilAdmin&Sub=DetailDemografi&id_wilayah='.$id_wilayah_desa.'" class="btn btn-primary">View</a>';
                                    }else{
                                        $LabelDemografi='<a href="javascript:void(0);" class="btn btn-grayish">None</a>';
                                    }
                                    if(!empty($JumlahTargetCapaian)){
                                        $LabelTargetCapaian='<a href="index.php?Page=WilayahProfilAdmin&Sub=DetailTargetCapaian&id_wilayah='.$id_wilayah_desa.'" class="btn btn-primary">View</a>';
                                    }else{
                                        $LabelTargetCapaian='<a href="javascript:void(0);" class="btn btn-grayish">None</a>';
                                    }
                                    echo '<tr>';
                                    echo '  <td align="center">'.$no.'</td>';
                                    echo '  <td align="left">'.$NamaDesa.'</td>';
                                    echo '  <td align="center">'.$LabelJumlahProfile.'</td>';
                                    echo '  <td align="center">'.$LabelDemografi.'</td>';
                                    echo '  <td align="center">'.$LabelTargetCapaian.'</td>';
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
?>