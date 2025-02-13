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
        'kontak' => 20,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Duplikasi Email
    $email_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'email');
    if($email_lama==$email){
        $validasi_email_duplikat=0;
    }else{
        $validasi_email_duplikat=GetDetailData($Conn, 'akses', 'email', $email, 'id_akses');
    }

    //Validasi Duplikasi Kontak
    $kontak_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'kontak');
    if($kontak_lama==$kontak){
        $validasi_kontak_duplikat=0;
    }else{
        $validasi_kontak_duplikat=GetDetailData($Conn, 'akses', 'kontak', $kontak, 'id_akses');
    }

    //Validasi Tidak Boleh Duplikat
    if(!empty($validasi_email_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Email yang akan anda masukan sudah ada"]);
        exit;
    }
    if(!empty($validasi_kontak_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Kontak yang akan anda masukan sudah ada"]);
        exit;
    }
    // Update Data
    $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
        nama=?, 
        kontak=?, 
        email=?
    WHERE id_akses=?");
    mysqli_stmt_bind_param($stmt_update, "sssi", 
        $nama, 
        $kontak,
        $email,
        $id_akses
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Edit Akses');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Akses Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update data ke database"]);
    }
?>
