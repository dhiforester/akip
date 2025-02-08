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
    //Validasi File
    if(empty($_FILES['file_akses_kecamatan']['name'])){
        echo '<code class="text-danger">File tidak boleh kosong</code>';
    }else{
        $nama_file=$_FILES['file_akses_kecamatan']['name'];
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($_FILES['file_akses_kecamatan']['name']) && in_array($_FILES['file_akses_kecamatan']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file_akses_kecamatan']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file_akses_kecamatan']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $JumlahBaris=count($sheetData);
            $JumlahValidator=$JumlahBaris-1;
            if(empty($JumlahValidator)){
                echo '<code class="text-danger">Tidak ada data akses wilayah pada file excel yang anda upload</code>';
            }else{
                echo '<ol>';
                $JumlahKodeValid=0;
                for($i=1; $i<=$JumlahBaris; $i++){
                    $id_wilayah = $sheetData[$i]['0'];
                    $kecamatan = $sheetData[$i]['1'];
                    $nama = $sheetData[$i]['2'];
                    $email = $sheetData[$i]['3'];
                    $kontak = $sheetData[$i]['4'];
                    $password = $sheetData[$i]['5'];
                    if(empty($sheetData[$i]['0'])){
                        echo '<li class="text-danger">Baris ke '.$i.' ID wilayah tidak boleh kosong</li>';
                    }else{
                        if(empty($sheetData[$i]['1'])){
                            echo '<li class="text-danger">Baris ke '.$i.' : nama kecamatan tidak boleh kosong</li>';
                        }else{
                            if(empty($sheetData[$i]['2'])){
                                echo '<li class="text-danger">Baris ke '.$i.' : nama pengguna tidak boleh kosong</li>';
                            }else{
                                if(empty($sheetData[$i]['3'])){
                                    echo '<li class="text-danger">Baris ke '.$i.' : email pengguna tidak boleh kosong</li>';
                                }else{
                                    if(empty($sheetData[$i]['4'])){
                                        echo '<li class="text-danger">Baris ke '.$i.' : kontak pengguna tidak boleh kosong</li>';
                                    }else{
                                        if(empty($sheetData[$i]['5'])){
                                            echo '<li class="text-danger">Baris ke '.$i.' : password pengguna tidak boleh kosong</li>';
                                        }else{
                                            $JumlahKarakterKontak=strlen($kontak);
                                            if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $kontak)){
                                                echo '<li class="text-danger">Baris ke '.$i.' : Kontak terdiri dari 6-20 karakter numerik</li>';
                                            }else{
                                                //Validasi jumlah dan jenis karakter password
                                                $JumlahKarakterPassword=strlen($password);
                                                if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $password)){
                                                    echo '<li class="text-danger">Baris ke '.$i.' : Password hanya boleh terdiri dari 6-20 karakter numerik dan huruf</li>';
                                                }else{
                                                    $JumlahKodeValid=$JumlahKodeValid+1;
                                                    echo '<li class="text-success">Baris ke '.$i.' : Data Valid</li>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                echo '</ol>';
                if($JumlahKodeValid!==$JumlahValidator){
                    echo '<code class="text-danger">Data yang diimport ada yang tidak valid. Silahkan perbaiki terlebih dulu</code>';
                }else{
                    for($i=1; $i<$JumlahBaris; $i++){
                        $id_wilayah = $sheetData[$i]['0'];
                        $kecamatan = $sheetData[$i]['1'];
                        $nama = $sheetData[$i]['2'];
                        $email = $sheetData[$i]['3'];
                        $kontak = $sheetData[$i]['4'];
                        $password = $sheetData[$i]['5'];
                        $id_akses_entitas=getDataDetail($Conn,'akses_entitas','akses','Kecamatan','id_akses_entitas');
                        $password=MD5($password);
                        //Simpan Data
                        $entry="INSERT INTO akses (
                            id_wilayah,
                            id_akses_entitas,
                            nama,
                            kontak,
                            email,
                            password,
                            akses,
                            foto,
                            updatetime
                        ) VALUES (
                            '$id_wilayah',
                            '$id_akses_entitas',
                            '$nama',
                            '$kontak',
                            '$email',
                            '$password',
                            'Kecamatan',
                            '',
                            '$now'
                        )";
                        $Input=mysqli_query($Conn, $entry);
                        if($Input){
                            //Cari id_akses bersangkutan
                            $id_akses =getDataDetail($Conn,'akses','email',$email,'id_akses');
                            //Buka Standar Fitur
                            $standar_fitur =getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
                            //Decode Standar Fitur Menjadi Array
                            $standar_fitur = json_decode($standar_fitur, true);
                            //Hitung Jumlah Keseluruhan
                            $JumlahStandarFitur=count($standar_fitur);
                            foreach($standar_fitur as $list_standar){
                                $id_akses_fitur=$list_standar['id_akses_fitur'];
                                $kode=$list_standar['kode'];
                                //Input Ke ijin akses
                                $EntryIjinAkses="INSERT INTO akses_ijin (
                                    id_akses,
                                    id_akses_fitur,
                                    kode
                                ) VALUES (
                                    '$id_akses',
                                    '$id_akses_fitur',
                                    '$kode'
                                )";
                                $InputIjinAkses=mysqli_query($Conn, $EntryIjinAkses);
                            }
                        }
                    }
                    echo '<small class="text-success" id="NotifikasiImportAksesKecamatanBerhasil">Success</small>';
                }
            }
        }
    }
?>