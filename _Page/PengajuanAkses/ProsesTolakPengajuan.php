<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingEmail.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    $kategori_log="Akses";
    $deskripsi_log="Penolakan Pengajuan Akses Berhasil";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_akses_pengajuan'])){
        echo '<code class="text-danger">ID Pengajuan Akses tidak boleh kosong</code>';
    }else{
        $id_akses_pengajuan=$_POST['id_akses_pengajuan'];
        if(empty($_POST['alasan_penolakan'])){
            $alasan_penolakan="";
        }else{
            $alasan_penolakan=$_POST['alasan_penolakan'];
        }
        if(empty($_POST['kirim_email'])){
            $kirim_email="";
        }else{
            $kirim_email=$_POST['kirim_email'];
        }
        $nama=getDataDetail($Conn,'akses_pengajuan','id_akses_pengajuan',$id_akses_pengajuan,'nama');
        //Update Pada Database
        $UpdateAkses = mysqli_query($Conn,"UPDATE akses_pengajuan SET 
            status='Ditolak'
        WHERE id_akses_pengajuan='$id_akses_pengajuan'") or die(mysqli_error($Conn)); 
        if($UpdateAkses){
            if(!empty($kirim_email)){
                $kirim_email=$_POST['kirim_email'];
                $subjek="Pengajuan Akses Ditolak";
                $pesan="Mohon maaf, pengajuan akses ke aplikasi SAKIP ditolak karena : $alasan_penolakan";
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
                            echo '<code class="text-success" id="NotifikasiTolakPengajuanBerhasil">Success</code>';
                        }else{
                            echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                        }
                    }
                }
            }else{
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<code class="text-success" id="NotifikasiTolakPengajuanBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                }
            }
            
        }else{
            echo '<code class="text-danger">Update Status Penolakan Gagal!</code>';
        }
    }
?>