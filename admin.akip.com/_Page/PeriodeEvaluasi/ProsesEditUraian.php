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
        'id_uraian' => "Id Uraian Tidak Boleh Kosong!",
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
    $id_uraian = validateAndSanitizeInput($_POST['id_uraian']);
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
    //Buka Kode Lama
    $kode_lama=GetDetailData($Conn, 'uraian', 'id_uraian', $id_uraian, 'kode');
    //Validasi Kode Tidak Boleh Duplikat
    if($kode_lama==$kode){
        $validasi_duplikat=0;
    }else{
        $validasi_duplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT id_uraian FROM  uraian WHERE kode='$kode'"));
    }
    
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
    //Cari Bobot
    if($tipe_uraian=="select_option"){
        $bobot=$max_value;
    }else{
        $bobot=$total_value;
    }
    //Update Data uraian
    $stmt_update = mysqli_prepare($Conn, "UPDATE uraian SET 
        kode=?, 
        nama=?, 
        alternatif=?, 
        bobot=? 
    WHERE id_uraian=?");
    mysqli_stmt_bind_param($stmt_update, "sssss", 
        $kode, 
        $nama, 
        $alternatif_uraian_json, 
        $bobot, 
        $id_uraian
    );
    $update_result = mysqli_stmt_execute($stmt_update);
    if ($update_result) {
        //Jika Berhasil Simpan Log
        $SimpanLog=addLog($Conn,$SessionIdAkses,$now,'Uraian','Edit Uraian');
        if($SimpanLog=="Success"){
            echo json_encode(["status" => "Success", "message" => "Edit Uraian Berhasil!"]);
        }else{
            echo json_encode(["status" => "Error", "message" => "Terjadi Kesalahan Pada Saat Menyimpan Log"]);
        }
    }else{
        echo json_encode(["status" => "Error", "message" => "Terjadi kesalahan saat mempersiapkan statement database"]);
    }
?>