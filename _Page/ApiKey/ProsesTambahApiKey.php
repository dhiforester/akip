<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Cek Session Login
    if(empty($SessionIdAkses)){
        echo '<small class="credit text-danger">Sesi Login Sudah Berakhhir, Silahkan Login Ulang Terlebih Dulu</small>';
    }else{
        //Validasi Nama Tidak Boleh Kosong
        if(empty($_POST['nama'])){
            echo '<small class="credit text-danger">Nama tidak boleh kosong</small>';
        }else{
            if(empty($_POST['email'])){
                echo '<small class="credit text-danger">Email tidak boleh kosong</small>';
            }else{
                if(empty($_POST['api_key'])){
                    echo '<small class="credit text-danger">API Key tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['status'])){
                        echo '<small class="credit text-danger">Status tidak boleh kosong</small>';
                    }else{
                        $nama=$_POST['nama'];
                        $email=$_POST['email'];
                        $api_key=$_POST['api_key'];
                        $status=$_POST['status'];
                        //Validasi API key Sama
                        $ValidasiApiKeyDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE api_key='$api_key'"));
                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE email='$email'"));
                        if(!empty($ValidasiApiKeyDuplikat)){
                            echo '<small class="credit text-danger">API Key Yang Anda Gunakan Sudah Ada</small>';
                        }else{
                            if(!empty($ValidasiEmailDuplikat)){
                                echo '<small class="credit text-danger">Email Yang Anda Gunakan Sudah Ada</small>';
                            }else{
                                //Simpan Ke database
                                $entry="INSERT INTO api_key (
                                    nama,
                                    email,
                                    updatetime,
                                    api_key,
                                    status
                                ) VALUES (
                                    '$nama',
                                    '$email',
                                    '$now',
                                    '$api_key',
                                    '$status'
                                )";
                                $Input=mysqli_query($Conn, $entry);
                                if($Input){
                                    $kategori_log="API Key";
                                    $deskripsi_log="Tambah Api Key Berhasil";
                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                    if($InputLog=="Success"){
                                        echo '<small class="credit text-success" id="NotifikasiTambahApiKeyBerhasil">Success</small>';
                                    }else{
                                        echo '<small class="credit text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                    }
                                }else{
                                    echo '<small class="credit text-danger">Terjadi kesalahan pada saat menyimpan data ke database</small>';
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>