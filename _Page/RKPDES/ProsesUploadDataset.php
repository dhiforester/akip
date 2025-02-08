<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    include "../../_Config/SettingGeneral.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_rkpdes tidak boleh kosong
    if(empty($_POST['id_rkpdes'])){
        echo '<small class="text-danger">ID RKPDES tidak boleh kosong</small>';
    }else{
        if(empty($_FILES['file_rkpdes_excel']['name'])){
            echo '<small class="text-danger">File tidak boleh kosong</small>';
        }else{
            $id_rkpdes=$_POST['id_rkpdes'];
            //Validasi Id RKPDES Hanya Boleh Angka
            if(!preg_match("/^[0-9]*$/", $id_rkpdes)){
                echo '<code class="text-danger">ID RKPDES Hanya Boleh Angka</code>';
            }else{
                //Validasi Keberadaan Data
                $Qry = mysqli_query($Conn,"SELECT * FROM rkpdes WHERE id_rkpdes='$id_rkpdes' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                $Data = mysqli_fetch_array($Qry);
                if(empty($Data['id_rkpdes'])){
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      ID RKPDES Tidak Valid atau Tidak Ditemukan Pada Database!';
                    echo '  </div>';
                    echo '</div>';
                    echo '<code class="text-danger">ID RKPDES Hanya Boleh Angka</code>';
                }else{
                    $periode=$Data['periode'];
                    $nama_file=$_FILES['file_rkpdes_excel']['name'];
                    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    if(isset($_FILES['file_rkpdes_excel']['name']) && in_array($_FILES['file_rkpdes_excel']['type'], $file_mimes)) {
                        $arr_file = explode('.', $_FILES['file_rkpdes_excel']['name']);
                        $extension = end($arr_file);
                        if('csv' == $extension) {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                        } else {
                            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        }
                        $spreadsheet = $reader->load($_FILES['file_rkpdes_excel']['tmp_name']);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        $JumlahBaris=count($sheetData);
                        $JumlahValidator=$JumlahBaris-1;
                        $JumlahKodeValid=0;
                        $JumlahAnggaranValid=0;
                        for($i=1; $i<$JumlahBaris; $i++){
                            $kode = $sheetData[$i]['0'];
                            $bidang_kegiatan = $sheetData[$i]['1'];
                            $anggaran = $sheetData[$i]['2'];
                            if(!preg_match("/^[0-9]*$/", $anggaran)){
                                $JumlahAnggaranValid=$JumlahAnggaranValid+0;
                            }else{
                                $JumlahAnggaranValid=$JumlahAnggaranValid+1;
                            }
                            //Cek validasi Kode
                            $QryBidangKegiatan = mysqli_query($Conn,"SELECT * FROM bidang_kegiatan WHERE id_wilayah='$SettingIdWilayahUtama' AND kode='$kode'")or die(mysqli_error($Conn));
                            $DataBidangKegiatan = mysqli_fetch_array($QryBidangKegiatan);
                            if(empty($DataBidangKegiatan['id_bidang_kegiatan'])){
                                $JumlahKodeValid=$JumlahKodeValid+0;
                            }else{
                                $JumlahKodeValid=$JumlahKodeValid+1;
                                $kode_bidang=$DataBidangKegiatan['kode_bidang'];
                                $kode_sub_bidang=$DataBidangKegiatan['kode_sub_bidang'];
                                $kode_kegiatan=$DataBidangKegiatan['kode_kegiatan'];
                                $level=$DataBidangKegiatan['level'];
                                $nama=$DataBidangKegiatan['nama'];
                            }
                        }
                        if($JumlahKodeValid==$JumlahValidator){
                            if($JumlahAnggaranValid==$JumlahValidator){
                                $JumlahDataProses=0;
                                for($i=1; $i<$JumlahBaris; $i++){
                                    $kode = $sheetData[$i]['0'];
                                    $bidang_kegiatan = $sheetData[$i]['1'];
                                    if(!empty($sheetData[$i]['2'])){
                                        $anggaran = $sheetData[$i]['3'];
                                    }else{
                                        $anggaran ="0";
                                    }
                                    
                                    //Cek validasi Kode
                                    $QryBidangKegiatan = mysqli_query($Conn,"SELECT * FROM bidang_kegiatan WHERE id_wilayah='$SettingIdWilayahUtama' AND kode='$kode'")or die(mysqli_error($Conn));
                                    $DataBidangKegiatan = mysqli_fetch_array($QryBidangKegiatan);
                                    if(!empty($DataBidangKegiatan['id_bidang_kegiatan'])){
                                        $kode_bidang=$DataBidangKegiatan['kode_bidang'];
                                        $kode_sub_bidang=$DataBidangKegiatan['kode_sub_bidang'];
                                        $kode_kegiatan=$DataBidangKegiatan['kode_kegiatan'];
                                        $level=$DataBidangKegiatan['level'];
                                        $nama=$DataBidangKegiatan['nama'];
                                        //Cek apakah data tersebut sudah ada pada database rkpdes_rincian
                                        $QryRincian = mysqli_query($Conn,"SELECT * FROM rkpdes_rincian WHERE id_rkpdes='$id_rkpdes' AND tahun='$periode' AND kode='$kode'")or die(mysqli_error($Conn));
                                        $DataRincian = mysqli_fetch_array($QryRincian);
                                        if(!empty($DataRincian['id_rkpdes_rincian'])){
                                            $id_rkpdes_rincian=$DataRincian['id_rkpdes_rincian'];
                                            //Update RPJMDES Rincian
                                            $UpdateRkpdes = mysqli_query($Conn,"UPDATE rkpdes_rincian SET 
                                                kode='$kode',
                                                kode_bidang='$kode_bidang',
                                                kode_sub_bidang='$kode_sub_bidang',
                                                kode_kegiatan='$kode_kegiatan',
                                                nama='$bidang_kegiatan',
                                                level='$level',
                                                anggaran='$anggaran'
                                            WHERE id_rkpdes_rincian='$id_rkpdes_rincian'") or die(mysqli_error($Conn)); 
                                            if($UpdateRkpdes){
                                                $JumlahDataProses=$JumlahDataProses+1;
                                            }else{
                                                $JumlahDataProses=$JumlahDataProses+0;
                                            }
                                        }else{
                                            //Insert
                                            $entry="INSERT INTO rkpdes_rincian (
                                                id_rkpdes,
                                                id_wilayah,
                                                tahun,
                                                kode,
                                                kode_bidang,
                                                kode_sub_bidang,
                                                kode_kegiatan,
                                                nama,
                                                level,
                                                anggaran
                                            ) VALUES (
                                                '$id_rkpdes',
                                                '$SessionIdWilayah',
                                                '$periode',
                                                '$kode',
                                                '$kode_bidang',
                                                '$kode_sub_bidang',
                                                '$kode_kegiatan',
                                                '$nama',
                                                '$level',
                                                '$anggaran'
                                            )";
                                            $Input=mysqli_query($Conn, $entry);
                                            if($Input){
                                                $JumlahDataProses=$JumlahDataProses+1;
                                                echo "$i (Berhasil)<br>";
                                            }else{
                                                $JumlahDataProses=$JumlahDataProses+0;
                                                echo "$i (kode $kode Gagal Input)<br>";
                                            }
                                        }
                                    }else{
                                        echo "$i (Kode $kode Tidak Valid)<br>";
                                    }
                                }
                                if($JumlahDataProses==$JumlahValidator){
                                    $_SESSION['NotifikasiSwal']="Import Dataset RKPDES Berhasil";
                                    echo '<small class="text-success" id="NotifikasiUploadDatasetBerhasil">Success</small>';
                                }else{
                                    echo '<code class="text-danger">Terjadi kesalahan pada saat entry data ke database</code>';
                                }
                            }else{
                                echo '<code class="text-danger">Ada nilai anggaran yang tidak valid. Pastikan anda menulis anggaran dengan format numeric</code>';
                            }
                        }else{
                            echo '<code class="text-danger">Ada kode Bidang/Kegiatan yang tidak valid</code>';
                        }
                    }else{
                        echo '<code class="text-danger">Format File yang anda gunakan tidak valid, anda hanya boleh menggunakan format excel sesuai template</code>';
                    }
                }
            }
        }
    }
?>