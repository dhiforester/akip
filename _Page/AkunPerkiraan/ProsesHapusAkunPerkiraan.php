<?php
    //Koneksi dan SessionLogin
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_perkiraan'])){
        echo '<i class="text-danger">ID Perkiraan Tidak dapat ditangkap pada saat proses hapus data</i>';
    }else{
        $id_perkiraan=$_POST['id_perkiraan'];
        //Buka Data Akun Perkiraan
        $Qry = mysqli_query($Conn,"SELECT * FROM akun_perkiraan WHERE id_perkiraan='$id_perkiraan'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        $kode = $Data['kode'];
        $rank = $Data['rank'];
        $nama = $Data['nama'];
        $level = $Data['level'];
        $saldo_normal = $Data['saldo_normal'];
        $status = $Data['status'];
        //Proses hapus data akun perkiraan
        $query = mysqli_query($Conn, "DELETE FROM akun_perkiraan WHERE id_perkiraan='$id_perkiraan'") or die(mysqli_error($Conn));
        if ($query) {
            //Hapus data anak akun
            $query2 = mysqli_query($Conn, "DELETE FROM akun_perkiraan WHERE kd$level='$kode' AND level>'$level'") or die(mysqli_error($Conn));
            if($query2){
                echo '<i class="text-success" id="NotifikasiHapusAkunPerkiraanBerhasil">Success</i>';
            }else{
                echo '<i class="text-danger">Delete Anak Akun Gagal</i>';
            }
        }else{
            echo '<i class="text-danger">Delete Akun Perkiraan Gagal</i>';
        }
    }
?>