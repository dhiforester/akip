<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_evaluasi_jawaban tidak boleh kosong
    if(empty($_POST['id_evaluasi_jawaban'])){
        echo '<small class="text-danger">ID Evaluasi Jawaban tidak boleh kosong</small>';
    }else{
        if(empty($_POST['status'])){
            echo '<small class="text-danger">Status tidak boleh kosong</small>';
        }else{
            //Validasi keterangan tidak boleh kosong
            if(empty($_POST['keterangan'])){
                $keterangan="";
            }else{
                $keterangan=$_POST['keterangan'];
            }
            $id_evaluasi_jawaban=$_POST['id_evaluasi_jawaban'];
            $status=$_POST['status'];
            $UpdateEvaluasiJawaban = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                status='$status',
                keterangan='$keterangan',
                updatetime='$now'
            WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'") or die(mysqli_error($Conn)); 
            if($UpdateEvaluasiJawaban){
                $kategori_log="Evaluasi";
                $deskripsi_log="Update Evaluasi Jawaban Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    $_SESSION['NotifikasiSwal']="Update Response Berhasil";
                    echo '<small class="text-success" id="NotifikasiUbahResponseBerhasil">Success</small>';
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                }
            }
        }
    }
?>