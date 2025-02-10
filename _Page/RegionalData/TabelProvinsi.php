<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $page_count =0;
    $page =1;
    if(empty($SessionIdAkses)){
        echo '
            <tr>
                <td colspan="5" class="text-center">
                    <small class="text-danger">Sesi Akses Sudah Berakhir. Silahkan Login Ulang!</small>
                </td>
            </tr>
        ';
    }else{
        //Limit
        if(empty($_POST['limit'])){
            $limit=10;
        }else{
            $limit=$_POST['limit'];
        }

        //Limit
        if(empty($_POST['page'])){
            $page=1;
        }else{
            $page=$_POST['page'];
        }
        $position = ($page > 1) ? ($page - 1) * $limit : 0;
        //Hitung Jumlah Data
        if(empty($_POST['keyword'])){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT id_provinsi FROM wilayah_provinsi"));
        }else{
            $keyword=$_POST['keyword'];
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT id_provinsi FROM wilayah_provinsi WHERE provinsi like '%$keyword%'"));
        }
        if(empty($jml_data)){
            echo '
                <tr>
                    <td colspan="5" class="text-center">
                        <small class="text-danger">Tidak Ada Data Yang Ditemukan</small>
                    </td>
                </tr>
            ';
        }else{
            // Calculate Page Count
            $page_count = ceil($jml_data / $limit);
            $no = 1+$position;
            //KONDISI PENGATURAN MASING FILTER
            if(empty($_POST['keyword'])){
                $query = mysqli_query($Conn, "SELECT id_provinsi, provinsi FROM wilayah_provinsi ORDER BY provinsi ASC LIMIT $position, $limit");
            }else{
                $keyword=$_POST['keyword'];
                $query = mysqli_query($Conn, "SELECT id_provinsi, provinsi FROM wilayah_provinsi WHERE provinsi like '%$keyword%' ORDER BY provinsi ASC LIMIT $position, $limit");
            }
            while ($data = mysqli_fetch_array($query)) {
                $id_provinsi= $data['id_provinsi'];
                $provinsi= $data['provinsi'];
                //Jumlah Kabupaten
                $JumlahKabupaten = mysqli_num_rows(mysqli_query($Conn, "SELECT id_kabkot FROM wilayah_kabkot WHERE id_provinsi='$id_provinsi'"));
                $JumlahOpd = mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd WHERE id_provinsi='$id_provinsi'"));
                echo '
                    <tr>
                        <td><small>'.$no.'</small></td>
                        <td>
                            <a href="javascript:void(0);" class="show_tabel_kabupaten" data-id="'.$id_provinsi.'">
                                <small>'.$provinsi.'</small>
                            </a>
                        </td>
                        <td><small>'.$JumlahKabupaten.'</small></td>
                        <td><small>'.$JumlahOpd.'</small></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditProvinsi" data-id="'.$id_provinsi.'" data-value="'.$provinsi.'">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusProvinsi" data-id="'.$id_provinsi.'" data-value="'.$provinsi.'">
                                        <i class="bi bi-trash"></i> Hapus
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
    var page_count="<?php echo $page_count; ?>";
    var curent_page="<?php echo $page; ?>";
    
    //Put Into Pagging Element
    $('#page_info_provinsi').html('Page '+curent_page+' Of '+page_count+'');
    
    //Set Pagging Button
    if(curent_page==1){
        $('#prev_button_provinsi').prop('disabled', true);
    }else{
        $('#prev_button_provinsi').prop('disabled', false);
    }
    if(page_count<=curent_page){
        $('#next_button_provinsi').prop('disabled', true);
    }else{
        $('#next_button_provinsi').prop('disabled', false);
    }
</script>
