<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi id_evaluasi tidak boleh kosong
    if(empty($_POST['id_evaluasi'])){
        echo '<small class="text-danger">ID Evaluasi tidak boleh kosong</small>';
    }else{
        //Validasi id_wilayah tidak boleh kosong
        if(empty($_POST['id_wilayah'])){
            echo '<small class="text-danger">ID Wilayah tidak boleh kosong</small>';
        }else{
            //Validasi id_kriteria_indikator tidak boleh kosong
            if(empty($_POST['id_kriteria_indikator'])){
                echo '<small class="text-danger">ID Kriteria Indikator tidak boleh kosong</small>';
            }else{
                $id_evaluasi=$_POST['id_evaluasi'];
                $id_wilayah=$_POST['id_wilayah'];
                $id_kriteria_indikator=$_POST['id_kriteria_indikator'];
                //Cek Duplikasi
                $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi='$id_evaluasi' AND id_wilayah='$id_wilayah' AND id_kriteria_indikator='$id_kriteria_indikator'")or die(mysqli_error($Conn));
                $DataJawaban = mysqli_fetch_array($QryJawaban);
                if(empty($DataJawaban['id_evaluasi_jawaban'])){
                    $id_evaluasi_jawaban="";
                }else{
                    $id_evaluasi_jawaban=$DataJawaban['id_evaluasi_jawaban'];
                }
                if(empty($id_evaluasi_jawaban)){
                    $status="Dikirim";
                    $entry="INSERT INTO evaluasi_jawaban (
                        id_evaluasi,
                        id_wilayah,
                        id_kriteria_indikator,
                        jawaban,
                        bukti,
                        skor_desa,
                        skor_kecamatan,
                        status,
                        keterangan_desa,
                        keterangan_kecamatan,
                        keterangan_kabupaten,
                        updatetime
                    ) VALUES (
                        '$id_evaluasi',
                        '$id_wilayah',
                        '$id_kriteria_indikator',
                        '',
                        '',
                        '',
                        '',
                        '$status',
                        '',
                        '',
                        '',
                        '$now'
                    )";
                    $Input=mysqli_query($Conn, $entry);
                }else{
                    $status="Dikirim";
                    $Input = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                        status='$status',
                        updatetime='$now'
                    WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'") or die(mysqli_error($Conn)); 
                }
                if($Input){
                    $kategori_log="Akses";
                    $deskripsi_log="Tambah Akses Baru Berhasil";
                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                    if($InputLog=="Success"){
                        $_SESSION['NotifikasiSwal']="Konfirmasi Desa Berhasil";
                        echo '<small class="text-success" id="NotifikasiKonfirmasiDesaBerhasil">Success</small>';
                    }else{
                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                    }
                }else{
                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                }
            }
        }
    }
?>