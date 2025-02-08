<?php
    session_start();
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";

    // Set header agar selalu mengembalikan JSON
    header('Content-Type: application/json');

    // Tambahkan beberapa header keamanan
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    // Tetapkan zona waktu UTC
    date_default_timezone_set('UTC');

    // Timestamp sekarang
    $timestamp_creat = date('Y-m-d H:i:s');

    // Atur waktu berlakunya token 1 jam
    $expired_seconds = 60 * 60;
    $timestamp_expired = date('Y-m-d H:i:s', strtotime($timestamp_creat) + $expired_seconds);

    // Inisialisasi respon default
    $response = [
        'status' => 'error',
        'code' => 201,
        'message' => 'Terjadi kesalahan.'
    ];

    // Bersihkan Data
    $email = isset($_POST["email"]) ? filter_var(validateAndSanitizeInput($_POST["email"]), FILTER_VALIDATE_EMAIL) : null;
    $password = isset($_POST["password"]) ? validateAndSanitizeInput($_POST["password"]) : null;
    $captcha = isset($_POST["captcha"]) ? validateAndSanitizeInput($_POST["captcha"]) : null;

    //Validasi Input Tidak Boleh Kosong
    if (!$email) {
        $response['message'] = 'Email tidak valid atau kosong.';
    } elseif (empty($password)) {
        $response['message'] = 'Password tidak boleh kosong.';
    } elseif (empty($captcha)) {
        $response['message'] = 'Captcha tidak boleh kosong.';
    } else {

        // Validasi Captcha
        $QryCaptcha = $Conn->prepare("SELECT * FROM captcha WHERE unique_code = ? AND timestamp_expired > ?");
        $QryCaptcha->bind_param("ss", $captcha, $timestamp_creat);
        $QryCaptcha->execute();
        $DataCaptcha = $QryCaptcha->get_result()->fetch_assoc();

        if (!$DataCaptcha) {
            $response['message'] = 'Captcha tidak valid.';
        } else {

            // Validasi pengguna Berdasarkan email
            $stmt = $Conn->prepare("SELECT * FROM akses WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $DataAkses = $stmt->get_result()->fetch_assoc();

            //Validasi pengguna berdasarkan password
            if ($DataAkses && password_verify($password, $DataAkses['password'])) {
                $id_akses = $DataAkses["id_akses"];

                // Hapus token lama
                $deleteTokenStmt = $Conn->prepare("DELETE FROM akses_token WHERE id_akses = ?");
                $deleteTokenStmt->bind_param("s", $id_akses);
                $deleteTokenStmt->execute();

                // Buat token baru
                $akses_token = generateRandomString(36);
                $insertTokenStmt = $Conn->prepare("INSERT INTO akses_token (id_akses, akses_token, timestamp_creat, timestamp_expired) VALUES (?, ?, ?, ?)");
                $insertTokenStmt->bind_param("isss", $id_akses, $akses_token, $timestamp_creat, $timestamp_expired);

                if ($insertTokenStmt->execute()) {
                    //Buat Session
                    $_SESSION["token"] = $akses_token;
                    
                    $response['code'] = 200;
                    $response['status'] = 'success';
                    $response['message'] = 'Login berhasil.';

                    //Hapus Captcha Lama
                    $deleteExpiredCaptchas = $Conn->prepare("DELETE FROM captcha WHERE unique_code = ?");
                    $deleteExpiredCaptchas->bind_param("s", $captcha);
                    $deleteExpiredCaptchas->execute();
                } else {
                    $response['message'] = 'Terjadi kesalahan pada saat menyimpan token akses.';
                }
            } else {
                $response['message'] = 'Kombinasi email dan password tidak valid.';
            }
        }
    }

    // Output respon sebagai JSON
    echo json_encode($response);
?>
