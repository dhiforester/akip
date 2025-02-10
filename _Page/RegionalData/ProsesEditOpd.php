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
        'id_opd' => "ID OPD Tidak Boleh Kosong!",
        'opd' => "Nama OPD Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_opd = validateAndSanitizeInput($_POST['id_opd']);
    $opd = validateAndSanitizeInput($_POST['opd']);
    //Variabel Yang Boleh Kosong
    if(empty($_POST['telepon'])){
        $telepon = 0;
    }else{
        $telepon = $_POST['telepon'];
    }
    if(empty($_POST['alamat'])){
        $alamat = "";
    }else{
        $alamat = $_POST['alamat'];
    }

    // Validasi panjang karakter
    $maxLengths = [
        'opd' => 250,
        'telepon' => 20,
        'alamat' => 250,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }
    //Buka OPD lama
    $opd_lama=GetDetailData($Conn, 'opd', 'id_opd', $id_opd, 'nama_opd');
    $id_kabkot=GetDetailData($Conn, 'opd', 'id_opd', $id_opd, 'id_kabkot');

    //Validasi Tidak Boleh Duplikat
    if($opd_lama==$opd){
        $validasi_duplikat=0;
    }else{
        $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd WHERE nama_opd='$opd' AND id_kabkot='$id_kabkot'"));
    }
    
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Nama OPD yang akan anda masukan sudah ada"]);
        exit;
    }

    //Validasi Kontak hanya angka
    if (!preg_match('/^\d+$/', $telepon)) {
        echo json_encode(["status" => "Error", "message" => "Nomor telepon OPD hanya boleh angka"]);
        exit;
    }

    $stmt_update = mysqli_prepare($Conn, "UPDATE opd SET 
        nama_opd=?, 
        telepon=?, 
        alamat=? 
    WHERE id_opd=?");
    mysqli_stmt_bind_param($stmt_update, "sssi", 
        $opd, 
        $telepon, 
        $alamat, 
        $id_opd
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'OPD','Tambah OPD');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit OPD Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update ke database"]);
    }
?>
