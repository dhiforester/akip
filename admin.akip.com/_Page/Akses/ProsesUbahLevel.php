<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Id Akses
    if(empty($_POST['id_akses'])){
        echo '<small class="text-danger">ID Akses tidak boleh kosong</small>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Validasi Password tidak boleh kosong
        if(empty($_POST['akses_edit'])){
            echo '<small class="text-danger">Level Akses tidak boleh kosong</small>';
        }else{     
            $akses=$_POST['akses_edit'];     
            $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                akses='$akses',
                datetime_update='$now'
            WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
            if($UpdateAkses){
                //Melakukan perubahan pada ijin akses
                $HapusIjinAkses = mysqli_query($Conn, "DELETE FROM akses_ijin WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                if($HapusIjinAkses){
                    //Buat Ijin Aksees
                    $QryReferensi = mysqli_query($Conn, "SELECT*FROM akses_referensi ORDER BY kode_fitur ASC");
                    while ($DataReferensi = mysqli_fetch_array($QryReferensi)) {
                        $kode_fitur= $DataReferensi['kode_fitur'];
                        //Cek pada entitas akses
                        $QryEntitas = mysqli_query($Conn,"SELECT * FROM akses_entitas WHERE akses='$akses' AND kode_fitur='$kode_fitur'")or die(mysqli_error($Conn));
                        $DataEntitas = mysqli_fetch_array($QryEntitas);
                        if(!empty($DataEntitas['akses'])){
                            $entry_lagi="INSERT INTO akses_ijin (
                                id_akses,
                                akses,
                                mitra,
                                kode_fitur
                            ) VALUES (
                                '$id_akses',
                                '$akses',
                                'Tidak',
                                '$kode_fitur'
                            )";
                            $InputLagi=mysqli_query($Conn, $entry_lagi);
                        }
                    }
                    $id_mitra=0;
                    $KategoriLog="Akses";
                    $KeteranganLog="Ubah Akses";
                    include "../../_Config/InputLog.php";
                    echo '<small class="text-success" id="NotifikasiUbahLevelBerhasil">Success</small>';
                }else{
                    echo '<span class="text-danger">Hapus Data Ijin Akses Gagal</span>';
                }
            }else{
                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
            }
        }
    }
?>