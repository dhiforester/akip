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
        'id_provinsi' => "ID Provinsi Tidak Boleh Kosong!",
        'kabkot' => "Kabupaten/Kota Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_provinsi = validateAndSanitizeInput($_POST['id_provinsi']);
    $kabkot = validateAndSanitizeInput($_POST['kabkot']);
    

    // Validasi panjang karakter
    $maxLengths = [
        'kabkot' => 50
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=GetDetailData($Conn, 'wilayah_kabkot', 'kabkot', $kabkot, 'id_kabkot');
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Kabupaten/Kota yang akan anda masukan sudah ada"]);
        exit;
    }

    

    // Insert Data
    $query_insert = "INSERT INTO wilayah_kabkot (id_provinsi, kabkot) VALUES (?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);

    if ($stmt_insert) {
        $stmt_insert->bind_param("is", $id_provinsi, $kabkot);
        if ($stmt_insert->execute()) {
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Kabupaten/Kota','Tambah Kabupaten/Kota');
            if($SimpanLog=="Success"){
                echo json_encode(["status" => "Success", "message" => "Tambah Kabupaten/Kota Berhasil!"]);
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
