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
                $query = mysqli_query($Conn, "SELECT * FROM opd WHERE id_inspektorat='$id_inspektorat' ORDER BY id_opd DESC");
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
                        $id_opd= $data['id_opd'];
                        $nama_opd= $data['nama_opd'];
                        if(empty($data['telepon'])){
                            $telepon="-";
                        }else{
                            $telepon= $data['telepon'];
                        }
                        if(empty($data['alamat'])){
                            $alamat="-";
                        }else{
                            $alamat= $data['alamat'];
                        }
                        
                        echo '
                            <tr>
                                <td><small>'.$no.'</small></td>
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailOpd" data-id="'.$id_opd.'">
                                        <small>'.$nama_opd.'</small>
                                    </a>
                                </td>
                                <td><small>'.$telepon.'</small></td>
                                <td><small>'.$alamat.'</small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditOpd" data-id="'.$id_opd.'">
                                                <i class="bi bi-pencil"></i> Edit OPD
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusOpd" data-id="'.$id_opd.'">
                                                <i class="bi bi-trash"></i> Hapus OPD
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
    $('#put_jumlah_data_opd').html('Jumlah Data : '+jml_data+'');
</script>
