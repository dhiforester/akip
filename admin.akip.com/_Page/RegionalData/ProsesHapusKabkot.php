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

        //Id Kabkot Tidak Boleh Kosong
        if(empty($_POST['id_kabkot'])){
            $response = [
                "status" => "Error",
                "message" => "ID Kabupaten/Kota Tidak Boleh Kosong!"
            ];
        }else{

            //Buka Data kabkot
            $id_kabkot = validateAndSanitizeInput($_POST['id_kabkot']);

            //Hapus Data
            $hapus = mysqli_query($Conn, "DELETE FROM wilayah_kabkot WHERE id_kabkot='$id_kabkot'") or die(mysqli_error($Conn));
            if ($hapus) {
                
                //Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Kabupaten/Kota','Hapus Kabupaten/Kota');
                if($SimpanLog=="Success"){
                    $response = [
                        "status" => "Success",
                        "message" => "Hapus Kabupaten/Kota Berhasil!"
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