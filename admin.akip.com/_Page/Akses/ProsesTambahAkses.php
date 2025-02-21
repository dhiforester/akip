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
        'nama' => "Nama Pengguna Tidak Boleh Kosong!",
        'email' => "Email Pengguna Tidak Boleh Kosong!",
        'kontak' => "Kontak Pengguna Tidak Boleh Kosong!",
        'akses' => "Akses Pengguna Tidak Boleh Kosong!",
        'password1' => "Password Tidak Boleh Kosong!",
        'password2' => "Ulangi Password Tidak Boleh Kosong!",
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $nama = validateAndSanitizeInput($_POST['nama']);
    $email = validateAndSanitizeInput($_POST['email']);
    $kontak = validateAndSanitizeInput($_POST['kontak']);
    $akses = validateAndSanitizeInput($_POST['akses']);
    $password1 = validateAndSanitizeInput($_POST['password1']);
    $password2 = validateAndSanitizeInput($_POST['password2']);

    // Validasi panjang karakter
    $maxLengths = [
        'nama' => 250,
        'email' => 250,
        'kontak' => 20,
        'password1' => 20
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

    //Validasi password sama
    if($password1!==$password2){
        echo json_encode(["status" => "Error", "message" => "Password yang anda masukan tidak sama"]);
        exit;
    }
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

    //Hasing Password
    $password=password_hash($password1, PASSWORD_DEFAULT);

    //Insert data akses
    $query_insert = "INSERT INTO akses (nama, email, kontak, password, akses, foto, timestamp_creat) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $Conn->prepare($query_insert);
    if ($stmt_insert) {
        $stmt_insert->bind_param("sssssss", $nama, $email, $kontak, $password, $akses, $foto, $now);
        if ($stmt_insert->execute()) {
            
            //Buka ID Akses
            $id_akses=GetDetailData($Conn, 'akses', 'email', $email, 'id_akses');
            
            //Jika Berhasil Insert Data Ke tabel lain berdasarkan hak akses
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
                $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Akses','Tambah Akses');
                if($SimpanLog=="Success"){
                    echo json_encode(["status" => "Success", "message" => "Tambah Akses Berhasil!"]);
                    exit;
                }else{
                    echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                    exit;
                }
            }
        } else {
            echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database"]);
            exit;
        }
    } else {
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database"]);
        exit;
    }
?>
