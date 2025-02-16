<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $jml_data=0;
    if(empty($SessionIdAkses)){
        echo '
            <tr>
                <td colspan="5" class="text-center">
                    <small class="text-danger">Sesi Akses Sudah Berakhir. Silahkan Login Ulang!</small>
                </td>
            </tr>
        ';
    }else{
        if(empty($_POST['id'])){
            echo '
                <tr>
                    <td colspan="5" class="text-center">
                        <small class="text-danger">ID Inspektorat Tidak Boleh Kosong!</small>
                    </td>
                </tr>
            ';
        }else{
            $id_inspektorat=$_POST['id'];
            //Buka Nama kabkot
            $id_inspektorat=GetDetailData($Conn, 'inspektorat', 'id_inspektorat', $id_inspektorat, 'id_inspektorat');
            if(empty($id_inspektorat)){
                echo '
                    <tr>
                        <td colspan="5" class="text-center">
                            <small class="text-danger">Inspektorat Yang Anda Pilih Tidak Ditemukan</small>
                        </td>
                    </tr>
                ';
            }else{
                $no = 1;
                //KONDISI PENGATURAN MASING FILTER
                $query = mysqli_query($Conn, "SELECT id_akses FROM akses_inspektorat WHERE id_inspektorat='$id_inspektorat' ORDER BY id_akses_inspektorat DESC");
                $jml_data = mysqli_num_rows($query);
                if(empty($jml_data)){
                    echo '
                        <tr>
                            <td colspan="5" class="text-center">
                                <small class="text-danger">Tidak Ada Data Yang Ditemukan</small>
                            </td>
                        </tr>
                    ';
                }else{
                    while ($data = mysqli_fetch_array($query)) {
                        $id_akses= $data['id_akses'];
                        //Buka Data Akses
                        $Qry = $Conn->prepare("SELECT * FROM akses WHERE id_akses= ?");
                        $Qry->bind_param("i", $id_akses);
                        if (!$Qry->execute()) {
                            $nama="-";
                            $email="-";
                            $kontak="-";
                        }else{
                            $Result = $Qry->get_result();
                            $Data = $Result->fetch_assoc();
                            $Qry->close();
                            if(empty($Data['id_akses'])){
                                $nama="-";
                                $email="-";
                                $kontak="-";
                            }else{
                                $nama=$Data['nama'];
                                $email=$Data['email'];
                                $kontak=$Data['kontak'];
                            }
                        }
                        echo '
                            <tr>
                                <td><small>'.$no.'</small></td>
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="'.$id_akses.'">
                                        <small>'.$nama.'</small>
                                    </a>
                                </td>
                                <td><small>'.$email.'</small></td>
                                <td><small>'.$kontak.'</small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="'.$id_akses.'">
                                                <i class="bi bi-pencil"></i> Edit Akses
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditPassword" data-id="'.$id_akses.'">
                                                <i class="bi bi-key"></i> Edit Password
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditFoto" data-id="'.$id_akses.'">
                                                <i class="bi bi-image"></i> Edit Foto
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="'.$id_akses.'">
                                                <i class="bi bi-trash"></i> Hapus Akses
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        ';
                        $no++; 
                    }
                }
            }
        }
    }
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";
    
    //Tempelkan Jumlah Data
    $('#put_jumlah_data_akses').html('Jumlah Data : '+jml_data+'');
</script>
