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
        if(empty($_POST['id_akses'])){
            $response = [
                "status" => "Error",
                "message" => "ID Akses Tidak Boleh Kosong!"
            ];
        }else{
            $id_akses = validateAndSanitizeInput($_POST['id_akses']);
            $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses = ?");
            $Qry->bind_param("s", $id_akses);
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
                if(empty($Data['id_akses'])){
                    $response = [
                        "status" => "Error",
                        "message" => "Data Akses Yang Anda Pilih ($id_akses) Tidak Ditemukan"
                    ];
                }else{
                    //Buka Data
                    $id_opd=$Data['id_opd'];
                    $id_provinsi=$Data['id_provinsi'];
                    $id_kabkot=$Data['id_kabkot'];
                    $nama=$Data['nama'];
                    $email=$Data['email'];
                    $kontak=$Data['kontak'];
                    $akses=$Data['akses'];
                    $foto=$Data['foto'];
                    $timestamp_creat=$Data['timestamp_creat'];
                    if(empty($foto)){
                        $url_foto='assets/img/User/No-Image.png';
                    }else{
                        $url_foto='assets/img/User/'.$foto.'';
                    }
                    $data_detail=[
                        "id_opd" => $id_opd,
                        "id_provinsi" => $id_provinsi,
                        "id_kabkot" => $id_kabkot,
                        "nama" => $nama,
                        "email" => $email,
                        "kontak" => $kontak,
                        "akses" => $akses,
                        "foto" => $foto,
                        "timestamp_creat" => $timestamp_creat,
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
