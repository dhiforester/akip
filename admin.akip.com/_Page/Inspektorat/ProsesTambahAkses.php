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
        'id_inspektorat' => "ID Inspektorat Tidak Boleh Kosong!",
        'nama' => "Nama Pengguna Tidak Boleh Kosong!",
        'email' => "Email Pengguna Tidak Boleh Kosong!",
        'kontak' => "Kontak Pengguna Tidak Boleh Kosong!",
        'password' => "Password Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_inspektorat = validateAndSanitizeInput($_POST['id_inspektorat']);
    $nama = validateAndSanitizeInput($_POST['nama']);
    $email = validateAndSanitizeInput($_POST['email']);
    $kontak = validateAndSanitizeInput($_POST['kontak']);
    $password = validateAndSanitizeInput($_POST['password']);

    // Validasi panjang karakter
    $maxLengths = [
        'id_inspektorat' => 36,
        'nama' => 250,
        'email' => 250,
        'kontak' => 20,
        'password' => 20
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }

    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat_email=mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses WHERE email='$email'"));
    $validasi_duplikat_kontak=mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses WHERE kontak='$kontak'"));
    if(!empty($validasi_duplikat_email)){
        echo json_encode(["status" => "Error", "message" => "Email yang akan anda masukan sudah terdaftar"]);
        exit;
    }
    if(!empty($validasi_duplikat_kontak)){
        echo json_encode(["status" => "Error", "message" => "Kontak yang akan anda masukan sudah terdaftar"]);
        exit;
    }
    //Validasi Kontak hanya angka
    if (!preg_match('/^\d+$/', $kontak)) {
        echo json_encode(["status" => "Error", "message" => "Nomor Kontak hanya boleh angka"]);
        exit;
    }

    //Buka id_provinsi dan id_kabkot berdasarkan id_inspektorat
    $id_provinsi=GetDetailData($Conn, 'inspektorat', 'id_inspektorat', $id_inspektorat, 'id_provinsi');
    $id_kabkot=GetDetailData($Conn, 'inspektorat', 'id_inspektorat', $id_inspektorat, 'id_kabkot');

    //Apabila Ada File
    if(!empty($_FILES['foto']['name'])){
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
                $ValidasiGambar="Valid";
            }else{
                $ValidasiGambar="Upload file gambar gagal";
            }
        }else{
            $ValidasiGambar=$validationResult;
        }
    }else{
        $ValidasiGambar="Valid";
        $foto="";
    }
    if($ValidasiGambar!=="Valid"){
        echo json_encode(["status" => "Error", "message" => $ValidasiGambar]);
        exit;
    }

    //Nama Akses
    $akses="Inspektorat";

    //Hasing Password
    $password=password_hash($password, PASSWORD_DEFAULT);

    //Insert data akses
    $query_insert = "INSERT INTO akses (nama, email, kontak, password, akses, foto, timestamp_creat) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);
    if ($stmt_insert) {
        $stmt_insert->bind_param("sssssss", $nama, $email, $kontak, $password, $akses, $foto, $now);
        if ($stmt_insert->execute()) {
            $id_akses=GetDetailData($Conn, 'akses', 'email', $email, 'id_akses');
            //Jika Berhasil Insert Data Ke akses_inspektorat
            $query_inspektorat = "INSERT INTO akses_inspektorat (id_akses, id_inspektorat) VALUES (?, ?)";
            $stmt_inspektorat = $Conn->prepare($query_inspektorat);
            if ($stmt_inspektorat) {
                $stmt_inspektorat->bind_param("is", $id_akses, $id_inspektorat);
                if ($stmt_inspektorat->execute()) {
                    //Simpan Log
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Tambah Akses');
                    if($SimpanLog=="Success"){
                        echo json_encode(["status" => "Success", "message" => "Tambah Akses Berhasil!"]);
                    }else{
                        echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                    }
                }else{
                    echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database akses_inspektorat"]);
                }
            }else{
                echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database akses_inspektorat"]);
            }
        } else {
            echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database"]);
    }
?>
