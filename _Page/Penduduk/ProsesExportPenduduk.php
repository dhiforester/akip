<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['format'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '          Format Export Tidak Boleh Kosong!';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $format_export=$_POST['format'];
        if($format_export=="Excel"){
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Penduduk.xls");
        }
        $JumlahData = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM penduduk WHERE id_wilayah='$SessionIdWilayah'"));
?>
        <html>
            <head>
                    <style type="text/css">
                        table tr td {
                            border: 1px solid #666;
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
                        <td align="center"><b>No</b></td>
                        <td><b>Nama</b></td>
                        <td><b>NIK</b></td>
                        <td><b>KK</b></td>
                        <td><b>Alamat</b></td>
                        <td><b>Kontak</b></td>
                        <td><b>Pernikahan</b></td>
                        <td><b>Pekerjaan</b></td>
                        <td><b>Gender</b></td>
                        <td><b>Tempat Lahir</b></td>
                        <td><b>Tanggal Lahir</b></td>
                        <td><b>Hidup</b></td>
                        <td><b>Keberadaan</b></td>
                    </tr>
                    <?php
                        if(empty($JumlahData)){
                            echo '<tr>';
                            echo '  <td colspan="12">';
                            echo '      <span class="text-danger">Tidak Ada Yang Ditemukan</span>';
                            echo '  </td>';
                            echo '</tr>';
                        }else{
                            $no = 1;
                            $QryPenduduk = mysqli_query($Conn, "SELECT * FROM penduduk WHERE id_wilayah='$SessionIdWilayah' ORDER BY id_penduduk ASC");
                            while ($DataPenduduk = mysqli_fetch_array($QryPenduduk)) {
                                $id_penduduk= $DataPenduduk['id_penduduk'];
                                $nik= $DataPenduduk['nik'];
                                $kk= $DataPenduduk['kk'];
                                $nama= $DataPenduduk['nama'];
                                $alamat= $DataPenduduk['alamat'];
                                $kontak= $DataPenduduk['kontak'];
                                $pernikahan= $DataPenduduk['pernikahan'];
                                $pekerjaan= $DataPenduduk['pekerjaan'];
                                $gender= $DataPenduduk['gender'];
                                $tempat_lahir= $DataPenduduk['tempat_lahir'];
                                $tanggal_lahir= $DataPenduduk['tanggal_lahir'];
                                $hidup= $DataPenduduk['hidup'];
                                $keberadaan= $DataPenduduk['keberadaan'];
                                $updatetime= $DataPenduduk['updatetime'];
                    ?>
                        <tr>
                            <td align="center"><code class="text-dark"><?php echo "$no"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$nama"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$nik"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$kk"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$alamat"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$kontak"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$pernikahan"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$pekerjaan"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$gender"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$tempat_lahir"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$tanggal_lahir"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$hidup"; ?></code></td>
                            <td align="left"><code class="text-dark"><?php echo "$keberadaan"; ?></code></td>
                        </tr>
                    <?php 
                                $no++;
                            }
                        }
                    ?>
                </table>
            </body>
        </html>
<?php } ?>