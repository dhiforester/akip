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
        'nama' => "Nama Pengguna Tidak Boleh Kosong!",
        'email' => "Email Pengguna Tidak Boleh Kosong!",
        'kontak' => "Kontak Pengguna Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_akses = validateAndSanitizeInput($_POST['id_akses']);
    $nama = validateAndSanitizeInput($_POST['nama']);
    $email = validateAndSanitizeInput($_POST['email']);
    $kontak = validateAndSanitizeInput($_POST['kontak']);

    // Validasi panjang karakter
    $maxLengths = [
        'nama' => 250,
        'email' => 250,
        'kontak' => 20
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Duplikat Email
    $email_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'email');
    if($email==$email_lama){
        $ValidasiEmailDuplikat=0;
    }else{
        $ValidasiEmailDuplikat=GetDetailData($Conn, 'akses', 'email', $email, 'id_akses');
    }
    if(!empty( $ValidasiEmailDuplikat)){
        echo json_encode(["status" => "Error", "message" => "Email Yang Anda Gunakan Sudah Terdaftar"]);
        exit;
    }

    //Validasi Duplikat Kontak
    $kontak_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'kontak');
    if($kontak==$kontak_lama){
        $ValidasiKontakDuplikat=0;
    }else{
        $ValidasiKontakDuplikat=GetDetailData($Conn, 'akses', 'kontak', $kontak, 'id_akses');
    }
    if(!empty( $ValidasiKontakDuplikat)){
        echo json_encode(["status" => "Error", "message" => "Kontak Yang Anda Gunakan Sudah Terdaftar"]);
        exit;
    }

    //Update Akses
    $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
        nama=?, 
        email=?, 
        kontak=?
    WHERE id_akses=?");
    mysqli_stmt_bind_param($stmt_update, "sssi", 
        $nama, 
        $email, 
        $kontak,
        $id_akses
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {

        //Jika Berhasil Simpan Log
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Update Akses Berhasil');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Update Akses Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
    }
?>