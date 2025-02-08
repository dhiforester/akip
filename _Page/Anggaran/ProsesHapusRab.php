<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    if(empty($_POST['id_anggaran_rab'])){
        echo '<code class="text-danger">ID tidak dapat ditangkap oleh sistem</code>';
    }else{
        $id_anggaran_rab=$_POST['id_anggaran_rab'];
        $id_anggaran_rincian=getDataDetail($Conn,'anggaran_rab','id_anggaran_rab',$id_anggaran_rab,'id_anggaran_rincian');
        //Proses hapus data
        $HapusRab = mysqli_query($Conn, "DELETE FROM anggaran_rab WHERE id_anggaran_rab='$id_anggaran_rab'") or die(mysqli_error($Conn));
        if ($HapusRab) {
            //Hitung Ulang Jumlah Anggaran
            $SqlJumlah = "SELECT SUM(jumlah) AS total FROM anggaran_rab WHERE id_anggaran_rincian='$id_anggaran_rincian'";
            $result = $Conn->query($SqlJumlah);
            // Periksa apakah hasil kueri tersedia
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $anggaran=$row['total'];
            } else {
                $anggaran =0;
            }
            //Update Anggaran
            $UpdateAnggaran = mysqli_query($Conn,"UPDATE anggaran_rincian SET 
                volume='',
                satuan='',
                anggaran='$anggaran'
            WHERE id_anggaran_rincian='$id_anggaran_rincian'") or die(mysqli_error($Conn)); 
            if($UpdateAnggaran){
                $kategori_log="Anggaran";
                $deskripsi_log="Hapus Anggaran RAB Berhasil";
                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                if($InputLog=="Success"){
                    echo '<code class="text-success" id="NotifikasiHapusRabBerhasil">Success</code>';
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan Log</code>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat update rincian anggaran</small>';
            }
        }else{
            echo '<code class="text-danger">Hapus Data Anggaran Gagal</code>';
        }
    }
?>