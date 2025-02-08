<?php
    //Connection
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    if(empty($_POST['id_referensi_bukti'])){
        echo '<span class="text-danger">ID Referensi Bukti Tidak Boleh Kosong</span>';
    }else{
        $id_referensi_bukti=$_POST['id_referensi_bukti'];
        //Proses hapus data
        $Hapus1 = mysqli_query($Conn, "DELETE FROM referensi_bukti WHERE id_referensi_bukti='$id_referensi_bukti'") or die(mysqli_error($Conn));
        if ($Hapus1) {
            $Hapus2 = mysqli_query($Conn, "DELETE FROM kriteria_indikator_ref WHERE id_referensi_bukti='$id_referensi_bukti'") or die(mysqli_error($Conn));
            if ($Hapus2) {
                echo '<span class="text-success" id="NotifikasiHapusLampiranBuktiBerhasil">Success</span>';
            }else{
                echo '<span class="text-danger">Terjadi kesalahan pada saat menghapus data pada tabel kriteria_indikator_ref</span>';
            }
        }else{
            echo '<span class="text-danger">Terjadi Kesalahan Pada Saat Menghapus Data pada tabel referensi_bukti</span>';
        }
    }
?>