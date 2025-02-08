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
        $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        //Menampilkan Kabupaten
        $JumlahDesa = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$kecamatan'"));
        if(empty($JumlahDesa)){
            echo '<tr>';
            echo '  <td colpsn="4" align="center" class="text-danger">Tidak ada data Desa pada kecamatan '.$kecamatan.' ini</td>';
            echo '</tr>';
        }else{
            $no=1;
            $JumlahAkunAktif=0;
            $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$kecamatan' ORDER BY desa ASC");
            while ($data = mysqli_fetch_array($query)) {
                $IdWilayahDesa= $data['id_wilayah'];
                $desa= $data['desa'];
                //Jumlah Akses
                $JumlahAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$IdWilayahDesa'"));
                $JumlahAkunAktif=$JumlahAkunAktif+$JumlahAkses;
                echo '<tr>';
                echo '  <td align="center">'.$no.'</td>';
                echo '  <td align="left">';
                echo '      <a href="index.php?Page=AksesWilayahAdmin&Sub=DetailDesa&id='.$IdWilayahDesa.'&id_kecamatan='.$id_wilayah.'">'.$IdWilayahDesa.'</a>';
                echo '  </td>';
                echo '  <td align="left">'.$desa.' Desa</td>';
                echo '  <td align="center">'.$JumlahAkses.' User</td>';
                echo '</tr>';
                $no++;
            }
            echo '<tr>';
            echo '  <td align="center" colspan="3"><b>JUMLAH AKUN</b></td>';
            echo '  <td align="center"><b>'.$JumlahAkunAktif.' User</b></td>';
            echo '</tr>';
        }
    }
?>