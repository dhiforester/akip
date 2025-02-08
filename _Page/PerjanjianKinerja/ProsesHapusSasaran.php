<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_perjanjian_sasaran tidak boleh kosong
    if(empty($_POST['id_perjanjian_sasaran'])){
        echo '<code class="text-danger">ID Sasaran Perjanjian Kinerja tidak boleh kosong</code>';
    }else{
        $id_perjanjian_sasaran=$_POST['id_perjanjian_sasaran'];
        //Validasi Id perjanjian_kinerja Hanya Boleh Angka
        if(!preg_match("/^[0-9]*$/", $id_perjanjian_sasaran)){
            echo '<code class="text-danger">ID Sasaran Perjanjian Kinerja Hanya Boleh Angka</code>';
        }else{
            $HapusSasaran = mysqli_query($Conn, "DELETE FROM perjanjian_sasaran WHERE id_perjanjian_sasaran='$id_perjanjian_sasaran'") or die(mysqli_error($Conn));
            if($HapusSasaran){
                $HapusAnggaran = mysqli_query($Conn, "DELETE FROM perjanjian_anggaran WHERE id_perjanjian_sasaran='$id_perjanjian_sasaran'") or die(mysqli_error($Conn));
                if($HapusAnggaran){
                    $kategori_log="Perjanjian Kinerja";
                    $deskripsi_log="Hapus sasaran Perjanjian Kinerja Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        $_SESSION['NotifikasiSwal']="Hapus Sasaran Perjanjian Kinerja Berhasil";
                        echo '<small class="text-success" id="NotifikasiHapusSasaranBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data sasaran perjanjian kinerja</code>';
                }
            }else{
                echo '<code class="text-danger">Terjadi kesalahan pada saat hapus data perjanjian kinerja </code>';
            }
        }
    }
?>