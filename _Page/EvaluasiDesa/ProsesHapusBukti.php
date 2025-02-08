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
        echo '<small class="text-danger">ID Jawaban tidak boleh kosong</small>';
    }else{
        //Validasi nama_file tidak boleh kosong
        if(empty($_POST['nama_file'])){
            echo '<small class="text-danger">Nama File tidak boleh kosong</small>';
        }else{
            $id_evaluasi_jawaban=$_POST['id_evaluasi_jawaban'];
            $nama_file=$_POST['nama_file'];
            $UrlFile='../../assets/img/Bukti/'.$nama_file.'';
            if(file_exists($UrlFile)) {
                if (unlink($UrlFile)) {
                    $HapusFile="File Berhasil Di Hapus Dari Directory";
                } else {
                    $HapusFile="File Gagal Di Hapus Dari Directory";
                }
            }
            //Cek Apakah Jawaban Sudah Ada Atau Belum
            $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'")or die(mysqli_error($Conn));
            $DataJawaban = mysqli_fetch_array($QryJawaban);
            if(empty($DataJawaban['id_evaluasi_jawaban'])){
                echo '<small class="text-danger">ID Jawaban Tidak Valid</small>';
            }else{
                $bukti=$DataJawaban['bukti'];
                $dataArray = json_decode($bukti, true);
                $jsonList = [];
                foreach($dataArray as $list){
                    $label_file=$list['label_file'];
                    $file_name=$list['file_name'];
                    if($file_name!==$nama_file){
                        $jsonList[] = [
                            "label_file" => $label_file,
                            "file_name" => $file_name
                        ];
                    }
                }
                $JsonDataBukti = json_encode($jsonList);
                //Update
                $Update = mysqli_query($Conn,"UPDATE evaluasi_jawaban SET 
                    bukti='$JsonDataBukti'
                WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'") or die(mysqli_error($Conn));
                if($Update){
                    $_SESSION['NotifikasiSwal']=$HapusFile;
                    echo '<small class="text-success" id="NotifikasiHapusBuktiBerhasil">Success</small>';
                }
            }
        }
    }
?>