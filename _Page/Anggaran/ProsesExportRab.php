<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '          ID RAB Tidak Boleh Kosong!';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_POST['format_export'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '          Format Export Tidak Boleh Kosong!';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
                $format_export=$_POST['format_export'];
                if($format_export=="Excel"){
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Anggaran.xls");
                }
                $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian'"));
?>
        <html>
            <head>
                    <style type="text/css">
                        table tr td {
                            border-bottom: 1px solid #666;
                            font-size:12 pt;
                            color:#333;
                            border-spacing: 0px;
                            padding: 4px;
                        }
                    </style>
            </head>
            <body>
                <table>
                    <tr class="data">
                        <td colspan="2"><b class="text-light">Kode</b></td>
                        <td><b class="text-light">Kategori</b></td>
                        <td><b class="text-light">Uraian</b></td>
                        <td><b class="text-light">Volume</b></td>
                        <td><b class="text-light">Harga</b></td>
                        <td><b class="text-light">Jumlah</b></td>
                    </tr>
                    <?php
                        if(empty($jml_data)){
                            echo '<tr>';
                            echo '  <td colspan="7">';
                            echo '      <span class="text-danger">Belum Memiliki Data Anggaran</span>';
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
                                echo '<tr>';
                                echo '  <td align="left"><b>'.$NomorKategori.'</b></td>';
                                echo '  <td colspan="5"><b>'.$kategori_program.'</b></td>';
                                echo '  <td><b>'.$RupiahAnggaran.'</b></td>';
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
                                        <td align="left"><code class="text-dark"><?php echo "$kode_rab"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$kategori_program"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$uraian"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$volume"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$satuan"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$RupiahHarga"; ?></code></td>
                                        <td align="left"><code class="text-dark"><?php echo "$RupiahJumlah"; ?></code></td>
                                    </tr>
                    <?php 
                                }
                                $NomorKategori++;
                                echo '<tr>';
                                echo '  <td></td>';
                                echo '  <td></td>';
                                echo '  <td colspan="4">SUBTOTAL</td>';
                                echo '  <td>'.$RupiahAnggaran.'</td>';
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
                </table>
            </body>
        </html>
<?php 
        }
    } 
?>