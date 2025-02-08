<?php
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Menangkap ID Evaluasi
    if(empty($_POST['GetIdRpjmdes'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      ID RPJMDES Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_rpjmdes=$_POST['GetIdRpjmdes'];
        //Validasi Hanya Boleh Angka
        if(!preg_match('/^[0-9]+$/', $id_rpjmdes)) {
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      ID RPJMDES Tidak Valid atau Mengandung Karakter Ilegal!';
            echo '  </div>';
            echo '</div>';
        }else{
            //Validasi Keberadaan Data
            $QryRpjmdes = mysqli_query($Conn,"SELECT * FROM rpjmdes WHERE id_rpjmdes='$id_rpjmdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
            $DataRpjmdes = mysqli_fetch_array($QryRpjmdes);
            if(empty($DataRpjmdes['id_rpjmdes'])){
                echo '<div class="row">';
                echo '  <div class="col-md-12 text-center text-danger">';
                echo '      ID RPJMDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                echo '  </div>';
                echo '</div>';
            }else{
                $NamaDesaRpjmdes=$DataRpjmdes['desa'];
                $NamaKecamatanRpjmdes=$DataRpjmdes['kecamatan'];
                $NamaKabupatenRpjmdes=$DataRpjmdes['kabupaten'];
                $periode_rpjmdes=$DataRpjmdes['periode'];
                $kepala_desa=$DataRpjmdes['kepala_desa'];
                $sekretaris_desa=$DataRpjmdes['sekretaris_desa'];
                $jumlah_anggaran=$DataRpjmdes['jumlah_anggaran'];
                $jumlah_anggaran = "" . number_format($jumlah_anggaran, 0, ',', '.');
                //Explode
                $explode=explode('-',$periode_rpjmdes);
                $periode_awal=$explode['0'];
                $periode_akhir=$explode['1'];
                if(empty($_POST['page_tahun'])){
                    $page_tahun=$periode_awal;
                }else{
                    $page_tahun=$_POST['page_tahun'];
                }
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes' AND tahun='$page_tahun'"));
?>
                <div class="row mb-4">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <button type="button" class="btn btn-sm btn-primary btn-rounded" id="Back" <?php if($page_tahun==$periode_awal){echo "disabled";} ?>>
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <select name="page_tahun" class="form-control text-center" id="SelectPageTahun">
                                <?php
                                    for($i=$periode_awal; $i<=$periode_akhir; $i++){
                                        if($page_tahun==$i){
                                            echo '<option selected value="'.$i.'">'.$i.'</option>';
                                        }else{
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <button type="button" class="btn btn-sm btn-primary btn-rounded" id="Next" <?php if($page_tahun==$periode_akhir){echo "disabled";} ?>>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-12 text-center">
                        <h3>Rencana Pembangunan Jangka Menengah Desa (RPJMDES)</h3>
                        <b>Pemerintah Desa <?php echo "$NamaDesaRpjmdes"; ?></b><br>
                        Kec. <?php echo $NamaKecamatanRpjmdes; ?>-<?php echo $NamaKabupatenRpjmdes; ?> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg bg-black">
                                    <tr>
                                        <th><b class="text-light">No</b></th>
                                        <th colspan="4"><b class="text-light">Bidang/Kegiatan</b></th>
                                        <th><b class="text-light">Anggaran</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(empty($jml_data)){
                                            echo '<tr>';
                                            echo '  <td colspan="3" class="text-center">';
                                            echo '      Tidak Ada Data RPJMDES Yang Ditemukan';
                                            echo '  </td>';
                                            echo '</tr>';
                                            $JumlahTotalAnggaran =0;
                                            $JumlahTotalAnggaran = "" . number_format($JumlahTotalAnggaran, 0, ',', '.');
                                        }else{
                                            //Hitung Jumlah Total
                                            $SqlJumlahTotal = "SELECT SUM(anggaran) AS total FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes' AND tahun='$page_tahun'";
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
                                            $query = mysqli_query($Conn, "SELECT * FROM rpjmdes_rincian WHERE id_rpjmdes='$id_rpjmdes' AND tahun='$page_tahun' ORDER BY kode ASC");
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_rpjmdes_rincian= $data['id_rpjmdes_rincian'];
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
                                                            echo '<td align="center"><b>'.$no.'</b></td>';
                                                            echo '<td><b>'.$kode.'</b></td>';
                                                            echo '<td colspan="3"><b>'.$nama.'</b></td>';
                                                            echo '<td align="right"><b>'.$rupiahAnggaran.'</b></td>';
                                                        }else{
                                                            if($level=="Sub Bidang"){
                                                                echo '<td align="center">'.$no.'</td>';
                                                                echo '<td></td>';
                                                                echo '<td>'.$kode.'</td>';
                                                                echo '<td colspan="2">'.$nama.'</td>';
                                                                echo '<td align="right">'.$rupiahAnggaran.'</td>';
                                                            }else{
                                                                echo '<td align="center"><small class="credit">'.$no.'</small></td>';
                                                                echo '<td></td>';
                                                                echo '<td></td>';
                                                                echo '<td><small class="credit">'.$kode.'</small></td>';
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
                                        <td colspan="5"><b>JUMLAH TOTAL</b></td>
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
<script>
    //Kondisi Ketika Click Next
    $('#Next').click(function() {
        var GetIdRpjmdes =$('#GetIdRpjmdes').val();
        var page_tahun="<?php echo $page_tahun+1; ?>";
        $('#MenampilkanRincianRpjmdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/RPJMDES/TabelRincianRpjmdes.php',
            data 	    :  {GetIdRpjmdes: GetIdRpjmdes, page_tahun: page_tahun},
            success     : function(data){
                $('#MenampilkanRincianRpjmdes').html(data);
            }
        });
    });
    //Kondisi Ketika Click Kembali
    $('#Back').click(function() {
        var GetIdRpjmdes =$('#GetIdRpjmdes').val();
        var page_tahun="<?php echo $page_tahun-1; ?>";
        $('#MenampilkanRincianRpjmdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/RPJMDES/TabelRincianRpjmdes.php',
            data 	    :  {GetIdRpjmdes: GetIdRpjmdes, page_tahun: page_tahun},
            success     : function(data){
                $('#MenampilkanRincianRpjmdes').html(data);
            }
        });
    });
    //Kondisi Ketika Dipilih Periode
    $('#SelectPageTahun').change(function() {
        var GetIdRpjmdes =$('#GetIdRpjmdes').val();
        var page_tahun=$('#SelectPageTahun').val();
        $('#MenampilkanRincianRpjmdes').html('<div class="row"><div class="col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div></div></div>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/RPJMDES/TabelRincianRpjmdes.php',
            data 	    :  {GetIdRpjmdes: GetIdRpjmdes, page_tahun: page_tahun},
            success     : function(data){
                $('#MenampilkanRincianRpjmdes').html(data);
            }
        });
    });
</script>