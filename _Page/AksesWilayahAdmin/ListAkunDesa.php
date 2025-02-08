<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<tr>';
        echo '  <td colpsn="4" align="center" class="text-danger">ID Wilayah Tidak Boleh Kosong!</td>';
        echo '</tr>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $desa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
        //Menampilkan Akun Akses
        $JumlahAkun = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$id_wilayah'"));
        if(empty($JumlahAkun)){
            echo '<tr>';
            echo '  <td colpsn="4" align="center" class="text-danger">Tidak ada data akun untuk desa '.$desa.' ini</td>';
            echo '</tr>';
        }else{
            $no=1;
            $query = mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$id_wilayah' ORDER BY nama ASC");
            while ($data = mysqli_fetch_array($query)) {
                $id_akses= $data['id_akses'];
                $nama= $data['nama'];
                $kontak= $data['kontak'];
                $email= $data['email'];
                echo '<tr>';
                echo '  <td align="center">'.$no.'</td>';
                echo '  <td align="left">'.$nama.'</td>';
                echo '  <td align="left">'.$kontak.'</td>';
                echo '  <td align="left">'.$email.'</td>';
                echo '</tr>';
                $no++;
            }
        }
    }
?>