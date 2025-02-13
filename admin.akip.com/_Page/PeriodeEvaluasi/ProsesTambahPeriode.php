<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
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
        'periode' => "Nama Periode Tidak Boleh Kosong!",
        'tanggal_mulai' => "Tanggal Mulai Tidak Boleh Kosong!",
        'tanggal_selesai' => "Tanggal Berakhir Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $periode = validateAndSanitizeInput($_POST['periode']);
    $tanggal_mulai = validateAndSanitizeInput($_POST['tanggal_mulai']);
    $tanggal_selesai = validateAndSanitizeInput($_POST['tanggal_selesai']);
    

    // Validasi panjang karakter
    $maxLengths = [
        'periode' => 20
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Format Tanggal
    if (validateDate($tanggal_mulai)) {
        if (validateDate($tanggal_selesai)) {
            if($tanggal_mulai>=$tanggal_selesai){
                $validasi_tanggal="Tanggal Mulai Tidak Boleh Lebih Besar Sama Dengan Tanggal Selesai";
            }else{
                $validasi_tanggal="Valid";
            }
        } else {
            $validasi_tanggal="Format Tanggal Selesai Tidak Valid";
        }
    } else {
        $validasi_tanggal="Format Tanggal Mulai Tidak Valid";
    }
    if($validasi_tanggal!=="Valid"){
        echo json_encode(["status" => "Error", "message" => $validasi_tanggal]);
            exit;
    }
    
    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_evaluasi_periode FROM evaluasi_periode WHERE periode='$periode'"));
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Nama periode yang akan anda masukan sudah ada"]);
        exit;
    }

    $id_evaluasi_periode=generateRandomString(36);
    // Insert Data
    $query_insert = "INSERT INTO evaluasi_periode (id_evaluasi_periode, periode, date_mulai, date_selesai) VALUES (?, ?, ?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);

    if ($stmt_insert) {
        $stmt_insert->bind_param("ssss", $id_evaluasi_periode,  $periode, $tanggal_mulai, $tanggal_selesai);
        if ($stmt_insert->execute()) {

            //Jika Berhasil Simpan Log
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Periode Evaluasi','Tambah Periode Evaluasi');
            if($SimpanLog=="Success"){
                echo json_encode(["status" => "Success", "message" => "Tambah Periode Evaluasi Berhasil!"]);
            }else{
                echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
            }
        } else {
            echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database"]);
    }
?>
