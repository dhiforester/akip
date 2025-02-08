<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_GET['id_anggaran'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '          ID Periode Anggaran Tidak Boleh Kosong!';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        if(empty($_GET['tahun'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '          ID Periode Anggaran Tidak Boleh Kosong!';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggaran=$_GET['id_anggaran'];
            $tahun_anggaran=$_GET['tahun'];
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran'"));
            //Buka Infromasi Periode Anggaran
            $periode_awal=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_awal');
            $periode_akhir=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'periode_akhir');
            //Informasi Reverensi
            $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kategori');
            $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
            $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
            $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
            $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
?>
        <html>
            <head>
                    <style type="text/css">
                        table tr.data td {
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
                    <tr>
                        <td colspan="9" align="center">
                            <b>RINCIAN ANGGARAN TAHUN <?php echo "$tahun_anggaran"; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" align="center">
                            Desa <?php echo "$DesaWilayah"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" align="center">
                            Kecamatan <?php echo "$KecamatanWilayah"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" align="center">
                            <?php echo "$KabupatenWilayah"; ?>
                        </td>
                    </tr>
                    <tr class="data">
                        <td align="center" colspan="2">
                            <b>Kode</b>
                        </td>
                        <td align="center" colspan="3">
                            <b>Bidang/Sub Bidang/ Kegiatan</b>
                        </td>
                        <td align="center">
                            <b>Sasaran</b>
                        </td>
                        <td align="center">
                            <b>Volume</b>
                        </td>
                        <td align="center">
                            <b>Lama Pengerjaan</b>
                        </td>
                        <td align="center">
                            <b>Anggaran</b>
                        </td>
                    </tr>
                    <?php
                        if(empty($jml_data)){
                            echo '<tr>';
                            echo '  <td colspan="9">';
                            echo '      <span class="text-danger">Belum Memiliki Data Anggaran</span>';
                            echo '  </td>';
                            echo '</tr>';
                        }else{
                            $no = 1;
                            $query = mysqli_query($Conn, "SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' ORDER BY kode ASC");
                            while ($data = mysqli_fetch_array($query)) {
                                $id_anggaran_rincian= $data['id_anggaran_rincian'];
                                $tahun= $data['tahun'];
                                $kode= $data['kode'];
                                $kode_bidang= $data['kode_bidang'];
                                $kode_sub_bidang= $data['kode_sub_bidang'];
                                $kode_kegiatan= $data['kode_kegiatan'];
                                $nama= $data['nama'];
                                $level= $data['level'];
                                $sasaran= $data['sasaran'];
                                $volume= $data['volume'];
                                $satuan= $data['satuan'];
                                $anggaran= $data['anggaran'];
                                $durasi= $data['durasi'];
                                if($level=="Bidang"){
                                    $SqlJumlah = "SELECT SUM(anggaran) AS total FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' AND kode_bidang='$kode_bidang'";
                                    $result = $Conn->query($SqlJumlah);
                                    // Periksa apakah hasil kueri tersedia
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $anggaran=$row['total'];
                                    } else {
                                        $anggaran =0;
                                    }
                                    echo '<tr class="data">';
                                    echo '  <td align="left" colspan="2">'.$kode.'</td>';
                                    echo '  <td align="left" colspan="3"><b>'.$nama.'</b></td>';
                                    echo '  <td align="left">'.$sasaran.'</td>';
                                    echo '  <td align="left">'.$volume.' '.$satuan.'</td>';
                                    echo '  <td align="left">'.$durasi.'</td>';
                                    echo '  <td align="left">'.$anggaran.'</td>';
                                    echo '</tr>';
                                }else{
                                    if($level=="Sub Bidang"){
                                        $SqlJumlah = "SELECT SUM(anggaran) AS total FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND tahun='$tahun_anggaran' AND kode_sub_bidang='$kode_sub_bidang'";
                                        $result = $Conn->query($SqlJumlah);
                                        // Periksa apakah hasil kueri tersedia
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $anggaran=$row['total'];
                                        } else {
                                            $anggaran ="0";
                                        }
                                        echo '<tr class="data">';
                                        echo '  <td align="left" colspan="2">'.$kode.'</td>';
                                        echo '  <td align="left"></td>';
                                        echo '  <td align="left" colspan="2">'.$nama.'</td>';
                                        echo '  <td align="left">'.$sasaran.'</td>';
                                        echo '  <td align="left">'.$volume.' '.$satuan.'</td>';
                                        echo '  <td align="left">'.$durasi.'</td>';
                                        echo '  <td align="left">'.$anggaran.'</td>';
                                        echo '</tr>';
                                    }else{
                                        echo '<tr class="data">';
                                        echo '  <td align="left" colspan="2">'.$kode.'</td>';
                                        echo '  <td align="left"></td>';
                                        echo '  <td align="left"></td>';
                                        echo '  <td align="left"><i>'.$nama.'</i></td>';
                                        echo '  <td align="left">'.$sasaran.'</td>';
                                        echo '  <td align="left">'.$volume.' '.$satuan.'</td>';
                                        echo '  <td align="left">'.$durasi.'</td>';
                                        echo '  <td align="left">'.$anggaran.'</td>';
                                        echo '</tr>';
                                    }
                                }
                                    $no++; 
                            }
                        }
                    ?>
                </table>
            </body>
        </html>
<?php 
            }
        }
?>