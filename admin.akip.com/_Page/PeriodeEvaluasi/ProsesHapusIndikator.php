<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
    $id_back="";
    $id="";
    $response = [
        "status" => "Error",
        "message" => "Belum ada proses yang dilakukan pada sistem.",
        "id_back" => $id_back
    ];

    if (empty($SessionIdAkses)) {
        $response = [
            "status" => "Error",
            "message" => "Sesi Akses Sudah Berakhir, Silahkan Login Ulang",
            "id_back" => $id_back
        ];
        echo json_encode($response);
        exit;
    }

    // Validasi Data Tidak Boleh Kosong
    $requiredFields = [
        'id' => "ID Data Tidak Boleh Kosong!",
        'level' => "Informasi Level Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            $response = [
                "status" => "Error",
                "message" => $errorMessage,
                "id_back" => $id_back
            ];
            echo json_encode($response);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id = validateAndSanitizeInput($_POST['id']);
    $level = validateAndSanitizeInput($_POST['level']);
    
    //Validasi Proses
    $validasi_input="Belum ADa Proses";
    if($level=="Komponen"){
        //Buka id periode
        $id_back=GetDetailData($Conn, 'komponen', 'id_komponen', $id, 'id_evaluasi_periode');
        $hapus = mysqli_query($Conn, "DELETE FROM komponen WHERE id_komponen='$id'") or die(mysqli_error($Conn));
        if ($hapus) {
            //Jika Berhasil Simpan Log
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komponen','Hapus Komponen');
            if($SimpanLog=="Success"){
                $validasi_input="Berhasil";
            }else{
                $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
            }
        } else {
            $validasi_input="Terjadi kesalahan saat hapus data dari database";
        }
    }else{
        if($level=="Sub Komponen"){
            //Buka id periode
            $id_evaluasi_periode=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id, 'id_evaluasi_periode');
            $id_komponen=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id, 'id_komponen');
            $id_back=[
                "id_evaluasi_periode" => $id_evaluasi_periode,
                "id_komponen" => $id_komponen,
            ];
            $hapus = mysqli_query($Conn, "DELETE FROM komponen_sub WHERE id_komponen_sub='$id'") or die(mysqli_error($Conn));
            if ($hapus) {
                //Jika Berhasil Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Sub Komponen','Hapus Sub Komponen');
                if($SimpanLog=="Success"){
                    $validasi_input="Berhasil";
                }else{
                    $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                }
            } else {
                $validasi_input="Terjadi kesalahan saat hapus data dari database";
            }
        }else{
            if($level=="Kriteria"){
                //Buka id periode
                $id_komponen_sub=GetDetailData($Conn, 'kriteria', 'id_Kriteria', $id, 'id_komponen_sub');
                $id_back=[
                    "id_komponen_sub" => $id_komponen_sub
                ];
                $hapus = mysqli_query($Conn, "DELETE FROM kriteria WHERE id_Kriteria='$id'") or die(mysqli_error($Conn));
                if ($hapus) {
                    //Jika Berhasil Simpan Log
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kriteria','Hapus Kriteria');
                    if($SimpanLog=="Success"){
                        $validasi_input="Berhasil";
                    }else{
                        $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                    }
                } else {
                    $validasi_input="Terjadi kesalahan saat hapus data dari database";
                }
            }else{
        
            }
        }
    }

    if($validasi_input!=="Berhasil"){
        $response = [
            "status" => "Error",
            "message" => $validasi_input,
            "id_back" => $id_back
        ];
        echo json_encode($response);
        exit;
    }else{
        $response = [
            "status" => "Success",
            "message" => $validasi_input,
            "id_back" => $id_back
        ];
        echo json_encode($response);
        exit;
    }
?>
