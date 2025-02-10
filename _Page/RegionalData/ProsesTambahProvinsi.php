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
        'provinsi' => "Provinsi Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $provinsi = validateAndSanitizeInput($_POST['provinsi']);
    

    // Validasi panjang karakter
    $maxLengths = [
        'provinsi' => 50
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=GetDetailData($Conn, 'wilayah_provinsi', 'provinsi', $provinsi, 'id_provinsi');
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Provinsi yang akan anda masukan sudah ada"]);
        exit;
    }

    

    // Insert Data
    $query_insert = "INSERT INTO wilayah_provinsi (provinsi) VALUES (?)";
    $stmt_insert = $Conn->prepare($query_insert);

    if ($stmt_insert) {
        $stmt_insert->bind_param("s", $provinsi);
        if ($stmt_insert->execute()) {
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Provinsi','Tambah Provinsi');
            if($SimpanLog=="Success"){
                echo json_encode(["status" => "Success", "message" => "Tambah Provinsi Berhasil!"]);
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
