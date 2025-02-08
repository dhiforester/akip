<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_anggaran'])){
        echo '<code class="text-danger">ID tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_anggaran=$_POST['id_anggaran'];
        //Proses hapus data
        $HapusAnggaran = mysqli_query($Conn, "DELETE FROM anggaran WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
        if ($HapusAnggaran) {
            $HapusRincianAnggaran = mysqli_query($Conn, "DELETE FROM anggaran_rincian WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
            if ($HapusRincianAnggaran) {
                $HapusRab = mysqli_query($Conn, "DELETE FROM anggaran_rab WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
                if ($HapusRab) {
                    $HapusProgress = mysqli_query($Conn, "DELETE FROM anggaran_progress WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
                    if ($HapusProgress) {
                        $kategori_log="Anggaran";
                        $deskripsi_log="Hapus Anggaran Berhasil";
                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                        if($InputLog=="Success"){
                            echo '<code class="text-success" id="NotifikasiHapusAnggaranBerhasil">Success</code>';
                        }else{
                            echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                        }
                    }else{
                        echo '<code class="text-danger">Hapus Data Rincian Anggaran Gagal</code>';
                    }
                }else{
                    echo '<code class="text-danger">Hapus Data Rincian Anggaran Gagal</code>';
                }
            }else{
                echo '<code class="text-danger">Hapus Data Rincian Anggaran Gagal</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Anggaran Gagal</code>';
        }
    }
?>