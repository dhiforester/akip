<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_file_store tidak boleh kosong
    if(empty($_POST['id_file_store'])){
        echo '<small class="text-danger">ID Jawaban tidak boleh kosong</small>';
    }else{
        $id_file_store=$_POST['id_file_store'];
        //Cek Ketersediaan Data
        $Qry= mysqli_query($Conn,"SELECT * FROM file_store WHERE id_file_store='$id_file_store'")or die(mysqli_error($Conn));
        $Data = mysqli_fetch_array($Qry);
        if(empty($Data['id_file_store'])){
            echo '<small class="text-danger">Data Tidak Tersedia</small>';
        }else{
            $nama_file=$Data['nama_file'];
            $UrlFile='../../assets/img/Bukti/'.$nama_file.'';
            if(file_exists($UrlFile)) {
                if (unlink($UrlFile)) {
                    $Hapus = mysqli_query($Conn, "DELETE FROM file_store WHERE id_file_store='$id_file_store'") or die(mysqli_error($Conn));
                    if($Hapus){
                        $_SESSION['NotifikasiSwal']="Hapus File Berhasil";
                        echo '<code class="text-success" id="NotifikasiHapusDraftBerhasil">Success</code>';
                    }else{
                        echo '<small class="text-danger">Gagal Menghapus File Dari Database</small>';
                    }
                } else {
                    echo '<small class="text-danger">File Gagal Di Hapus Dari Directory</small>';
                }
            }
        }
    }
?>