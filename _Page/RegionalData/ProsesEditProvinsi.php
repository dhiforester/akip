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
        'provinsi' => "Provinsi Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_provinsi = validateAndSanitizeInput($_POST['id_provinsi']);
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
    //Provinsi Lama
    $provinsi_lama=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');
    if($provinsi_lama==$provinsi){
        $validasi_duplikat=0;
    }else{
        $validasi_duplikat=GetDetailData($Conn, 'wilayah_provinsi', 'provinsi', $provinsi, 'id_provinsi');
    }
    //Validasi Tidak Boleh Duplikat
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Provinsi yang akan anda masukan sudah ada"]);
        exit;
    }

    // Update Data
    $stmt_update = mysqli_prepare($Conn, "UPDATE wilayah_provinsi SET 
        provinsi=?
    WHERE id_provinsi=?");
    mysqli_stmt_bind_param($stmt_update, "si", 
        $provinsi, 
        $id_provinsi
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Provinsi','Edit Provinsi');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Provinsi Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update data ke database"]);
    }
?>
