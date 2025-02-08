<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_akses
    if(empty($_POST['GetData'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      Parameter Rekapitulasi Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $GetData=$_POST['GetData'];
        $explode=explode(',',$GetData);
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
                echo '      ID Wilayah Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_evaluasi=$explode['0'];
                $id_wilayah=$explode['1'];
                $JumlahKriteriaIndikator = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1'"));
?>
                <input type="hidden" name="id_evaluasi" value="<?php echo "$id_evaluasi"; ?>">
                <input type="hidden" name="id_wilayah" value="<?php echo "$id_wilayah"; ?>">
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <b>REKAPITULASI SKOR PENILAIAN</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td><b>No</b></td>
                                        <td><b>Indikator</b></td>
                                        <td><b>Skor</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(empty($JumlahKriteriaIndikator)){
                                            echo '<tr>';
                                            echo '  <td colspan="3" class="text-center">';
                                            echo '      Tidak Ada Komponen Penilaian Yang Ditemukan';
                                            echo '  </td>';
                                            echo '</tr>';
                                        }else{
                                            $no = 1;
                                            //KONDISI PENGATURAN MASING FILTER
                                            $Total=0;
                                            $query = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level='Level 1' ORDER BY kode ASC");
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_kriteria_indikator= $data['id_kriteria_indikator'];
                                                $level_1= $data['level_1'];
                                                $kode= $data['kode'];
                                                $teks= $data['teks'];
                                                $TotalSkor=0;
                                                $QryAkumulasi = mysqli_query($Conn, "SELECT * FROM kriteria_indikator WHERE level_1='$level_1'");
                                                while ($DataAkumulasi = mysqli_fetch_array($QryAkumulasi)) {
                                                    $id_kriteria_indikator= $DataAkumulasi['id_kriteria_indikator'];
                                                    //Jumlahkan
                                                    $sql = "SELECT SUM(skor_desa) AS total FROM evaluasi_jawaban WHERE id_kriteria_indikator='$id_kriteria_indikator' AND id_wilayah='$id_wilayah' AND id_evaluasi='$id_evaluasi'";
                                                    $result = $Conn->query($sql);
                                                    $row = $result->fetch_assoc();
                                                    $JumlahSkor=$row['total'];
                                                    $TotalSkor=$TotalSkor+$JumlahSkor;
                                                }
                                                $Total=$Total+$TotalSkor;
                                                echo '<tr>';
                                                echo '  <td class="text-center">'.$kode.'</td>';
                                                echo '  <td class="text-left">'.$teks.'</td>';
                                                echo '  <td class="text-right" align="right">'.$TotalSkor.'</td>';
                                                echo '</tr>';
                                                
                                            }
                                            echo '<tr>';
                                            echo '  <td class="text-center" colspan="2"><b>TOTAL SKOR</b></td>';
                                            echo '  <td class="text-right" align="right"><b>'.$Total.'</b></td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <small class="credit">
                            <code class="text-dark">
                                <ol>
                                    <li>
                                        Sistem akan melakukan update status <b>Selesai</b> pada setiap element penilaian dengan kategori Verifikasi.
                                    </li>
                                    <li>
                                        Semua skor element penilaian akan dijumlahkan kemudian di update pada tabel rekap.
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