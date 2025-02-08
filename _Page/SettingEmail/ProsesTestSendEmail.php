<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingEmail.php";
    //Tangkap Data
    if(empty($_POST['nama_tujuan'])){
        echo '<code class="credit text-danger">Nama Pengirim Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['email_tujuan'])){
            echo '<code class="credit text-danger">Email Pengirim Tidak Boleh Kosong!</code>';
        }else{
            if(empty($_POST['subjek'])){
                echo '<code class="credit text-danger">Subject Pesan Tidak Boleh Kosong!</code>';
            }else{
                if(empty($_POST['pesan'])){
                    echo '<code class="credit text-danger">Isi Pesan Tidak Boleh Kosong!</code>';
                }else{
                    $nama_tujuan=$_POST['nama_tujuan'];
                    $email_tujuan=$_POST['email_tujuan'];
                    $subjek=$_POST['subjek'];
                    $pesan=$_POST['pesan'];
                    //Kirim email
                    $ch = curl_init();
                    $headers = array(
                        'Content-Type: Application/JSON',          
                        'Accept: Application/JSON'     
                    );
                    $arr = array(
                        "subjek" => "$subjek",
                        "email_asal" => "$email_gateway",
                        "password_email_asal" => "$password_gateway",
                        "url_provider" => "$url_provider",
                        "nama_pengirim" => "$nama_pengirim",
                        "email_tujuan" => "$email_tujuan",
                        "nama_tujuan" => "$nama_tujuan",
                        "pesan" => "$pesan",
                        "port" => "$port_gateway"
                    );
                    $json = json_encode($arr);
                    curl_setopt($ch, CURLOPT_URL, "$url_service");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 3); 
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $content = curl_exec($ch);
                    $err = curl_error($ch);
                    if(empty($content)){
                        echo '<code class="credit text-danger">Tidak ada response dari email gateway!</code>';
                    }else{
                        curl_close($ch);
                        $get =json_decode($content, true);
                        if($get['code']==200){
                            $_SESSION ["NotifikasiSwal"]="Kirim Email Berhasil";
                            echo '<span class="text-success" id="NotifikasiTestSendEmailBerhasil">Success</span>';
                        }else{
                            if($get['pesan']=="Email Terkirim"){
                                $_SESSION ["NotifikasiSwal"]="Kirim Email Berhasil";
                                echo '<span class="text-success" id="NotifikasiTestSendEmailBerhasil">Success</span>';
                            }else{
                                $_SESSION ["NotifikasiSwal"]="Kirim Email Berhasil";
                                echo '<span class="text-success" id="NotifikasiTestSendEmailBerhasil">Success</span>';
                            }
                        }
                    }
                    
                }
            }
        }
    }
?>