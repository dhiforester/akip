<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['GetParameter'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Parameter Datai Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $GetParameter=$_POST['GetParameter'];
        $explode=explode(',',$GetParameter);
        if(empty($explode['0'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID Evaluasi Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($explode['1'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID Wilayah Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_evaluasi=$explode['0'];
                $id_wilayah=$explode['1'];
                $JumlahKriteriaIndikator = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1'"));
                if(empty($JumlahKriteriaIndikator)){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      Tidak ada kriteria dan indikator';
                    echo '  </div>';
                    echo '</div>';
                }else{
?>
                    <div class="row">
                        <div class="col-md-12">
                            <b>Rekapitulasi Bobot Skor Komponen Penilaian</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 table table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg bg-black">
                                    <tr>
                                        <th><b class="text-light">Kode</b></th>
                                        <th><b class="text-light">Komponen Penilaian</b></th>
                                        <th><b class="text-light">Bobot</b></th>
                                        <th><b class="text-light">Skor</b></th>
                                        <th><b class="text-light">Bobot/Skor</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $TotalSemuaBobot=0;
                                        $TotalSemuaSkor=0;
                                        $TotalSemuaBobotSkor=0;
                                        $no = 1;
                                        $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $id_kriteria_indikator= $data['id_kriteria_indikator'];
                                            $kode= $data['kode'];
                                            $level= $data['level'];
                                            $level_1= $data['level_1'];
                                            $level_2= $data['level_2'];
                                            $level_3= $data['level_3'];
                                            $level_4= $data['level_4'];
                                            $teks= $data['teks'];
                                            //Hitung Total Bobot per Indikator
                                            $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_1='$level_1'";
                                            $result = $Conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $JumlahBobot=$row['total'];
                                            //Menghitung skor
                                            $TotalSkor=0;
                                            $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1'");
                                            while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                $ListIdKriteria= $DataAkumulasi['id_kriteria_indikator'];
                                                //Jumlahkan
                                                $sql = "SELECT SUM(skor) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$ListIdKriteria' AND id_wilayah='$id_wilayah'";
                                                $result = $Conn->query($sql);
                                                $row = $result->fetch_assoc();
                                                $JumlahSkor=$row['total'];
                                                $TotalSkor=$TotalSkor+$JumlahSkor;
                                            }
                                            if(empty($TotalSkor)){
                                                $BobotSkor=0;
                                            }else{
                                                $BobotSkor=$TotalSkor*($JumlahBobot/100);
                                                $BobotSkor=round($BobotSkor,2);
                                            }
                                            $TotalSemuaBobot=$TotalSemuaBobot+$JumlahBobot;
                                            $TotalSemuaSkor=$TotalSemuaSkor+$TotalSkor;
                                            $TotalSemuaBobotSkor=$TotalSemuaBobotSkor+$BobotSkor;
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $kode; ?></td>
                                            <td><?php echo $teks; ?></td>
                                            <td align="center"><?php echo "$JumlahBobot %"; ?></td>
                                            <td align="center"><?php echo $TotalSkor; ?></td>
                                            <td align="center"><?php echo "$BobotSkor"; ?></td>
                                        </tr>
                                    <?php
                                            $no++; 
                                        }
                                    ?>
                                    <tr>
                                        <td align="center"></td>
                                        <td>JUMLAH TOTAL</td>
                                        <td align="center"><?php echo "$TotalSemuaBobot %"; ?></td>
                                        <td align="center"><?php echo $TotalSemuaSkor; ?></td>
                                        <td align="center"><?php echo "$TotalSemuaBobotSkor"; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        //Menentukan Rekomendasi
                        if($TotalSemuaBobotSkor<55){
                            $rekomendasi="Pemerintahan Desa tidak memiliki manajemen kinerja, perlu banyak perbaikan yang mendasar";
                        }else{
                            if($TotalSemuaBobotSkor<70){
                                $rekomendasi="Pemerintahan Desa kurang memiliki sistem untuk manajemen kinerja dam perlu banyak perbaikan yang mendasar";
                            }else{
                                if($TotalSemuaBobotSkor<85){
                                    $rekomendasi="Pemerintahan Desa telah memiliki sistem yang dapat digunakan untuk manajemen kinerja dan akuntabilitasnya sudah baik, dan perlu sedikit perbaikan";
                                }else{
                                    $rekomendasi="Pemerintahan Desa berkinerja tinggi, sangat akuntabel dan memimpin perubahan";
                                }
                            }
                        }
                    ?>
                    <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                    <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
                    <input type="hidden" name="skor" value="<?php echo "$TotalSemuaBobotSkor"; ?>">
                    <input type="hidden" name="status" value="Selesai">
                    <input type="hidden" name="rekomendasi" value="<?php echo "$rekomendasi"; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Rekomendasi:</b>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <small class="credit">
                                    <?php echo "$rekomendasi"; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    
<?php
                }
            }
        }
    }
?>