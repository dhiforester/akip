<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
    $id_evaluasi_periode="";
    $id_komponen="";
    $id_komponen_sub="";
    $id_kriteria="";

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
        'nama_lampiran' => "Nama Lampiran Tidak Boleh Kosong!",
        'lampiran_uraian' => "Informasi Lampiran Uraian Tidak Boleh Kosong!",
        'tipe_file' => "Tipe File Tidak Boleh Kosong!",
        'max_file' => "Ukuran Maksimal File Tidak Boleh Kosong!"
    ];
    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_uraian = validateAndSanitizeInput($_POST['id_uraian']);
    $nama_lampiran = validateAndSanitizeInput($_POST['nama_lampiran']);
    $lampiran_uraian = validateAndSanitizeInput($_POST['lampiran_uraian']);
    $tipe_file =$_POST['tipe_file'];
    $max_file = validateAndSanitizeInput($_POST['max_file']);
    
    // Validasi panjang karakter
    $maxLengths = [
        'id_uraian' => 36,
        'nama_lampiran' => 100,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    // List tipe File
    $tipe_file_list="";
    for ($i = 0; $i < count($tipe_file); $i++) {
        $tipe_file_list=$tipe_file;
    }
    //Buat Data Baru
    $id_lampiran=generateRandomString(36);
    //Konveris max file
    $max_file = $max_file * 1024 * 1024; // 2MB dalam byte
    $data_baru = [
        "id_lampiran" => $id_lampiran,
        "nama" => $nama_lampiran,
        "lampiran_uraian" => $lampiran_uraian,
        "type" => $tipe_file_list,
        "size_max" => $max_file
    ];
    
    //Buka Data Lama
    $Qry = $Conn->prepare("SELECT * FROM uraian WHERE id_uraian = ?");
    $Qry->bind_param("s", $id_uraian);
    if (!$Qry->execute()) {
        $error=$Conn->error;
        echo json_encode(["status" => "Error", "message" => $error]);
        exit;
    }else{
        $Result = $Qry->get_result();
        $Data = $Result->fetch_assoc();
        $Qry->close();
        if(empty($Data['id_uraian'])){
            echo json_encode(["status" => "Error", "message" => "Data Tidak Ditemukan"]);
            exit;
        }else{
            //Buka Data
            $lampiran=$Data['lampiran'];

            //Json To Arry
            $lampiran_json=json_decode($lampiran, true);

            //Tempelkan Data Baru Ke Data Lama
            $lampiran_json[] = $data_baru;

            // Encode kembali menjadi JSON
            $json_result = json_encode($lampiran_json, JSON_PRETTY_PRINT);

            //Update Ke Database
            $stmt_update = mysqli_prepare($Conn, "UPDATE uraian SET 
                lampiran=? 
            WHERE id_uraian=?");
            mysqli_stmt_bind_param($stmt_update, "ss", 
                $json_result, 
                $id_uraian
            );
            $update_result = mysqli_stmt_execute($stmt_update);
            if ($update_result) {
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Uraian','Update Lampiran Uraian');
                if($SimpanLog=="Success"){
                    echo json_encode(["status" => "Success", "message" => "Update Lampiran Uraian Berhasil!"]);
                }else{
                    echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                }
            } else {
                echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database $bobot"]);
            }
        }
    }
?>