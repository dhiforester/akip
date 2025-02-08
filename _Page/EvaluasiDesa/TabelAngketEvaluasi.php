<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    if(empty($_POST['id_evaluasi'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID Evaluasi Tidak Boleh Kosong';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['id_wilayah'])){
            $id_wilayah="";
            if($SessionAkses=="Desa"){
                $SessionIdWilayah=$SessionIdWilayah;
            }else{
                $SessionIdWilayah="";
            }
        }else{
            $id_wilayah=$_POST['id_wilayah'];
            if($SessionAkses=="Desa"){
                $SessionIdWilayah=$SessionIdWilayah;
            }else{
                $SessionIdWilayah=$id_wilayah;
            }
        }
        $id_evaluasi=$_POST['id_evaluasi'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 4'"));
?>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="table table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg bg-black">
                            <tr>
                                <th><b class="text-light">KD</b></th>
                                <th colspan="4"><b class="text-light">Komponen Penilaian</b></th>
                                <th><b class="text-light">Skor</b></th>
                                <th><b class="text-light">Status</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(empty($jml_data)){
                                    echo '<tr>';
                                    echo '  <td colspan="4" class="text-center">';
                                    echo '      Tidak Ada Komponen Penilaian Yang Ditemukan';
                                    echo '  </td>';
                                    echo '</tr>';
                                }else{
                                    $no = 1;
                                    //KONDISI PENGATURAN MASING FILTER
                                    $TotalBanget=0;
                                    $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator ORDER BY kode ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_kriteria_indikator= $data['id_kriteria_indikator'];
                                        $kode= $data['kode'];
                                        $level= $data['level'];
                                        $level_1= $data['level_1'];
                                        $level_2= $data['level_2'];
                                        $level_3= $data['level_3'];
                                        $level_4= $data['level_4'];
                                        $teks= $data['teks'];
                                        //Cek Apakah Sudah Terjawab ATau Belum
                                        $CekTerjawab = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'"));
                                        //Cek Skor
                                        $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                                        $DataJawaban = mysqli_fetch_array($QryJawaban);
                                        if(empty($DataJawaban['id_evaluasi_jawaban'])){
                                            $id_evaluasi_jawaban="";
                                            $jawaban="";
                                            $skor_desa="0";
                                            $skor_kecamatan="0";
                                            $status="0";
                                        }else{
                                            $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                                            $jawaban=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'jawaban');
                                            $skor_desa=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'skor_desa');
                                            $skor_kecamatan=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'skor_kecamatan');
                                            $status=getDataDetail($Conn,'evaluasi_jawaban','id_evaluasi_jawaban',$id_evaluasi_jawaban,'status');
                                            if(empty($skor)){
                                                $skor="0";
                                            }
                                        }
                            ?>
                                        <tr>
                                            <?php
                                                if($level=="Level 1"){
                                                    $level_1= $data['level_1'];
                                                    $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_1='$level_1'";
                                                    $result = $Conn->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    $JumlahBobot=$row['total'];
                                                }else{
                                                    if($level=="Level 2"){
                                                        //Menghitung Count
                                                        $level_2= $data['level_2'];
                                                        $sql = "SELECT SUM(bobot) AS total FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'";
                                                        $result = $Conn->query($sql);
                                                        $row = $result->fetch_assoc();
                                                        $JumlahBobot=$row['total'];
                                                    }else{
                                                        if($level=="Level 3"){
                                                            $JumlahBobot= $data['bobot'];
                                                        }else{
                                                            $alternatif= $data['alternatif'];
                                                            $array = json_decode($alternatif, true);
                                                            $maxValue = null;
                                                            $maxItem = null;
                                                            // Iterasi melalui array untuk menemukan nilai terbesar
                                                            foreach ($array as $item) {
                                                                $nilai = floatval($item['nilai']); // Konversi nilai ke float
                                                                if ($maxValue === null || $nilai > $maxValue) {
                                                                    $maxValue = $nilai;
                                                                    $maxItem = $item;
                                                                }
                                                            }
                                                            // Tampilkan item dengan nilai terbesar
                                                            if ($maxItem !== null) {
                                                                $JumlahBobot=$maxValue;
                                                            } else {
                                                                $JumlahBobot=0;
                                                            }
                                                        }
                                                    }
                                                }
                                                if($level=="Level 1"){
                                                    echo '<td align="center"><b>'.$kode.'</b></td>';
                                                    echo '<td colspan="4"><b>'.$teks.' ('.$JumlahBobot.' %)</b></td>';
                                                }else{
                                                    if($level=="Level 2"){
                                                        echo '<td></td>';
                                                        echo '<td align="center">'.$kode.'</td>';
                                                        echo '<td colspan="3">'.$teks.' ('.$JumlahBobot.' %)</td>';
                                                    }else{
                                                        if($level=="Level 3"){
                                                            echo '<td></td>';
                                                            echo '<td></td>';
                                                            echo '<td align="center"><small class="credit">'.$kode.'</small></td>';
                                                            echo '<td colspan="2"><small class="credit">'.$teks.' ('.$JumlahBobot.' %)</small></td>';
                                                        }else{
                                                            echo '<td></td>';
                                                            echo '<td></td>';
                                                            echo '<td></td>';
                                                            echo '<td align="center"><small class="credit"><code class="text text-grayish">'.$kode.'</code></small></td>';
                                                            echo '<td><a href="index.php?Page=EvaluasiDesa&Sub=RincianEvaluasi&id='.$id_evaluasi.'&id2='.$id_kriteria_indikator.'&id3='.$SessionIdWilayah.'"><code class="text text-primary">'.$teks.' ('.$JumlahBobot.' %)</code></a></td>';
                                                        }
                                                    }
                                                }
                                            ?>
                                            <td align="center">
                                                <?php 
                                                    if($level=="Level 4"){
                                                        echo '<code class="text"><small class="credit text-grayish">'.$skor_desa.'</small></code>';
                                                    }else{
                                                        if($level=="Level 3"){
                                                            //Arraykan semua level 4 berdasarkan level 3
                                                            $TotalSkor=0;
                                                            $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_3='$level_3' AND level_2='$level_2' AND level_1='$level_1'");
                                                            while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                //Jumlahkan
                                                                $sql = "SELECT SUM(skor_desa) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$SessionIdWilayah' AND id_evaluasi='$id_evaluasi'";
                                                                $result = $Conn->query($sql);
                                                                $row = $result->fetch_assoc();
                                                                $JumlahSkor=$row['total'];
                                                                $TotalSkor=$TotalSkor+$JumlahSkor;
                                                            }
                                                            echo '<code class="text text-dark">'.$TotalSkor.'</code>';
                                                        }else{
                                                            if($level=="Level 2"){
                                                                //Arraykan semua level 4 berdasarkan level 3
                                                                $TotalSkor=0;
                                                                $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_2='$level_2' AND level_1='$level_1'");
                                                                while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                    $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                    //Jumlahkan
                                                                    $sql = "SELECT SUM(skor_desa) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$SessionIdWilayah' AND id_evaluasi='$id_evaluasi'";
                                                                    $result = $Conn->query($sql);
                                                                    $row = $result->fetch_assoc();
                                                                    $JumlahSkor=$row['total'];
                                                                    $TotalSkor=$TotalSkor+$JumlahSkor;
                                                                }
                                                                echo ''.$TotalSkor.'';
                                                            }else{
                                                                if($level=="Level 1"){
                                                                    //Arraykan semua level 4 berdasarkan level 3
                                                                    $TotalSkor=0;
                                                                    $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1'");
                                                                    while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                                        $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                                        //Jumlahkan
                                                                        $sql = "SELECT SUM(skor_desa) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$SessionIdWilayah' AND id_evaluasi='$id_evaluasi'";
                                                                        $result = $Conn->query($sql);
                                                                        $row = $result->fetch_assoc();
                                                                        $JumlahSkor=$row['total'];
                                                                        $TotalSkor=$TotalSkor+$JumlahSkor;
                                                                    }
                                                                    $TotalBanget=$TotalBanget+$TotalSkor;
                                                                    echo '<b>'.$TotalSkor.'</b>';
                                                                }else{
                    
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php 
                                                    if($level=="Level 4"){
                                                        if($status=="Refisi"){
                                                            $LabelStatus='<small class="credit text-warning" title="Refisi"><i class="bi bi-exclamation-circle"></i> Revisi</small>';
                                                        }else{
                                                            if($status=="Dikirim"){
                                                                $LabelStatus='<small class="credit text-info" title="Dikirim"><i class="bi bi-airplane"></i> Dikirim</small>';
                                                            }else{
                                                                if($status=="Verifikasi"){
                                                                    $LabelStatus='<small class="credit text-primary" title="Verifikasi"><i class="bi bi-clock-history"></i> Verifikasi</small>';
                                                                }else{
                                                                    if($status=="Selesai"){
                                                                        $LabelStatus='<small class="credit text-success" title="Selesai"><i class="bi bi-check"></i> Selesai</small>';
                                                                    }else{
                                                                        $LabelStatus='<small class="credit text-danger" title="Tidak Diketahui"><i class="bi bi-x"></i> Belum</small>';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo "$LabelStatus"; 
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                        $no++; 
                                    }
                                    $SqlJumlahTotal = "SELECT SUM(skor_desa) AS jumlah_total FROM evaluasi_jawaban WHERE id_wilayah='$SessionIdWilayah' AND id_evaluasi='$id_evaluasi'";
                                    $ResultJumlahTotal = $Conn->query($SqlJumlahTotal);
                                    $BarisJumlahTotal = $ResultJumlahTotal->fetch_assoc();
                                    $JumlahSkor=$BarisJumlahTotal['jumlah_total'];
                                    $JumlahSkor=round($TotalBanget,2);
                                    echo '<tr>';
                                    echo '  <td colspan="5"><b>JUMLAH TOTAL SKOR</b></td>';
                                    echo '  <td align="center"><b>'.$JumlahSkor.'</b></td>';
                                    echo '  <td align="center"><b></b></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
            //Keterangan
            $QryRekapitulasi = mysqli_query($Conn,"SELECT * FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRekapitulasi = mysqli_fetch_array($QryRekapitulasi);
            if(empty($DataRekapitulasi['id_evaluasi_rekap'])){
                $statusKepesertaan='<code class="text-danger">Belum Mengikuti</code>';
                $TotelSkorRekapitulasi='<code class="text-danger">None</code>';
                $Rekomendasi='<code class="text-danger">None</code>';
                $StatusRekapitulasi='<code class="text-danger">None</code>';
            }else{
                $statusKepesertaan='<code class="text-info">Mengikuti</code>';
                $TotelSkorRekapitulasi=$DataRekapitulasi['skor'];
                $TotelSkorRekapitulasi='<code class="text text-grayish">'.$TotelSkorRekapitulasi.'</code>';
                $Rekomendasi=$DataRekapitulasi['rekomendasi'];
                $Rekomendasi='<code class="text text-grayish">'.$Rekomendasi.'</code>';
                $StatusRekapitulasi=$DataRekapitulasi['status'];
                $StatusRekapitulasi='<code class="text text-grayish">'.$StatusRekapitulasi.'</code>';
            }
            if($SessionAkses=="Admin"){ 
                if(empty($DataRekapitulasi['id_evaluasi_rekap'])){
        ?>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-md btn-block btn-success" data-bs-toggle="modal" data-bs-target="#ModalRekapEvaluasi" data-id="<?php echo "$id_evaluasi,$SessionIdWilayah"; ?>">
                            <i class="bi bi-check-all"></i> Rekap Semua
                        </button>
                    </div>
                </div>
        <?php 
                }else{
                    echo '<div class="row mb-3">';
                    echo '  <div class="col-md-2">';
                    echo '      <b>Rekomendasi: </b><br>';
                    echo '  </div>';
                    echo '  <div class="col-md-10">';
                    echo '      '.$Rekomendasi.'';
                    echo '  </div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '  <div class="col-md-12">';
                    echo '      <button type="button" class="btn btn-md btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#ModalRekapEvaluasi" data-id="'.$id_evaluasi.','.$SessionIdWilayah.'">';
                    echo '          <i class="bi bi-check-all"></i> Rekap Ulang';
                    echo '      </button>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        ?>
<?php 
    } 
?>