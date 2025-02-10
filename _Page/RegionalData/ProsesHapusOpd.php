<?php
    // Koneksi dan konfigurasi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
    // Inisialisasi respons default
    $response = [
        "status" => "Error",
        "message" => "Terjadi kesalahan. Silakan coba lagi."
    ];

    // Validasi sesi
    if (empty($SessionIdAkses)) {
        $response = [
            "status" => "Error",
            "message" => "Sesi Akses Sudah Berakhir. Silahkan Login Ulang!"
        ];
    }else{

        //Id OPD Tidak Boleh Kosong
        if(empty($_POST['id_opd'])){
            $response = [
                "status" => "Error",
                "message" => "ID OPD Tidak Boleh Kosong!"
            ];
        }else{

            //Buka Data
            $id_opd = validateAndSanitizeInput($_POST['id_opd']);

            //Hapus Data
            $hapus = mysqli_query($Conn, "DELETE FROM opd WHERE id_opd='$id_opd'") or die(mysqli_error($Conn));
            if ($hapus) {
                
                //Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'OPD','Hapus OPD');
                if($SimpanLog=="Success"){
                    $response = [
                        "status" => "Success",
                        "message" => "Hapus OPD Berhasil!"
                    ];
                }else{
                    $response = [
                        "status" => "Success",
                        "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log!"
                    ];
                }
            }else{

                //Apabila Hapus Data Gagal
                $response = [
                    "status" => "Error",
                    "message" => "Terjadi kesalahan pada saat menghapus data!"
                ];
            }
        }
    }

    echo json_encode($response);
?>