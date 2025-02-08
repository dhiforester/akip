<?php
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_wilayah'])){
        echo '<tr>';
        echo '  <td colpsn="5" align="center" class="text-danger">ID Wilayah Tidak Boleh Kosong!</td>';
        echo '</tr>';
    }else{
        $id_wilayah=$_POST['id_wilayah'];
        $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
        //Menampilkan Akun Akses
        $JumlahAkun = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$id_wilayah'"));
        if(empty($JumlahAkun)){
            echo '<tr>';
            echo '  <td colpsn="5" align="center" class="text-danger">Tidak ada data akun untuk kecamatan '.$kecamatan.' ini</td>';
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
                echo '  <td align="center">';
                echo '      <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="dropdown" aria-expanded="false">';
                echo '          <i class="bi bi-three-dots"></i>';
                echo '      </a>';
                echo '      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">';
                echo '          <li class="dropdown-header text-start"><h6>Option</h6></li>';
                echo '          <li>';
                echo '              <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="'.$id_akses.'">';
                echo '                  <i class="bi bi-info-circle"></i> Detail Akses';
                echo '              </a>';
                echo '              <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="'.$id_akses.'">';
                echo '                  <i class="bi bi-key"></i> Ubah Password';
                echo '              </a>';
                echo '              <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahIjinAkses" data-id="'.$id_akses.'">';
                echo '                  <i class="bi bi-clipboard2-check"></i> Ijin Akses';
                echo '              </a>';
                echo '              <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="'.$id_akses.'">';
                echo '                  <i class="bi bi-pencil"></i> Edit Akses';
                echo '              </a>';
                echo '              <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="'.$id_akses.'">';
                echo '                  <i class="bi bi-x"></i> Hapus Akses';
                echo '              </a>';
                echo '      </ul>';
                echo '  </td>';
                echo '</tr>';
                $no++;
            }
        }
    }
?>