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
        'level' => "Informasi Level Tidak Boleh Kosong!",
        'kode' => "Kode Tidak Boleh Kosong!",
        'nama' => "Nama Tidak Boleh Kosong!",
        'keterangan' => "Keterangan Tidak Boleh Kosong!"
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
    $kode = validateAndSanitizeInput($_POST['kode']);
    $nama = validateAndSanitizeInput($_POST['nama']);
    $keterangan = validateAndSanitizeInput($_POST['keterangan']);

    // Validasi panjang karakter
    $maxLengths = [
        'kode' => 20,
        'nama' => 250,
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            $response = [
                "status" => "Error",
                "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter",
                "id_back" => $id_back
            ];
            echo json_encode($response);
            exit;
        }
    }
    
    //Validasi Proses
    $validasi_input="Belum ADa Proses";
    if($level=="Komponen"){
        // Update Komponen
        $stmt_update = mysqli_prepare($Conn, "UPDATE komponen SET 
            kode=?, 
            nama=?, 
            keterangan=? 
        WHERE id_komponen=?");
        mysqli_stmt_bind_param($stmt_update, "ssss", 
            $kode, 
            $nama, 
            $keterangan, 
            $id
        );
        $update_result = mysqli_stmt_execute($stmt_update);
        if ($update_result) {
            //Buka id periode
            $id_back=GetDetailData($Conn, 'komponen', 'id_komponen', $id, 'id_evaluasi_periode');
            //Jika Berhasil Simpan Log
            $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Komponen','Edit Komponen');
            if($SimpanLog=="Success"){
                $validasi_input="Berhasil";
            }else{
                $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
            }
        } else {
            $validasi_input="Terjadi kesalahan saat Update ke database";
        }
    }else{
        if($level=="Sub Komponen"){
            // Update Komponen
            $stmt_update = mysqli_prepare($Conn, "UPDATE komponen_sub SET 
                kode=?, 
                nama=?, 
                keterangan=? 
            WHERE id_komponen_sub=?");
            mysqli_stmt_bind_param($stmt_update, "ssss", 
                $kode, 
                $nama, 
                $keterangan, 
                $id
            );
            $update_result = mysqli_stmt_execute($stmt_update);
            if ($update_result) {
                //Buka id periode
                $id_evaluasi_periode=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id, 'id_evaluasi_periode');
                $id_komponen=GetDetailData($Conn, 'komponen_sub', 'id_komponen_sub', $id, 'id_komponen');
                $id_back=[
                    "id_evaluasi_periode" => $id_evaluasi_periode,
                    "id_komponen" => $id_komponen,
                ];
                //Jika Berhasil Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Sub Komponen','Edit Sub Komponen');
                if($SimpanLog=="Success"){
                    $validasi_input="Berhasil";
                }else{
                    $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                }
            } else {
                $validasi_input="Terjadi kesalahan saat Update ke database";
            }
        }else{
            if($level=="Kriteria"){
                // Update Kriteria
                $stmt_update = mysqli_prepare($Conn, "UPDATE kriteria SET 
                    kode=?, 
                    nama=?, 
                    keterangan=? 
                WHERE id_kriteria=?");
                mysqli_stmt_bind_param($stmt_update, "ssss", 
                    $kode, 
                    $nama, 
                    $keterangan, 
                    $id
                );
                $update_result = mysqli_stmt_execute($stmt_update);
                if ($update_result) {
                    //Buka id periode
                    $id_komponen_sub=GetDetailData($Conn, 'kriteria', 'id_kriteria', $id, 'id_komponen_sub');
                    $id_back=[
                        "id_komponen_sub" => $id_komponen_sub
                    ];
                    //Jika Berhasil Simpan Log
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Kriteria','Edit Kriteria');
                    if($SimpanLog=="Success"){
                        $validasi_input="Berhasil";
                    }else{
                        $validasi_input="Terjadi Kesalahan Pada Saat Menyimpan Log";
                    }
                } else {
                    $validasi_input="Terjadi kesalahan saat Update ke database";
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
        exit;
    }
?>
