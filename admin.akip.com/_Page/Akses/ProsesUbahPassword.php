<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');

    //Sessi Akses Tidak Boleh Kosong
    if(empty($SessionIdAkses)){
        echo json_encode(["status" => "Error", "message" => "Sesi Akses Sudah Berakhir! Silahkan Login Ulang!"]);
        exit;
    }
    // Validasi Data Tidak Boleh Kosong
    $requiredFields = [
        'id_akses' => "ID Akses Tidak Boleh Kosong!",
        'password' => "Password Tidak Boleh Kosong!",
        'ulangi_password' => "Ulangi Password Tidak Boleh Kosong!",
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
    $ulangi_password = validateAndSanitizeInput($_POST['ulangi_password']);

    //Password Harus Sama
    if($password!==$ulangi_password){
        echo json_encode(["status" => "Error", "message" => "Password Tidak Sama"]);
        exit;
    }

    //Password Tidak Boleh Lebih Dari 20 karakter
    if(strlen($password)>20){
        echo json_encode(["status" => "Error", "message" => "Password Tidak Boleh Lebih Dari 20 Karakter"]);
        exit;
    }

    //Password Tidak Boleh Kurang Dari 6 karakter
    if(strlen($password)<6){
        echo json_encode(["status" => "Error", "message" => "Password Tidak Boleh kurang dari 6 Karakter"]);
        exit;
    }

    //Validasi id_akses
    $id_akses=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'id_akses');
    
    if(empty($id_akses)){
        echo json_encode(["status" => "Error", "message" => "ID akses Tidak Valid"]);
        exit;
    }

    //Hasing Password
    $password=password_hash($password, PASSWORD_DEFAULT);

    //Update Akses
    $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
        password=?
    WHERE id_akses=?");
    mysqli_stmt_bind_param($stmt_update, "si", 
        $password,
        $id_akses
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {

        //Jika Berhasil Simpan Log
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Update Password Berhasil');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Update Password Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
    }
?>