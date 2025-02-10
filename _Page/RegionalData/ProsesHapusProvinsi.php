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

        //Id provinsi Tidak Boleh Kosong
        if(empty($_POST['id_provinsi'])){
            $response = [
                "status" => "Error",
                "message" => "ID Provinsi Tidak Boleh Kosong!"
            ];
        }else{

            //Buka Data
            $id_provinsi = validateAndSanitizeInput($_POST['id_provinsi']);

            //Hapus Data
            $hapus = mysqli_query($Conn, "DELETE FROM wilayah_provinsi WHERE id_provinsi='$id_provinsi'") or die(mysqli_error($Conn));
            if ($hapus) {
                
                //Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Wilayah Provinsi','Hapus Provinsi');
                if($SimpanLog=="Success"){
                    $response = [
                        "status" => "Success",
                        "message" => "Hapus Provinsi Berhasil!"
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