<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID apbdes
    if(empty($_POST['GetIdApbdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID apbdes Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_apbdes=$_POST['GetIdApbdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_apbdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID APBDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $Qryapbdes = mysqli_query($Conn,"SELECT * FROM apbdes WHERE id_apbdes='$id_apbdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $Dataapbdes = mysqli_fetch_array($Qryapbdes);
            if(empty($Dataapbdes['id_apbdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID apbdes Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $NamaDesa=$Dataapbdes['desa'];
                $NamaKecamatan=$Dataapbdes['kecamatan'];
                $NamaKabupaten=$Dataapbdes['kabupaten'];
                $periode=$Dataapbdes['periode'];
                $kepala_desa=$Dataapbdes['kepala_desa'];
                $sekretaris_desa=$Dataapbdes['sekretaris_desa'];
                $jumlah_anggaran=$Dataapbdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM apbdes_rincian WHERE id_apbdes='$id_apbdes'"));
?>
                <div class="row mb-3 mt-3">
                    <div class="col-md-12 text-center">
                        <h3>Anggaran Pendapatan Dan Belanja Desa (APBDES)</h3>
                        <b>Pemerintah Desa <?php echo "$NamaDesa"; ?></b><br>
                        Kec. <?php echo $NamaKecamatan; ?>-<?php echo $NamaKabupaten; ?> <br>
                        Tahun <?php echo "$periode"; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr class="bg bg-black">
                                        <td align="center"><b class="text-light">KD</b></td>
                                        <td align="center" colspan="3"><b class="text-light">Bidang/Kegiatan</b></td>
                                        <td align="center"><b class="text-light">Anggaran</b></td>
                                    </tr>
                                    <?php
                                        if(empty($jml_data)){
                                            echo '<tr>';
                                            echo '  <td colspan="3" class="text-center">';
                                            echo '      Tidak Ada Data APBDES Yang Ditemukan';
                                            echo '  </td>';
                                            echo '</tr>';
                                            $JumlahTotalAnggaran =0;
                                            $JumlahTotalAnggaran = "" . number_format($JumlahTotalAnggaran, 0, ',', '.');
                                        }else{
                                            //Hitung Jumlah Total
                                            $SqlJumlahTotal = "SELECT SUM(anggaran) AS total FROM apbdes_rincian WHERE id_apbdes='$id_apbdes'";
                                            $resultJumlahTotal = $Conn->query($SqlJumlahTotal);
                                            // Periksa apakah hasil kueri tersedia
                                            if ($resultJumlahTotal->num_rows > 0) {
                                                $BarisJumlahTotal = $resultJumlahTotal->fetch_assoc();
                                                $JumlahTotalAnggaran=$BarisJumlahTotal['total'];
                                            } else {
                                                $JumlahTotalAnggaran =0;
                                            }
                                            $JumlahTotalAnggaran = "Rp " . number_format($JumlahTotalAnggaran, 0, ',', '.');
                                            //Mulai Looping
                                            $no = 1;
                                            $query = mysqli_query($Conn, "SELECT * FROM apbdes_rincian WHERE id_apbdes='$id_apbdes' ORDER BY kode ASC");
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_apbdes_rincian= $data['id_apbdes_rincian'];
                                                $kode= $data['kode'];
                                                $kode_bidang= $data['kode_bidang'];
                                                $kode_sub_bidang= $data['kode_sub_bidang'];
                                                $kode_kegiatan= $data['kode_kegiatan'];
                                                $nama= $data['nama'];
                                                $level= $data['level'];
                                                $anggaran= $data['anggaran'];
                                                $rupiahAnggaran = "Rp " . number_format($anggaran, 2, ',', '.');
                                    ?>
                                                <tr>
                                                    <?php
                                                        if($level=="Bidang"){
                                                            echo '<td align="center"><b>'.$kode.'</b></td>';
                                                            echo '<td colspan="3"><b>'.$nama.'</b></td>';
                                                            echo '<td align="right"><b>'.$rupiahAnggaran.'</b></td>';
                                                        }else{
                                                            if($level=="Sub Bidang"){
                                                                echo '<td></td>';
                                                                echo '<td align="center">'.$kode.'</td>';
                                                                echo '<td colspan="2">'.$nama.'</td>';
                                                                echo '<td align="right">'.$rupiahAnggaran.'</td>';
                                                            }else{
                                                                echo '<td></td>';
                                                                echo '<td></td>';
                                                                echo '<td align="center"><small class="credit">'.$kode.'</small></td>';
                                                                echo '<td><small class="credit">'.$nama.'</small></td>';
                                                                echo '<td align="right"><small class="credit">'.$rupiahAnggaran.'</small></td>';
                                                            }
                                                        }
                                                    ?>
                                                </tr>
                                    <?php
                                                $no++; 
                                            }
                                        }
                                    ?>
                                    <tr class="bg-grayish">
                                        <td colspan="4"><b>JUMLAH TOTAL</b></td>
                                        <td align="right"><b><?php echo $JumlahTotalAnggaran; ?></b></td>
                                    </tr>
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