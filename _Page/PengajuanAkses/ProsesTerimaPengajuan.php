<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    $kategori_log="Akses";
    $deskripsi_log="Penerimaan Pengajuan Akses Berhasil";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<code class="text-danger">ID Pengajuan Akses tidak boleh kosong</code>';
    }else{
        if(empty($_POST['password'])){
            echo '<code class="text-danger">Password Akses tidak boleh kosong</code>';
        }else{
            $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
            $password=$_POST['password'];
            if(empty($_POST['kirim_email'])){
                $kirim_email="";
            }else{
                $kirim_email=$_POST['kirim_email'];
            }
            $id_wilayah=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'id_wilayah');
            $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
            $kontak=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'kontak');
            $id_akses_entitas=getDataDetail($Conn,'akses_entitas','akses','Desa','id_akses_entitas');
            //Cek Apakah Email Yang Digunakan Sudah Terdaftar?
            $id_akses=getDataDetail($Conn,'akses','email',$kirim_email,'id_akses');
            if(!empty($id_akses)){
                echo '<code class="text-danger">Email pengguna ini sudah digunakan</code>';
            }else{
                //Update Pada Database
                $UpdateAkses = mysqli_query($Conn,"UPDATE akses_pengajuan SET 
                    status='Diterima'
                WHERE id_akses_pengajuan='$id_akses_pengajuan'") or die(mysqli_error($Conn)); 
                if($UpdateAkses){
                    $password_md5=MD5($password);
                    //Tambahkan Ke Data Akses
                    $entry="INSERT INTO akses (
                        id_wilayah,
                        id_akses_entitas,
                        nama,
                        kontak,
                        email,
                        password,
                        akses,
                        foto,
                        updatetime
                    ) VALUES (
                        '$id_wilayah',
                        '$id_akses_entitas',
                        '$nama',
                        '$kontak',
                        '$kirim_email',
                        '$password_md5',
                        'Desa',
                        '',
                        '$now'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                    if($Input){
                        if(!empty($kirim_email)){
                            $kirim_email=$_POST['kirim_email'];
                            $subjek="Pengajuan Akses Diterima";
                            $pesan="Selamat, pengajuan akses ke aplikasi SAKIP sudah diterima. Berikut ini adalah informasi akses anda<br> Email : $kirim_email <br> Password: $password";
                            //Kirim Pesan Email
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
                                "email_tujuan" => "$kirim_email",
                                "nama_tujuan" => "$nama",
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
                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                    if($InputLog=="Success"){
                                        echo '<code class="text-success" id="NotifikasiTolakPengajuanBerhasil">Success</code>';
                                    }else{
                                        echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                                    }
                                }else{
                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                    if($InputLog=="Success"){
                                        echo '<code class="text-success" id="NotifikasiTerimaPengajuanBerhasil">Success</code>';
                                    }else{
                                        echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                                    }
                                }
                            }
                        }else{
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                echo '<code class="text-success" id="NotifikasiTerimaPengajuanBerhasil">Success</code>';
                            }else{
                                echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                            }
                        }
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat membuat data akses ke database</code>';
                    }
                }else{
                    echo '<code class="text-danger">Update Status Penolakan Gagal!</code>';
                }
            }
        }
    }
?>