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
        'id_kabkot' => "ID Kabupaten/Kota Tidak Boleh Kosong!",
        'nama' => "Nama Inspektorat Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_provinsi = validateAndSanitizeInput($_POST['id_provinsi']);
    $id_kabkot = validateAndSanitizeInput($_POST['id_kabkot']);
    $nama_inspektorat = validateAndSanitizeInput($_POST['nama']);
    
    //Variabel Yang Tidak Wajib
    if(!empty($_POST['kontak'])){
        $telepon=$_POST['kontak'];
    }else{
        $telepon="";
    }
    if(!empty($_POST['alamat'])){
        $alamat=$_POST['alamat'];
    }else{
        $alamat="";
    }

    // Validasi panjang karakter
    $maxLengths = [
        'nama_inspektorat' => 100,
        'telepon' => 20,
        'alamat' => 250,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_inspektorat FROM inspektorat WHERE nama_inspektorat='$nama_inspektorat'"));
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Nama Inspektorat yang akan anda masukan sudah ada"]);
        exit;
    }

    $id_inspektorat=generateRandomString(36);
    // Insert Data
    $query_insert = "INSERT INTO inspektorat (id_inspektorat, id_provinsi, id_kabkot, nama_inspektorat, telepon, alamat) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);

    if ($stmt_insert) {
        $stmt_insert->bind_param("ssssss", $id_inspektorat,  $id_provinsi, $id_kabkot, $nama_inspektorat, $telepon, $alamat);
        if ($stmt_insert->execute()) {

            //Jika Berhasil Simpan Log
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Inspektorat','Tambah Inspektorat Berhasil');
            if($SimpanLog=="Success"){
                echo json_encode(["status" => "Success", "message" => "Tambah Inspektorat Berhasil!"]);
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
