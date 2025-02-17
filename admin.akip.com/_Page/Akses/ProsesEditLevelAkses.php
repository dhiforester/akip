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
        'id_akses' => "ID Akses Tidak Boleh Kosong!",
        'akses' => "Level Akses Pengguna Tidak Boleh Kosong!"
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_akses = validateAndSanitizeInput($_POST['id_akses']);
    $akses = validateAndSanitizeInput($_POST['akses']);

    //Validasi Kelengkapan data berdasarkan akses
    $provinsi="";
    $kabupaten="";
    $opd="";
    $inspektorat="";
    if($akses=="OPD"){
        if(empty($_POST['provinsi'])){
            $ValidasiKelengkapanAkses="Untuk Level Akses OPD, ID Provinsi Tidak Boleh Kosong";
        }else{
            if(empty($_POST['kabupaten'])){
                $ValidasiKelengkapanAkses="Untuk Level Akses OPD, ID Kabupaten Tidak Boleh Kosong";
            }else{
                if(empty($_POST['opd'])){
                    $ValidasiKelengkapanAkses="Untuk Level Akses OPD, ID OPD Tidak Boleh Kosong";
                }else{
                    $provinsi=$_POST['provinsi'];
                    $kabupaten=$_POST['kabupaten'];
                    $opd=$_POST['opd'];
                    $ValidasiKelengkapanAkses="Valid";
                }
            }
        }
    }else{
        if($akses=="Inspektorat"){
            if(empty($_POST['provinsi'])){
                $ValidasiKelengkapanAkses="Untuk Level Akses Inspektorat, ID Provinsi Tidak Boleh Kosong";
            }else{
                if(empty($_POST['kabupaten'])){
                    $ValidasiKelengkapanAkses="Untuk Level Akses Inspektorat, ID Kabupaten Tidak Boleh Kosong";
                }else{
                    if(empty($_POST['inspektorat'])){
                        $ValidasiKelengkapanAkses="Untuk Level Akses Inspektorat, ID Inspektorat Tidak Boleh Kosong";
                    }else{
                        $provinsi=$_POST['provinsi'];
                        $kabupaten=$_POST['kabupaten'];
                        $inspektorat=$_POST['inspektorat'];
                        $ValidasiKelengkapanAkses="Valid";
                    }
                }
            }
        }else{
            if($akses=="Provinsi"){
                if(empty($_POST['provinsi'])){
                    $ValidasiKelengkapanAkses="Untuk Level Akses Provinsi, ID Provinsi Tidak Boleh Kosong";
                }else{
                    $provinsi=$_POST['provinsi'];
                    $ValidasiKelengkapanAkses="Valid";
                }
            }else{
                if($akses=="Kabupaten"){
                    if(empty($_POST['provinsi'])){
                        $ValidasiKelengkapanAkses="Untuk Level Akses Kabupaten/Kota, ID Provinsi Tidak Boleh Kosong";
                    }else{
                        if(empty($_POST['kabupaten'])){
                            $ValidasiKelengkapanAkses="Untuk Level Akses Kabupaten/Kota, ID Kabupaten/Kota Tidak Boleh Kosong";
                        }else{
                            $provinsi=$_POST['provinsi'];
                            $kabupaten=$_POST['kabupaten'];
                            $ValidasiKelengkapanAkses="Valid";
                        }
                    }
                }else{
                    $ValidasiKelengkapanAkses="Valid";
                }
            }
        }
    }
    if($ValidasiKelengkapanAkses!=="Valid"){
        echo json_encode(["status" => "Error", "message" => $ValidasiKelengkapanAkses]);
        exit;
    }
    //Buka Level Akses Lama
    $akses_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'akses');
    //Update Akses
    $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
        akses=?
    WHERE id_akses=?");
    mysqli_stmt_bind_param($stmt_update, "si", 
        $akses,
        $id_akses
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {

        //Hapus Relasi Tabel Akses Lama
        if($akses_lama=="Inspektorat"){
            $HapusAkses = mysqli_query($Conn, "DELETE FROM akses_inspektorat WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
            if ($HapusAkses) {
                $validasi_hapus="Berhasil";
            }else{
                $validasi_hapus="Gagal Menghapus Akses Inspektorat Lama";
            }
        }else{
            if($akses_lama=="OPD"){
                $HapusAkses = mysqli_query($Conn, "DELETE FROM akses_opd WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                if ($HapusAkses) {
                    $validasi_hapus="Berhasil";
                }else{
                    $validasi_hapus="Gagal Menghapus Akses OPD Lama";
                }
            }else{
                if($akses_lama=="Provinsi"){
                    $HapusAkses = mysqli_query($Conn, "DELETE FROM akses_provinsi WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                    if ($HapusAkses) {
                        $validasi_hapus="Berhasil";
                    }else{
                        $validasi_hapus="Gagal Menghapus Akses Provinsi Lama";
                    }
                }else{
                    if($akses_lama=="Kabupaten"){
                        $HapusAkses = mysqli_query($Conn, "DELETE FROM akses_kabupaten WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                        if ($HapusAkses) {
                            $validasi_hapus="Berhasil";
                        }else{
                            $validasi_hapus="Gagal Menghapus Akses Kabupaten Lama";
                        }
                    }else{
                        $validasi_hapus="Berhasil";
                    }
                }
            }
        }
        if($validasi_hapus!=="Berhasil"){
            echo json_encode(["status" => "Error", "message" => $validasi_hapus]);
            exit;
        }else{
            //Jika Berhasil Insert Data Ke tabel lain berdasarkan hak akses baru
            if($akses=="Inspektorat"){
                $query_inspektorat = "INSERT INTO akses_inspektorat (id_akses, id_inspektorat) VALUES (?, ?)";
                $stmt_inspektorat = $Conn->prepare($query_inspektorat);
                if ($stmt_inspektorat) {
                    $stmt_inspektorat->bind_param("is", $id_akses, $inspektorat);
                    if ($stmt_inspektorat->execute()) {
                        $validasi_insert_lainnya="Success";
                    }else{
                        $validasi_insert_lainnya="Terjadi kesalahan saat input ke database akses inspektorat";
                    }
                }else{
                    $validasi_insert_lainnya="Terjadi kesalahan saat mempersiapkan statement database akses inspektorat";
                }
            }else{
                if($akses=="OPD"){
                    $QryOpd = "INSERT INTO akses_opd (id_akses, id_opd) VALUES (?, ?)";
                    $stmt_opd = $Conn->prepare($QryOpd);
                    if ($stmt_opd) {
                        $stmt_opd->bind_param("is", $id_akses, $opd);
                        if ($stmt_opd->execute()) {
                            $validasi_insert_lainnya="Success";
                        }else{
                            $validasi_insert_lainnya="Terjadi kesalahan saat input ke database akses OPD";
                        }
                    }else{
                        $validasi_insert_lainnya="Terjadi kesalahan saat mempersiapkan statement database akses OPD";
                    }
                }else{
                    if($akses=="Provinsi"){
                        $QryProvinsi = "INSERT INTO akses_provinsi (id_akses, id_provinsi) VALUES (?, ?)";
                        $stmt_provinsi = $Conn->prepare($QryProvinsi);
                        if ($stmt_provinsi) {
                            $stmt_provinsi->bind_param("is", $id_akses, $provinsi);
                            if ($stmt_provinsi->execute()) {
                                $validasi_insert_lainnya="Success";
                            }else{
                                $validasi_insert_lainnya="Terjadi kesalahan saat input ke database akses OPD";
                            }
                        }else{
                            $validasi_insert_lainnya="Terjadi kesalahan saat mempersiapkan statement database akses OPD";
                        }
                    }else{
                        if($akses=="Kabupaten"){
                            $QryKabupaten = "INSERT INTO akses_kabupaten (id_akses, id_provinsi, id_kabkot) VALUES (?, ?, ?)";
                            $stmt_kabupaten = $Conn->prepare($QryKabupaten);
                            if ($stmt_kabupaten) {
                                $stmt_kabupaten->bind_param("iss", $id_akses, $provinsi, $kabupaten);
                                if ($stmt_kabupaten->execute()) {
                                    $validasi_insert_lainnya="Success";
                                }else{
                                    $validasi_insert_lainnya="Terjadi kesalahan saat input ke database akses OPD";
                                }
                            }else{
                                $validasi_insert_lainnya="Terjadi kesalahan saat mempersiapkan statement database akses OPD";
                            }
                        }else{
                            $validasi_insert_lainnya="Success";
                        }
                    }
                }
            }
            if($validasi_insert_lainnya!=="Success"){
                echo json_encode(["status" => "Error", "message" => $validasi_insert_lainnya]);
                exit;
            }else{
                //Simpan Log
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Edit Akses');
                if($SimpanLog=="Success"){
                    echo json_encode(["status" => "Success", "message" => "Edit Akses Berhasil!"]);
                    exit;
                }else{
                    echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                    exit;
                }
            }
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
    }
?>