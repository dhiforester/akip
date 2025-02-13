<?php
    //Koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Tangkap Variabel
    if(empty($_POST['id_akses'])){
        echo '<code class="text-danger">ID Akses Tidak Boleh Kosong!</code>';
    }else{
        if(empty($_POST['id_akses_fitur'])){
            echo '<code class="text-danger">Setidaknya Akses Ini Memiliki Satu Ijin Akses!</code>';
        }else{
            $id_akses=$_POST['id_akses'];
            $id_akses_fitur=$_POST['id_akses_fitur'];
            $JumlahIjinAkses=count($id_akses_fitur);
            if(empty($JumlahIjinAkses)){
                echo '<code class="text-danger">Tidak Ada Data Ijin Akses Yang Ditangkap!</code>';
            }else{
                //Hapus Semua Data Ijin Akses
                $HapusIjinAkses = mysqli_query($Conn, "DELETE FROM akses_ijin WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                if($HapusIjinAkses){
                    //Loopimg
                    $index=0;
                    $JumlahBerhasilInput=0;
                    foreach($id_akses_fitur as $ListIdAksesFitur){
                        //Buka Kode
                        $kode=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$ListIdAksesFitur,'kode');
                        //Simpan Data
                        $EntryIjinAkses="INSERT INTO akses_ijin (
                            id_akses,
                            id_akses_fitur,
                            kode
                        ) VALUES (
                            '$id_akses',
                            '$ListIdAksesFitur',
                            '$kode'
                        )";
                        $InputIjinAkses=mysqli_query($Conn, $EntryIjinAkses);
                        if($InputIjinAkses){
                            $JumlahBerhasilInput=$JumlahBerhasilInput+1;
                        }else{
                            $JumlahBerhasilInput=$JumlahBerhasilInput+0;
                        }
                        $index++;
                    }
                    if($JumlahBerhasilInput==$JumlahIjinAkses){
                        $kategori_log="Akses";
                        $deskripsi_log="Ubah Ijin Akses Berhasil";
                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                        if($InputLog=="Success"){
                            echo '<small class="text-success" id="NotifikasiUbahIjinAksesBerhasil">Success</small>';
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                        }
                    }else{
                        echo '<code class="text-danger">Ijin Akses Yang Diinput Tidak Lengkap</code>';
                    }
                }else{
                    echo '<code class="text-danger">Terjadi kesalahan pada saat menghapus ijin akses sebelumnya!</code>';
                }
            }
        }
    }
?>