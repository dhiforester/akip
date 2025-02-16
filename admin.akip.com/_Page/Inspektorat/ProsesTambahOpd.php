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
        'id_inspektorat' => "ID Inspektorat Tidak Boleh Kosong!",
        'opd' => "Nama OPD Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_inspektorat = validateAndSanitizeInput($_POST['id_inspektorat']);
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
    $id_kabkot=GetDetailData($Conn, 'inspektorat', 'id_inspektorat', $id_inspektorat, 'id_kabkot');
    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd WHERE nama_opd='$opd' AND id_kabkot='$id_kabkot'"));
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Nama OPD yang akan anda masukan sudah ada"]);
        exit;
    }

    //Validasi Kontak hanya angka
    if (!preg_match('/^\d+$/', $telepon)) {
        echo json_encode(["status" => "Error", "message" => "Nomor telepon OPD hanya boleh angka"]);
        exit;
    }

    //Buka id_provinsi berdasarkan id_kabkot
    $id_provinsi=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'id_provinsi');
    // Insert Data
    $query_insert = "INSERT INTO opd (id_provinsi, id_kabkot, id_inspektorat, nama_opd, telepon, alamat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);

    if ($stmt_insert) {
        $stmt_insert->bind_param("iissss", $id_provinsi,  $id_kabkot, $id_inspektorat, $opd, $telepon, $alamat);
        if ($stmt_insert->execute()) {
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'OPD','Tambah OPD');
            if($SimpanLog=="Success"){
                echo json_encode(["status" => "Success", "message" => "Tambah OPD Berhasil!"]);
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
