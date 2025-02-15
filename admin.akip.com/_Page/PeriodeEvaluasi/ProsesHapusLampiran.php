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
        'id_uraian' => "Id Uraian Tidak Boleh Kosong!",
        'id_lampiran' => "Id Lampiran Tidak Boleh Kosong!",
        'id_kriteria' => "ID Kriteria Tidak Boleh Kosong!"
    ];
    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_uraian = validateAndSanitizeInput($_POST['id_uraian']);
    $id_lampiran = validateAndSanitizeInput($_POST['id_lampiran']);
    $id_kriteria = validateAndSanitizeInput($_POST['id_kriteria']);

    //Buka Data Lampiran
    $lampiran=GetDetailData($Conn, 'uraian', 'id_uraian', $id_uraian, 'lampiran');
    $lampiran_arry=json_decode($lampiran, true);

    // Pastikan jumlah label dan nilai sama
    $data_baru=[];

    //Looping Lampiran
    foreach($lampiran_arry as $lampiran_list){
        if($lampiran_list['id_lampiran']!==$id_lampiran){
            $data_baru[] = [
                "id_lampiran" => $lampiran_list['id_lampiran'],
                "nama" => $lampiran_list['nama'],
                "lampiran_uraian" => $lampiran_list['lampiran_uraian'],
                "type" => $lampiran_list['type'],
                "size_max" => $lampiran_list['size_max']
            ];
        }

    }
    //Buat JSON lampiran baru
    $lampiran_baru=json_encode($data_baru, true);

    //Update Data uraian
    $stmt_update = mysqli_prepare($Conn, "UPDATE uraian SET 
        lampiran=?
    WHERE id_uraian=?");
    mysqli_stmt_bind_param($stmt_update, "ss", 
        $lampiran_baru, 
        $id_uraian
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        //Jika Berhasil Simpan Log
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Uraian','Edit Lampiran');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Lampiran Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    }else{
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database"]);
    }
?>