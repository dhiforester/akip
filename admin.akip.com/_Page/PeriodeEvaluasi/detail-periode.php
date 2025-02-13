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
    }else{
        if(empty($_POST['id_evaluasi_periode'])){
            $response = [
                "status" => "Error",
                "message" => "ID Evaluasi Periode Tidak Boleh Kosong!"
            ];
        }else{
            $id_evaluasi_periode = validateAndSanitizeInput($_POST['id_evaluasi_periode']);
            $Qry = $Conn->prepare("SELECT * FROM evaluasi_periode WHERE id_evaluasi_periode = ?");
            $Qry->bind_param("s", $id_evaluasi_periode);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                $response = [
                    "status" => "Error",
                    "message" => $error
                ];
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_evaluasi_periode'])){
                    $response = [
                        "status" => "Error",
                        "message" => "Data Yang Anda Pilih ($id_evaluasi_periode) Tidak Ditemukan"
                    ];
                }else{
                    //Buka Data
                    $id_evaluasi_periode=$Data['id_evaluasi_periode'];
                    $periode=$Data['periode'];
                    $date_mulai=$Data['date_mulai'];
                    $date_selesai=$Data['date_selesai'];
                    $data_detail=[
                        "id_evaluasi_periode" => $id_evaluasi_periode,
                        "periode" => $periode,
                        "date_mulai" => $date_mulai,
                        "date_selesai" => $date_selesai
                    ];
                    $response = [
                        "status" => "Success",
                        "message" => "Data Ditemukan",
                        "data_detail" => $data_detail
                    ];
                }
            }
        }
    }
    echo json_encode($response);
?>
