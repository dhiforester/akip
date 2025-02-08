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
    if(empty($_POST['tahun'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $tahun=$_POST['tahun'];
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
            //Arraykan Desa
            $SqlJumlah = "SELECT SUM(jumlah) AS total FROM anggaran WHERE propinsi='$NamaPropinsi' AND kabupaten='$NamaKabupaten' AND kecamatan='$NamaKecamatan'";
            $result = $Conn->query($SqlJumlah);
            // Periksa apakah hasil kueri tersedia
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $TotalAnggaran=$row['total'];
            } else {
                $TotalAnggaran =0;
            }
            $TotalAnggaran = "Rp " . number_format($TotalAnggaran, 0, ',', '.');
?>
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li>
                        <small class="credit">
                            Jumlah Desa : <code class="text-secondary"><?php echo "$JumlahDesa"; ?></code>
                        </small>
                    </li>
                    <li>
                        <small class="credit">
                            Total Anggaran : <code class="text-secondary"><?php echo "$TotalAnggaran"; ?></code>
                        </small>
                    </li>
                    <li>
                        <small class="credit">
                            Tahun : <code class="text-secondary"><?php echo "$tahun"; ?></code>
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
                                <td align="center"><b>Anggaran</b></td>
                                <td align="center"><b>Progress</b></td>
                                <td align="center"><b>Opt</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $QryDesa = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kecamatan='$NamaKecamatan' AND kategori='desa'");
                                while ($DataDesa = mysqli_fetch_array($QryDesa)) {
                                    $id_wilayah_desa= $DataDesa['id_wilayah'];
                                    $NamaDesa= $DataDesa['desa'];
                                    //Looping Anggaran
                                    $JumlahAnggaran=0;
                                    $JumlahTotalProgress=0;
                                    $RealIdAnggaran="";
                                    $QryAnggaran = mysqli_query($Conn, "SELECT * FROM anggaran WHERE id_wilayah='$id_wilayah_desa'");
                                    while ($DataAnggaran = mysqli_fetch_array($QryAnggaran)) {
                                        $id_anggaran= $DataAnggaran['id_anggaran'];
                                        //Looping Anggaran Rincian
                                        $QryAnggaranRincian = mysqli_query($Conn, "SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun'");
                                        while ($DataAnggaranRincian = mysqli_fetch_array($QryAnggaranRincian)) {
                                            $RealIdAnggaran= $DataAnggaranRincian['id_anggaran'];
                                            $anggaran= $DataAnggaranRincian['anggaran'];
                                            //Looping Anggaran Rincian
                                            $JumlahAnggaran=$JumlahAnggaran+$anggaran;
                                        }
                                        //Jumlah Progress
                                        $SqlProgress = "SELECT SUM(alokasi_anggaran) AS total_alokasi_anggaran FROM anggaran_progress WHERE id_anggaran='$id_anggaran' AND id_wilayah='$id_wilayah_desa'";
                                        $HasilProgress = $Conn->query($SqlProgress);
                                        // Periksa apakah hasil kueri tersedia
                                        if ($HasilProgress->num_rows > 0) {
                                            $row = $HasilProgress->fetch_assoc();
                                            $TotalProgress=$row['total_alokasi_anggaran'];
                                        } else {
                                            $TotalProgress =0;
                                        }
                                        $JumlahTotalProgress=$JumlahTotalProgress+$TotalProgress;
                                    }
                                    $JumlahAnggaran = "Rp " . number_format($JumlahAnggaran, 0, ',', '.');
                                    $JumlahTotalProgress = "Rp " . number_format($JumlahTotalProgress, 0, ',', '.');
                                    echo '<tr>';
                                    echo '  <td align="center">'.$no.'</td>';
                                    echo '  <td align="left">'.$NamaDesa.'</td>';
                                    echo '  <td align="right">'.$JumlahAnggaran.'</td>';
                                    echo '  <td align="right">'.$JumlahTotalProgress.'</td>';
                                    if(!empty($RealIdAnggaran)){
                                        echo '  <td align="center"><a href="_Page/AnggaranAdmin/ExportRincian.php?id_anggaran='.$RealIdAnggaran.'&tahun='.$tahun.'" target="_blank">Lihat Rincian</a></td>';
                                    }else{
                                        echo '  <td align="center">None</td>';
                                    }
                                    
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