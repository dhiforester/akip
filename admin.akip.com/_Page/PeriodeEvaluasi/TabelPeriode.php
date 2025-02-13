<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $jml_data =0;
    $id_kabkot="";
    $kabkot="";
    $provinsi="";
    if(empty($SessionIdAkses)){
        echo '
            <tr>
                <td colspan="6" class="text-center">
                    <small class="text-danger">Sesi Akses Sudah Berakhir. Silahkan Login Ulang!</small>
                </td>
            </tr>
        ';
    }else{
        $no = 1;
        $query = mysqli_query($Conn, "SELECT * FROM evaluasi_periode ORDER BY periode DESC");
        $jml_data = mysqli_num_rows($query);
        if(empty($jml_data)){
            echo '
                <tr>
                    <td colspan="6" class="text-center">
                        <small class="text-danger">Tidak Ada Data Yang Ditemukan</small>
                    </td>
                </tr>
            ';
        }else{
            while ($data = mysqli_fetch_array($query)) {
                $id_evaluasi_periode= $data['id_evaluasi_periode'];
                $periode= $data['periode'];
                $date_mulai= $data['date_mulai'];
                $date_selesai= $data['date_selesai'];
                
                //Format
                $tanggal_mulai=date('d F Y', strtotime($date_mulai));
                $tanggal_selesai=date('d F Y', strtotime($date_selesai));
                
                //Sekarang
                $tanggal_sekarang=date('Y-m-d H:i:s');
                if($tanggal_sekarang<$date_mulai){
                    $status_label='<span class="badge badge-warning">Belum Dimulai</span>';
                }else{
                    if($tanggal_sekarang>$date_selesai){
                        $status_label='<span class="badge badge-dark">Selesai</span>';
                    }else{
                        $status_label='<span class="badge badge-success">Berlangusng</span>';
                    }
                }
                echo '
                    <tr>
                        <td><small>'.$no.'</small></td>
                        <td>
                            <a href="javascript:void(0);" class="show_detail_periode" data-id="'.$id_evaluasi_periode.'">
                                <small>'.$periode.'</small>
                            </a>
                        </td>
                        <td><small>'.$tanggal_mulai.'</small></td>
                        <td><small>'.$tanggal_selesai.'</small></td>
                        <td><small>'.$status_label.'</small></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditPeriode" data-id="'.$id_evaluasi_periode.'" data-mode="List">
                                        <i class="bi bi-pencil"></i> Edit Periode
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusPeriode" data-id="'.$id_evaluasi_periode.'">
                                        <i class="bi bi-trash"></i> Hapus Periode
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
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";

    //Put Into Pagging Element
    $('#jumlah_periode').html('Jumlah Data: '+jml_data+' Periode');
</script>
