<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row mb-3">';
        echo '   <div class="col col-md-12 text-center text-danger">';
        echo '      ID Rincian Anggaran Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian'"));
?>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg bg-black">
                        <tr>
                            <th colspan="2"><b class="text-light">Kode</b></th>
                            <th><b class="text-light">Kategori</b></th>
                            <th><b class="text-light">Uraian</b></th>
                            <th><b class="text-light">Volume</b></th>
                            <th><b class="text-light">Harga</b></th>
                            <th><b class="text-light">Jumlah</b></th>
                            <th><b class="text-light">Opt</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="8" class="text-center">';
                                echo '      Tidak Ada Data Anggaran Yang Ditemukan';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $JumlahTotal=0;
                                $NomorKategori = 1;
                                $QryKategori = mysqli_query($Conn, "SELECT DISTINCT kategori_program FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian' ORDER BY kode_rab ASC");
                                while ($DataKategori = mysqli_fetch_array($QryKategori)) {
                                    $kategori_program= $DataKategori['kategori_program'];
                                    //Hitung jumlah anggaran
                                    $SqlJumlah = "SELECT SUM(jumlah) AS total FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian' AND kategori_program='$kategori_program'";
                                    $result = $Conn->query($SqlJumlah);
                                    // Periksa apakah hasil kueri tersedia
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $anggaran=$row['total'];
                                    } else {
                                        $anggaran =0;
                                    }
                                    $RupiahAnggaran = "Rp " . number_format($anggaran, 0, ',', '.');
                                    echo '<tr class="bg bg-grayish">';
                                    echo '  <td><b>'.$NomorKategori.'</b></td>';
                                    echo '  <td colspan="5"><b>'.$kategori_program.'</b></td>';
                                    echo '  <td><b>'.$RupiahAnggaran.'</b></td>';
                                    echo '  <td></td>';
                                    echo '</tr>';
                                    $query = mysqli_query($Conn, "SELECT * FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian' AND kategori_program='$kategori_program'ORDER BY kode_rab ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $id_anggaran_rab= $data['id_anggaran_rab'];
                                        $kode_rab= $data['kode_rab'];
                                        $kategori_program= $data['kategori_program'];
                                        $uraian= $data['uraian'];
                                        $volume= $data['volume'];
                                        $satuan= $data['satuan'];
                                        $harga= $data['harga'];
                                        $jumlah= $data['jumlah'];
                                        $JumlahTotal=$JumlahTotal+$jumlah;
                                        $RupiahHarga = "Rp " . number_format($harga, 0, ',', '.');
                                        $RupiahJumlah = "Rp " . number_format($jumlah, 0, ',', '.');
                        ?>
                                        <tr>
                                            <td></td>
                                            <td><code class="text-dark"><?php echo "$kode_rab"; ?></code></td>
                                            <td><code class="text-dark"><?php echo "$kategori_program"; ?></code></td>
                                            <td><code class="text-dark"><?php echo "$uraian"; ?></code></td>
                                            <td><code class="text-dark"><?php echo "$volume $satuan"; ?></code></td>
                                            <td><code class="text-dark"><?php echo "$RupiahHarga"; ?></code></td>
                                            <td><code class="text-dark"><?php echo "$RupiahJumlah"; ?></code></td>
                                            <td align="center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-dark" title="Edit RAB" data-bs-toggle="modal" data-bs-target="#ModalEditRab" data-id="<?php echo "$id_anggaran_rab"; ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-dark" title="Hapus RAB" data-bs-toggle="modal" data-bs-target="#ModalHapusRab" data-id="<?php echo "$id_anggaran_rab"; ?>">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                        <?php 
                                    }
                                    $NomorKategori++;
                                    echo '<tr>';
                                    echo '  <td></td>';
                                    echo '  <td></td>';
                                    echo '  <td colspan="4">SUBTOTAL</td>';
                                    echo '  <td>'.$RupiahAnggaran.'</td>';
                                    echo '  <td></td>';
                                    echo '</tr>';
                                }
                        ?>
                        <tr>
                            <td colspan="6">
                                <b>JUMLAH TOTAL ANGGARAN</b>
                            </td>
                            <td>
                                <?php
                                        $JumlahTotalRupiah = "Rp " . number_format($JumlahTotal, 0, ',', '.');
                                        echo '<b>'.$JumlahTotalRupiah.'</b>';
                                ?>
                            </td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php 
    } 
?>