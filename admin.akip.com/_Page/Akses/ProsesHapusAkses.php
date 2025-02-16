<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');

    //Sessi Akses Tidak Boleh Kosong
    if(empty($SessionIdAkses)){
        echo json_encode(["status" => "Error", "message" => "Sesi Akses Sudah Berakhir! Silahkan Login Ulang!"]);
        exit;
    }
    // Validasi Data Tidak Boleh Kosong
    $requiredFields = [
        'id_akses' => "ID Akses Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_akses = validateAndSanitizeInput($_POST['id_akses']);

    //Buka File Jika Ada
    $foto=GetDetailData($Conn,'akses','id_akses',$id_akses,'foto');
        
    //Proses hapus data
    $HapusAkses = mysqli_query($Conn, "DELETE FROM akses WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
    if ($HapusAkses) {
        if(!empty($foto)){
            $url_foto='../../assets/img/User/'.$foto.'';
            if(file_exists($url_foto)) {
                if (unlink($url_foto)) {
                    $HapusFoto="Berhasil";
                } else {
                    $HapusFoto="Hapus File Foto Profil Gagal";
                }
            }else{
                $HapusFoto="Berhasil";
            }
        }else{
            $HapusFoto="Berhasil";
        }
    }else{
        $HapusFoto="Terjadi Kesalahan Pada Saat Menghapus Akses";
    }
    if($HapusFoto!=="Berhasil"){
        echo json_encode(["status" => "Error", "message" => $HapusFoto]);
        exit;
    }else{
        $kategori_log="Akses";
        $deskripsi_log="Hapus Akses Berhasil";
        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
        if($InputLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Hapus Akses Berhasil"]);
            exit;
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan pada saat menyimpan Log"]);
            exit;
        }
    }
?>