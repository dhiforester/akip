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
        'id_uraian' => "ID Uraian Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            $response = [
                "status" => "Error",
                "message" => $errorMessage
            ];
            echo json_encode($response);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_uraian = validateAndSanitizeInput($_POST['id_uraian']);
    
    //Validasi Proses
    $hapus = mysqli_query($Conn, "DELETE FROM uraian WHERE id_uraian='$id_uraian'") or die(mysqli_error($Conn));
    if ($hapus) {
        //Jika Berhasil Simpan Log
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Uraian','Hapus Uraian');
        if($SimpanLog=="Success"){
            $validasi_input="Berhasil";
        }else{
            $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
        }
    } else {
        $validasi_input="Terjadi kesalahan saat hapus data dari database";
    }

    if($validasi_input!=="Berhasil"){
        $response = [
            "status" => "Error",
            "message" => $validasi_input
        ];
        echo json_encode($response);
        exit;
    }else{
        $response = [
            "status" => "Success",
            "message" => $validasi_input
        ];
        echo json_encode($response);
        exit;
    }
?>
