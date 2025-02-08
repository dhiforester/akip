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
    if(empty($_FILES['FileImport']['name'])){
        echo '<small class="text-danger">File tidak boleh kosong</small>';
    }else{
        $nama_file=$_FILES['FileImport']['name'];
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['FileImport']['name']) && in_array($_FILES['FileImport']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['FileImport']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['FileImport']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $JumlahBaris=count($sheetData);
            if($JumlahBaris>100){
                echo '<small class="text-danger">Jumlah data maksimal 100 baris, lakukan pembagian beberapa file terpisah jika melebihi</small>';
            }else{
                $no=1;
                for($i=1; $i<$JumlahBaris; $i++){
                    $nomor = $sheetData[$i]['0'];
                    $nama = $sheetData[$i]['1'];
                    $nik = $sheetData[$i]['2'];
                    $kk = $sheetData[$i]['3'];
                    $alamat = $sheetData[$i]['4'];
                    $kontak = $sheetData[$i]['5'];
                    $pernikahan = $sheetData[$i]['6'];
                    $pekerjaan = $sheetData[$i]['7'];
                    $gender = $sheetData[$i]['8'];
                    $tempat_lahir = $sheetData[$i]['9'];
                    $tanggal_lahir = $sheetData[$i]['10'];
                    $hidup = $sheetData[$i]['11'];
                    $keberadaan = $sheetData[$i]['12'];
                    if(!preg_match("/^[0-9]*$/", $nik)){
                        echo '<small class="credit text-danger">'.$no.'. Nik Hanya Boleh Format Angka</small><br>';
                    }else{
                        if(!preg_match("/^[0-9]*$/", $kk)){
                            echo '<small class="credit text-danger">'.$no.'. KK Hanya Boleh Format Angka</small><br>';
                        }else{
                            if(!preg_match("/^[0-9]*$/", $kontak)){
                                echo '<small class="credit text-danger">'.$no.'. Kontak Hanya Boleh Format Angka</small><br>';
                            }else{
                                //Validasi kontak tidak boleh duplikat
                                $ValidasiDuplikatNik=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE nik='$nik'"));
                                if(!empty($ValidasiDuplikatNik)){
                                    echo '<small class="credit text-danger">'.$no.'. Nik pada baris ini sudah ada</small><br>';
                                }else{
                                    $dateTime = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
                                    if ($dateTime && $dateTime->format('Y-m-d') === $tanggal_lahir) {
                                        //Buka Wilayah
                                        $id_wilayah=$SessionIdWilayah;
                                        //Buka Nama Daerah
                                        $desa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
                                        $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                                        $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                                        $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                                        $entry="INSERT INTO penduduk (
                                            id_wilayah,
                                            propinsi,
                                            kabupaten,
                                            kecamatan,
                                            desa,
                                            nik,
                                            kk,
                                            nama,
                                            alamat,
                                            kontak,
                                            pernikahan,
                                            pekerjaan,
                                            gender,
                                            tempat_lahir,
                                            tanggal_lahir,
                                            hidup,
                                            keberadaan,
                                            updatetime
                                        ) VALUES (
                                            '$id_wilayah',
                                            '$propinsi',
                                            '$kabupaten',
                                            '$kecamatan',
                                            '$desa',
                                            '$nik',
                                            '$kk',
                                            '$nama',
                                            '$alamat',
                                            '$kontak',
                                            '$pernikahan',
                                            '$pekerjaan',
                                            '$gender',
                                            '$tempat_lahir',
                                            '$tanggal_lahir',
                                            '$hidup',
                                            '$keberadaan',
                                            '$now'
                                        )";
                                        $Input=mysqli_query($Conn, $entry);
                                        if($Input){
                                            echo '<small class="credit text-success">'.$no.'. File Berhasil Disimpan</small><br>';
                                        }else{
                                            echo '<small class="credit text-danger">'.$no.'. Gagal Disimpan Ke Database</small><br>';
                                        }
                                    } else {
                                        echo '<small class="credit text-danger">'.$no.'. Format tanggal lahir salah</small><br>';
                                    }
                                }
                            }
                        }
                    }
                    $no++;
                }
            }
        }else{
            echo '<small class="text-danger">Tidak ada file yang diimport</small>';
        }
    }
?>
<div class="row">
    <div class="col-md-12">
        <a href="" class="btn btn-md btn-block btn-outline-primary">
            Reload Halaman
        </a>
    </div>
</div>