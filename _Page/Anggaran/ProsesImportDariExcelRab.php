<?php
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_anggaran_rincian tidak boleh kosong
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<small class="text-danger">ID Rincian Anggaran tidak boleh kosong</small>';
    }else{
        //Validasi ID Anggaran tidak boleh kosong
        if(empty($_POST['id_anggaran'])){
            echo '<small class="text-danger">ID Anggaran tidak boleh kosong</small>';
        }else{
            if(empty($_FILES['file_excel']['name'])){
                echo '<small class="text-danger">File tidak boleh kosong</small>';
            }else{
                $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
                $id_anggaran=$_POST['id_anggaran'];
                $nama_file=$_FILES['file_excel']['name'];
                $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                if(isset($_FILES['file_excel']['name']) && in_array($_FILES['file_excel']['type'], $file_mimes)) {
                    $arr_file = explode('.', $_FILES['file_excel']['name']);
                    $extension = end($arr_file);
                    if('csv' == $extension) {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    } else {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    }
                    $spreadsheet = $reader->load($_FILES['file_excel']['tmp_name']);
                    $sheetData = $spreadsheet->getActiveSheet()->toArray();
                    $JumlahBaris=count($sheetData);
                    $JumlahValid=0;
                    for($i=1; $i<$JumlahBaris; $i++){
                        $kode = $sheetData[$i]['0'];
                        $kategori = $sheetData[$i]['1'];
                        $uraian = $sheetData[$i]['2'];
                        $volume = $sheetData[$i]['3'];
                        $satuan = $sheetData[$i]['4'];
                        $harga = $sheetData[$i]['5'];
                        if(!preg_match("/^[0-9]*$/", $volume)){
                            $JumlahValid=$JumlahValid+0;
                        }else{
                            if(!preg_match("/^[0-9]*$/", $harga)){
                                $JumlahValid=$JumlahValid+0;
                            }else{
                                $JumlahValid=$JumlahValid+1;
                            }
                        }
                    }
                    if(($JumlahBaris-1)!==$JumlahValid){
                        echo '<small class="text-danger">Volume dan harga hanya boleh diisi oleh angka!</small>';
                    }else{
                        $JumlahValid=0;
                        for($i=2; $i<$JumlahBaris; $i++){
                            $kode = $sheetData[$i]['0'];
                            $kategori = $sheetData[$i]['1'];
                            $uraian = $sheetData[$i]['2'];
                            $volume = $sheetData[$i]['3'];
                            $satuan = $sheetData[$i]['4'];
                            $harga = $sheetData[$i]['5'];
                            $jumlah=$harga*$volume;
                            if(!empty($sheetData[$i]['1'])){
                                $entry="INSERT INTO anggaran_rab (
                                    id_anggaran,
                                    id_anggaran_rincian,
                                    kode_rab,
                                    kategori_program,
                                    uraian,
                                    volume,
                                    satuan,
                                    harga,
                                    jumlah
                                ) VALUES (
                                    '$id_anggaran',
                                    '$id_anggaran_rincian',
                                    '$kode',
                                    '$kategori',
                                    '$uraian',
                                    '$volume',
                                    '$satuan',
                                    '$harga',
                                    '$jumlah'
                                )";
                                $Input=mysqli_query($Conn, $entry);
                                if($Input){
                                    $JumlahValid=$JumlahValid+1;
                                }else{
                                    $JumlahValid=$JumlahValid+0;
                                }
                            }
                        }
                        //Hitung Ulang jumlah rincian
                        $SqlJumlah = "SELECT SUM(jumlah) AS total FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian'";
                        $result = $Conn->query($SqlJumlah);
                        // Periksa apakah hasil kueri tersedia
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $anggaran=$row['total'];
                        } else {
                            $anggaran =0;
                        }
                        //Update Anggaran
                        $UpdateAnggaran = mysqli_query($Conn,"UPDATE anggaran_rincian SET 
                            volume='',
                            satuan='',
                            anggaran='$anggaran'
                        WHERE id_anggaran_rincian='$id_anggaran_rincian'") or die(mysqli_error($Conn)); 
                        if($UpdateAnggaran){
                            $kategori_log="Anggaran";
                            $deskripsi_log="Tambah RAB Anggaran Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                echo '<small class="text-success" id="NotifikasiImportDariExcelRabBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat update rincian anggaran</small>';
                        }
                    }
                }
            }
        }
    }
?>