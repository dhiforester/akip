<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
    $id_evaluasi_periode="";
    $id_komponen="";
    $id_komponen_sub="";
    $id_kriteria="";
    
    $response = [
        "status" => "Error",
        "message" => "Belum ada proses yang dilakukan pada sistem."
    ];

    if (empty($SessionIdAkses)) {
        $response = [
            "status" => "Error",
            "message" => "Sesi Akses Sudah Berakhir, Silahkan Login Ulang"
        ];
        echo json_encode($response);
        exit;
    }

    // Validasi Data Tidak Boleh Kosong
    $requiredFields = [
        'level' => "Informasi Level Tidak Boleh Kosong!",
        'kode' => "Kode Tidak Boleh Kosong!",
        'nama' => "Nama Tidak Boleh Kosong!",
        'keterangan' => "Keterangan Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $level = validateAndSanitizeInput($_POST['level']);
    $kode = validateAndSanitizeInput($_POST['kode']);
    $nama = validateAndSanitizeInput($_POST['nama']);
    $keterangan = validateAndSanitizeInput($_POST['keterangan']);
    $id_evaluasi_periode = $_POST['id_evaluasi_periode'] ?? "";
    $id_komponen = $_POST['id_komponen'] ?? "";
    $id_komponen_sub = $_POST['id_komponen_sub'] ?? "";
    $id_kriteria = $_POST['id_kriteria'] ?? "";

    //Validasi Level
    if($level=="Komponen"){
        //Validasi Komponen
        if(empty($id_evaluasi_periode)){
            $validasi_level="Id Periode Tidak Boleh Kosong!";
        }else{
            $validasi_level="Valid";
        }
    }else{
        if($level=="Sub Komponen"){
            //Validasi Sub Komponen
            if(empty($id_evaluasi_periode)){
                $validasi_level="Id Periode Tidak Boleh Kosong!";
            }else{
                if(empty($id_komponen)){
                    $validasi_level="Id Komponen Tidak Boleh Kosong!";
                }else{
                    $validasi_level="Valid";
                }
            }
        }else{
            if($level=="Kriteria"){
                //Validasi Kriteria
                if(empty($id_evaluasi_periode)){
                    $validasi_level="Id Periode Tidak Boleh Kosong!";
                }else{
                    if(empty($id_komponen)){
                        $validasi_level="Id Komponen Tidak Boleh Kosong!";
                    }else{
                        if(empty($id_komponen_sub)){
                            $validasi_level="Id Sub Komponen Tidak Boleh Kosong!";
                        }else{
                            $validasi_level="Valid";
                        }
                    }
                }
            }else{
                if($level=="Uraian"){
                    //Validasi Uraian
                    if(empty($id_evaluasi_periode)){
                        $validasi_level="Id Periode Tidak Boleh Kosong!";
                    }else{
                        if(empty($id_komponen)){
                            $validasi_level="Id Komponen Tidak Boleh Kosong!";
                        }else{
                            if(empty($id_komponen_sub)){
                                $validasi_level="Id Sub Komponen Tidak Boleh Kosong!";
                            }else{
                                if(empty($id_kriteria)){
                                    $validasi_level="Id Kriteria Tidak Boleh Kosong!";
                                }else{
                                    $validasi_level="Valid";
                                }
                            }
                        }
                    }
                }else{
                    $validasi_level="Level Tidak Valid";
                }
            }
        }
    }
    if($validasi_level!=="Valid"){
        echo json_encode(["status" => "Error", "message" => $validasi_level]);
        exit;
    }

    // Validasi panjang karakter
    $maxLengths = [
        'kode' => 20,
        'nama' => 250,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }
    
    
    //Validasi Duplikat
    if($level=="Komponen"){
        $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_komponen FROM komponen WHERE id_evaluasi_periode='$id_evaluasi_periode' AND kode='$kode'"));
    }else{
        if($level=="Sub Komponen"){
            $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_komponen_sub FROM komponen_sub WHERE id_evaluasi_periode='$id_evaluasi_periode' AND id_komponen='$id_komponen' AND kode='$kode'"));
        }else{
            if($level=="Kriteria"){
                $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_kriteria FROM kriteria WHERE id_evaluasi_periode='$id_evaluasi_periode' AND id_komponen='$id_komponen' AND id_komponen_sub='$id_komponen_sub' AND kode='$kode'"));
            }else{
                $validasi_level="Level Tidak Valid";
            }
        }
    }
    
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Kode yang akan anda masukan sudah ada"]);
        exit;
    }

    //Validasi Proses
    $validasi_input="Belum ADa Proses";
    if($level=="Komponen"){
        $id_komponen=generateRandomString(36);
        // Insert Data
        $query_insert = "INSERT INTO komponen (id_komponen, id_evaluasi_periode, kode, nama, keterangan) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $Conn->prepare($query_insert);
        if ($stmt_insert) {
            $stmt_insert->bind_param("sssss", $id_komponen,  $id_evaluasi_periode, $kode, $nama, $keterangan);
            if ($stmt_insert->execute()) {
                //Jika Berhasil Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komponen','Tambah Komponen');
                if($SimpanLog=="Success"){
                    $validasi_input="Berhasil";
                }else{
                    $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                }
            } else {
                $validasi_input="Terjadi kesalahan saat input ke database";
            }
        } else {
            $validasi_input="Terjadi kesalahan saat mempersiapkan statement database";
        }
    }else{
        if($level=="Sub Komponen"){
            $id_komponen_sub =generateRandomString(36);
            // Insert Data
            $query_insert = "INSERT INTO komponen_sub (id_komponen_sub, id_komponen, id_evaluasi_periode, kode, nama, keterangan) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $Conn->prepare($query_insert);
            if ($stmt_insert) {
                $stmt_insert->bind_param("ssssss", $id_komponen_sub, $id_komponen,  $id_evaluasi_periode, $kode, $nama, $keterangan);
                if ($stmt_insert->execute()) {
                    //Jika Berhasil Simpan Log
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Sub Komponen','Tambah Sub Komponen');
                    if($SimpanLog=="Success"){
                        $validasi_input="Berhasil";
                    }else{
                        $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                    }
                } else {
                    $validasi_input="Terjadi kesalahan saat input ke database";
                }
            } else {
                $validasi_input="Terjadi kesalahan saat mempersiapkan statement database";
            }
        }else{
            if($level=="Kriteria"){
                $id_kriteria =generateRandomString(36);
                // Insert Data
                $query_insert = "INSERT INTO kriteria (id_kriteria, id_komponen_sub, id_komponen, id_evaluasi_periode, kode, nama, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $Conn->prepare($query_insert);
                if ($stmt_insert) {
                    $stmt_insert->bind_param("sssssss", $id_kriteria, $id_komponen_sub, $id_komponen,  $id_evaluasi_periode, $kode, $nama, $keterangan);
                    if ($stmt_insert->execute()) {
                        //Jika Berhasil Simpan Log
                        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kriteria','Tambah Kriteria');
                        if($SimpanLog=="Success"){
                            $validasi_input="Berhasil";
                        }else{
                            $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                        }
                    } else {
                        $validasi_input="Terjadi kesalahan saat input ke database";
                    }
                } else {
                    $validasi_input="Terjadi kesalahan saat mempersiapkan statement database";
                }
            }else{
        
            }
        }
    }

    if($validasi_input!=="Berhasil"){
        echo json_encode(["status" => "Error", "message" => $validasi_input]);
        exit;
    }else{
        echo json_encode(["status" => "Success", "message" => $validasi_input]);
        exit;
    }
?>
