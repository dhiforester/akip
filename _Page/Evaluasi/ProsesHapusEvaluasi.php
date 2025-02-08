<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_evaluasi'])){
        echo '<code class="text-danger">ID Aevaluasi tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_evaluasi=$_POST['id_evaluasi'];
        $HapusEvaluasi = mysqli_query($Conn, "DELETE FROM evaluasi WHERE id_evaluasi='$id_evaluasi'") or die(mysqli_error($Conn));
        if ($HapusEvaluasi) {
            $HapusEvaluasiJawaban = mysqli_query($Conn, "DELETE FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi'") or die(mysqli_error($Conn));
            if($HapusEvaluasiJawaban){
                $HapusEvaluasiRekap = mysqli_query($Conn, "DELETE FROM evaluasi_rekap WHERE id_evaluasi='$id_evaluasi'") or die(mysqli_error($Conn));
                if($HapusEvaluasiRekap){
                    $kategori_log="Evaluasi";
                    $deskripsi_log="Hapus Evaluasi Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        echo '<code class="text-success" id="NotifikasiHapusEvaluasiBerhasil">Success</code>';
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                    }
                }
            }else{
                echo '<code class="text-danger">Hapus Data Ijin Akses Gagal</code>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Gagal</code>';
        }
    }
?>