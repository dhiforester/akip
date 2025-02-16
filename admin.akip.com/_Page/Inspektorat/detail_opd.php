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
        'id_opd' => "ID OPD Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_opd = validateAndSanitizeInput($_POST['id_opd']);

    $Qry = $Conn->prepare("SELECT * FROM opd WHERE id_opd= ?");
    $Qry->bind_param("i", $id_opd);
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
        if(empty($Data['id_opd'])){
            $response = [
                "status" => "Error",
                "message" => "Data Yang Anda Pilih ($id_opd) Tidak Ditemukan"
            ];
        }else{
            //Buka Data
            $id_opd=$Data['id_opd'];
            $id_provinsi=$Data['id_provinsi'];
            $id_kabkot=$Data['id_kabkot'];
            $nama_opd=$Data['nama_opd'];
            $telepon=$Data['telepon'];
            $alamat=$Data['alamat'];
            //Buka Nama Provinsi
            $provinsi=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');
            //Buka nama Kabupaten
            $kabkot=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
            //Data Detail
            $data_detail = [
                "id_opd" => $id_opd,
                "id_provinsi" => $id_provinsi,
                "id_kabkot" => $id_kabkot,
                "nama_opd" => $nama_opd,
                "telepon" => $telepon,
                "alamat" => $alamat,
                "provinsi" => $provinsi,
                "kabkot" => $kabkot
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
