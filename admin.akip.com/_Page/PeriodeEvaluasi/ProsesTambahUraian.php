<?php
    // Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";

    // Time Zone
    date_default_timezone_set('Asia/Jakarta');

    // Inisialisasi waktu dan respons default
    $now = date('Y-m-d H:i:s');
    $id_evaluasi_periode="";
    $id_komponen="";
    $id_komponen_sub="";
    $id_kriteria="";

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
        'id_kriteria' => "Id Kriteria Tidak Boleh Kosong!",
        'kode' => "Kode Tidak Boleh Kosong!",
        'nama' => "Nama Tidak Boleh Kosong!",
        'tipe' => "Tipe Tidak Boleh Kosong!"
    ];
    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "Error", "message" => $errorMessage]);
            exit;
        }
    }

    // Assign dan sanitasi nilai variabel
    $id_kriteria = validateAndSanitizeInput($_POST['id_kriteria']);
    $kode = validateAndSanitizeInput($_POST['kode']);
    $nama = validateAndSanitizeInput($_POST['nama']);
    $tipe_uraian = validateAndSanitizeInput($_POST['tipe']);
    
    // Validasi panjang karakter
    $maxLengths = [
        'kode' => 20,
        'nama' => 250
    ];

    foreach ($maxLengths as $field => $maxLength) {
        if (strlen($$field) > $maxLength) {
            echo json_encode(["status" => "Error", "message" => ucfirst($field) . " tidak boleh lebih dari $maxLength karakter"]);
            exit;
        }
    }
    
    //Validasi Tidak Boleh Duplikat
    $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_uraian FROM  uraian WHERE kode='$kode'"));
    if(!empty($validasi_duplikat)){
        echo json_encode(["status" => "Error", "message" => "Nama periode yang akan anda masukan sudah ada"]);
        exit;
    }
    //Alternatif Jawaban Tidak Boleh Kosong
    if(empty($_POST['label_alternatif'])){
        echo json_encode(["status" => "Error", "message" => "Label alternatif tidak boleh kosong!"]);
        exit;
    }
    //Alternatif Jawaban Tidak Boleh Kosong
    if(empty($_POST['value_alternatif'])){
        echo json_encode(["status" => "Error", "message" => "Nilai/Isi alternatif tidak boleh kosong!"]);
        exit;
    }
    //Membuat raw alternatif
    $labels = $_POST['label_alternatif']; // Array label
    $values = $_POST['value_alternatif']; // Array nilai

    // Pastikan jumlah label dan nilai sama
    $alternatif=[];

    if (count($labels) === count($values)) {
        $max_value =0;
        // Loop melalui data
        $total_value=0;
        for ($i = 0; $i < count($labels); $i++) {
            $label = $labels[$i]; // Ambil label
            $value = $values[$i];  // Ambil nilai
            $alternatif[]=[
                "label"=>$label,
                "value"=>$value,
            ];
            $total_value=$total_value+$value;
        }
        $max_value = max($values);
    } else {
        echo json_encode(["status" => "Error", "message" => "Jumlah label dan nilai tidak sesuai!"]);
        exit;
    }
    $alternatif_uraian=[
        "type" => $tipe_uraian,
        "alternatif" => $alternatif
    ];
    $alternatif_uraian_json=json_encode($alternatif_uraian, true);
    
    //Buka Data Kriteria
    $Qry = $Conn->prepare("SELECT * FROM kriteria WHERE id_kriteria = ?");
    $Qry->bind_param("s", $id_kriteria);
    if (!$Qry->execute()) {
        $error=$Conn->error;
        echo json_encode(["status" => "Error", "message" => $error]);
        exit;
    }else{
        $Result = $Qry->get_result();
        $Data = $Result->fetch_assoc();
        $Qry->close();
        if(empty($Data['id_kriteria'])){
            echo json_encode(["status" => "Error", "message" => "Data Tidak Ditemukan"]);
            exit;
        }else{
            //Buka Data
            $id_komponen_sub=$Data['id_komponen_sub'];
            $id_komponen=$Data['id_komponen'];
            $id_evaluasi_periode =$Data['id_evaluasi_periode'];

            //Buat id_uraian
            $id_uraian=generateRandomString(36);

            //Lampiran Kosong
            $lampiran=[];
            $lampiran_json=json_encode($lampiran, true);

            //Cari Bobot
            if($tipe_uraian=="select_option"){
                $bobot=$max_value;
            }else{
                $bobot=$total_value;
            }

            //Simpan Data
            $query_insert = "INSERT INTO uraian (
                id_uraian, 
                id_kriteria, 
                id_komponen_sub, 
                id_komponen, 
                id_evaluasi_periode, 
                kode, 
                nama, 
                alternatif, 
                lampiran, 
                bobot
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $Conn->prepare($query_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param("ssssssssss", 
                    $id_uraian,  
                    $id_kriteria,  
                    $id_komponen_sub,  
                    $id_komponen, 
                    $id_evaluasi_periode, 
                    $kode, 
                    $nama, 
                    $alternatif_uraian_json, 
                    $lampiran_json, 
                    $bobot
                );
                if ($stmt_insert->execute()) {

                    //Jika Berhasil Simpan Log
                    $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Uraian','Tambah Uraian');
                    if($SimpanLog=="Success"){
                        echo json_encode(["status" => "Success", "message" => "Tambah Periode Evaluasi Berhasil!"]);
                    }else{
                        echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
                    }
                } else {
                    echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat input ke database $bobot"]);
                }
            } else {
                echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database $bobot"]);
            }
        }
    }
?>