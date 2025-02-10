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
        'id_kabkot' => "ID Kabupaten/Kota Tidak Boleh Kosong!",
        'kabkot' => "Kabupaten/Kota Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_kabkot = validateAndSanitizeInput($_POST['id_kabkot']);
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
    //Kabkot Lama
    $kabkot_lama=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
    if($kabkot_lama==$kabkot){
        $validasi_duplikat=0;
    }else{
        $validasi_duplikat=GetDetailData($Conn, 'wilayah_kabkot', 'kabkot', $kabkot, 'id_kabkot');
    }
    //Validasi Tidak Boleh Duplikat
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Kabupaten/Kota yang akan anda masukan sudah ada"]);
        exit;
    }

    // Update Data
    $stmt_update = mysqli_prepare($Conn, "UPDATE wilayah_kabkot SET 
        kabkot=?
    WHERE id_kabkot=?");
    mysqli_stmt_bind_param($stmt_update, "si", 
        $kabkot, 
        $id_kabkot
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Kabupaten/Kota','Edit Kabupaten/Kota');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Kabupaten/Kota Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update data ke database"]);
    }
?>
