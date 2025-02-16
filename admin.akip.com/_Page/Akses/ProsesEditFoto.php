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
        echo json_encode($response);
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

    if(empty($_FILES['foto']['name'])){
        echo json_encode(["status" => "Error", "message" => "Foto Tidak Boleh Kosong"]);
        exit;
    }else{
        //nama gambar
        $nama_gambar=$_FILES['foto']['name'];
        //ukuran gambar
        $ukuran_gambar = $_FILES['foto']['size']; 
        //tipe
        $tipe_gambar = $_FILES['foto']['type']; 
        //sumber gambar
        $tmp_gambar = $_FILES['foto']['tmp_name'];
        

        $imageFile = $_FILES['foto'];
        //Validasi File
        $validationResult = validateUploadedFile($imageFile,2);
        if ($validationResult === true) {
            //Apabila Valid Lakukan Upload
            if($tipe_gambar== "image/jpeg"){
                $Ext="jpeg";
            }
            if($tipe_gambar== "image/jpg"){
                $Ext="jpg";
            }
            if($tipe_gambar== "image/gif"){
                $Ext="gif";
            }
            if($tipe_gambar== "image/png"){
                $Ext="png";
            }
            $file_name_new=generateRandomString(35);
            $foto="$file_name_new.$Ext";
            $path = "../../assets/img/User/".$foto;
            if(move_uploaded_file($tmp_gambar, $path)){
                //File lama
                $foto_lama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'foto');
                if(!empty($foto_lama)){
                    $path_file_lama = "../../assets/img/User/".$foto_lama;
                    //Hapus File Jika Ada
                    if (file_exists($path_file_lama)) {
                        if (unlink($path_file_lama)) {
                            $ValidasiGambar="Valid";
                        }else{
                            $ValidasiGambar="Valid";
                        }
                    }else{
                        $ValidasiGambar="Valid";
                    }
                }else{
                    $ValidasiGambar="Valid";
                }
            }else{
                $ValidasiGambar="Upload file gambar gagal";
            }
        }else{
            $ValidasiGambar=$validationResult;
        }
        if($ValidasiGambar!=="Valid"){
            echo json_encode(["status" => "Error", "message" => $ValidasiGambar]);
            exit;
        }else{
            // Update Data
            $stmt_update = mysqli_prepare($Conn, "UPDATE akses SET 
                foto=?
            WHERE id_akses=?");
            mysqli_stmt_bind_param($stmt_update, "si", 
                $foto,
                $id_akses
            );
            $update_result = mysqli_stmt_execute($stmt_update);
            if ($update_result) {
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Edit Foto');
                if($SimpanLog=="Success"){
                    echo json_encode(["status" => "Success", "message" => "Edit Foto Berhasil!"]);
                }else{
                    echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                }
            } else {
                echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat update data ke database"]);
            }
        }
    }
?>
