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
        'id_akses' => "ID Akses Tidak Boleh Kosong!",
        'password' => "Password Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_akses = validateAndSanitizeInput($_POST['id_akses']);
    $password = validateAndSanitizeInput($_POST['password']);
    

    // Validasi panjang karakter
    $maxLengths = [
        'password' => 20,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    if(strlen($password)<5){
        echo json_encode(["status" => "Error", "message" => "Password Minimal 5 karakter huruf dan angka"]);
        exit;
    }
    
    // Update Data
    $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
        password=?
    WHERE id_akses=?");
    mysqli_stmt_bind_param($stmt_update, "si", 
        $password, 
        $id_akses
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Edit Password');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Password Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update data ke database"]);
    }
?>
