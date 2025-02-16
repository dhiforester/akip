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
        'id_inspektorat' => "ID Inspektorat Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_inspektorat = validateAndSanitizeInput($_POST['id_inspektorat']);

    $Qry = $Conn->prepare("SELECT * FROM inspektorat WHERE id_inspektorat= ?");
    $Qry->bind_param("s", $id_inspektorat);
    if (!$Qry->execute()) {
        $error=$Conn->error;
        $response = [
            "status" => "Error",
            "message" => "Terjadi Kesalahan : $error"
        ];
    }else{
        $Result = $Qry->get_result();
        $Data = $Result->fetch_assoc();
        $Qry->close();
        if(empty($Data['id_inspektorat'])){
            $response = [
                "status" => "Error",
                "message" => "Data Yang Anda Pilih ($id_inspektorat) Tidak Ditemukan"
            ];
        }else{
            //Buka Data
            $id_inspektorat=$Data['id_inspektorat'];
            $id_provinsi=$Data['id_provinsi'];
            $id_kabkot=$Data['id_kabkot'];
            $nama_inspektorat=$Data['nama_inspektorat'];
            $telepon=$Data['telepon'];
            $alamat=$Data['alamat'];
            $data_detail = [
                "id_inspektorat" => $id_inspektorat,
                "id_provinsi" => $id_provinsi,
                "id_kabkot" => $id_kabkot,
                "nama_inspektorat" => $nama_inspektorat,
                "telepon" => $telepon,
                "alamat" => $alamat
            ];
            $response = [
                "status" => "Success",
                "message" => "Data Ditemukan",
                "data_detail" => $data_detail
            ];
            echo json_encode($response);
        }
    }
?>
