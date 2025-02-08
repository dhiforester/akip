<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_anggaran_rincian tidak boleh kosong
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<small class="text-danger">ID Rincian Anggaran tidak boleh kosong</small>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
        if(empty($_POST['sasaran'])){
            $sasaran="";
        }else{
            $sasaran=$_POST['sasaran'];
        }
        if(empty($_POST['volume'])){
            $volume="0";
        }else{
            $volume=$_POST['volume'];
        }
        if(empty($_POST['satuan'])){
            $satuan="";
        }else{
            $satuan=$_POST['satuan'];
        }
        if(empty($_POST['anggaran'])){
            $anggaran="0";
        }else{
            $anggaran=$_POST['anggaran'];
        }
        if(empty($_POST['durasi'])){
            $durasi="";
        }else{
            $durasi=$_POST['durasi'];
        }
        //Validasi Karakter Angka
        if (!preg_match("/^\d+(\.\d+)?$/", $volume)) {
            echo '<small class="text-danger">Volume Hanya Boleh Berformat Angka</small>';
        }else{
            if (!preg_match("/^\d+(\.\d+)?$/", $anggaran)) {
                echo '<small class="text-danger">Nilai Anggaran Hanya Boleh Berformat Angka</small>';
            }else{
                $UpdateRincianAnggaran = mysqli_query($Conn,"UPDATE anggaran_rincian SET 
                        sasaran='$sasaran',
                        volume='$volume',
                        satuan='$satuan',
                        anggaran='$anggaran',
                        durasi='$durasi'
                WHERE id_anggaran_rincian='$id_anggaran_rincian'") or die(mysqli_error($Conn)); 
                if($UpdateRincianAnggaran){
                    $kategori_log="Anggaran";
                    $deskripsi_log="Update Rincian Anggaran Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        echo '<small class="text-success" id="NotifikasiEditRincianAnggaranBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                    }
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data ke dalam database</small>';
                }
            }
        }
    }
?>