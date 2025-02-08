<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap ParameterFile
    if(empty($_POST['ParameterFile'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      Parameter File Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $ParameterFile=$_POST['ParameterFile'];
        $explode=explode(',',$ParameterFile);
        if(empty($explode['0'])){
            echo '<div class="row">';
            echo '  <div class="col col-md-12 text-center text-danger">';
            echo '      ID Jawaban Tidak Boleh Kosong!';
            echo '  </div>';
            echo '</div>';
        }else{
            if(empty($explode['1'])){
                echo '<div class="row">';
                echo '  <div class="col col-md-12 text-center text-danger">';
                echo '      Nama File Tidak Boleh Kosong!';
                echo '  </div>';
                echo '</div>';
            }else{
                $id_evaluasi_jawaban=$explode['0'];
                $nama_file=$explode['1'];
                //Cek Apakah Jawaban Sudah Ada Atau Belum
                $QryJawaban = mysqli_query($Conn,"SELECT * FROM evaluasi_jawaban WHERE id_evaluasi_jawaban='$id_evaluasi_jawaban'")or die(mysqli_error($Conn));
                $DataJawaban = mysqli_fetch_array($QryJawaban);
                if(empty($DataJawaban['id_evaluasi_jawaban'])){
                    echo '<div class="row">';
                    echo '  <div class="col col-md-12 text-center text-danger">';
                    echo '      ID Jawaban Tidak Ditemukan Atau Tidak Valid!';
                    echo '  </div>';
                    echo '</div>';
                }else{
                    $bukti=$DataJawaban['bukti'];
                    echo '<div class="row">';
                    echo '  <div class="col-md-12 text-center text-danger">';
                    echo '      <iframe src="viewer.php?Folder=Bukti&File='.$nama_file.'" width="100%" height="600"></iframe>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
        }
    }
?>