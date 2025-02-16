<?php
    //Session Starat
    session_start();

    //Set Datetime UTC
    date_default_timezone_set('UTC');
    $timestamp_now = date('Y-m-d H:i:s');

    //Jika Session Kosong
    if(empty($_SESSION["token"])){
        $SessionIdAkses="";
    }else{

        //Variabel token
        $token=$_SESSION ["token"];

        //Validasi Token
        $QryToken = $Conn->prepare("SELECT * FROM akses_token WHERE akses_token = ? AND timestamp_expired > ?");
        $QryToken->bind_param("ss", $token, $timestamp_now);
        $QryToken->execute();
        $DataToken = $QryToken->get_result()->fetch_assoc();

        //Apabila Token Tidak Ada
        if (!$DataToken) {
            $SessionIdAkses="";
        }else{
            //Buat Variabel
            $id_akses=$DataToken['id_akses'];
            
            //Inisiasi data akses dari database
            $QryAkses = $Conn->prepare("SELECT * FROM akses WHERE id_akses = ?");
            $QryAkses->bind_param("i", $id_akses);
            $QryAkses->execute();
            $DataAkses = $QryAkses->get_result()->fetch_assoc();
            
            //Apabila data akses Tidak Ada
            if (!$DataAkses) {
                $SessionIdAkses="";
            }else{
                $SessionIdAkses=$DataAkses['id_akses'];
                //Perpanjang Token
                $expired_seconds = 60 * 60;
                $timestamp_expired = date('Y-m-d H:i:s', strtotime($timestamp_now) + $expired_seconds);

                //Update Token
                $stmt = mysqli_prepare($Conn, "UPDATE akses_token SET timestamp_expired=? WHERE akses_token=?");
                mysqli_stmt_bind_param($stmt, "ss", $timestamp_expired, $token);
                $update_result = mysqli_stmt_execute($stmt);
                if($update_result){
                    //Apabila Proses Perpanjang Berhasil
                    $SessionNama=$DataAkses['nama'];
                    $SessionEmail=$DataAkses['email'];
                    $SessionKontak=$DataAkses['kontak'];
                    $SessionAkses=$DataAkses['akses'];
                    if(empty($DataAkses['foto'])){
                        $SessionGambar="No-Image.png";
                    }else{
                        $SessionGambar=$DataAkses['foto'];
                    }
                    $SessionAksesCreat=$DataAkses['timestamp_creat'];
                    $session_timestamp_expired=$timestamp_expired;
                }else{
                    $SessionIdAkses="";
                }
            }
        }
    }
?>
