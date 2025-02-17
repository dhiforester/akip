<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //Inisiasi Variabel
    $JmlHalaman="";
    $page="";
    //Cek Session
    if(empty($SessionIdAkses)){
        echo '
            <tr>
                <td colspan="5" class="text-center">Sesi Akses Sudah Berakhir. Silahkan Login Ulang!</td>
            </tr>
        ';
    }else{
        //Keyword_by
        if(!empty($_POST['keyword_by'])){
            $keyword_by=$_POST['keyword_by'];
        }else{
            $keyword_by="";
        }
        //keyword
        if(!empty($_POST['keyword'])){
            $keyword=$_POST['keyword'];
        }else{
            $keyword="";
        }
        //batas
        if(!empty($_POST['batas'])){
            $batas=$_POST['batas'];
        }else{
            $batas="10";
        }
        //ShortBy
        if(!empty($_POST['ShortBy'])){
            $ShortBy=$_POST['ShortBy'];
            if($ShortBy=="ASC"){
                $NextShort="DESC";
            }else{
                $NextShort="ASC";
            }
        }else{
            $ShortBy="DESC";
            $NextShort="ASC";
        }
        //OrderBy
        if(!empty($_POST['OrderBy'])){
            $OrderBy=$_POST['OrderBy'];
        }else{
            $OrderBy="id_inspektorat";
        }
        //Atur Page
        if(!empty($_POST['page'])){
            $page=$_POST['page'];
            $posisi = ( $page - 1 ) * $batas;
        }else{
            $page="1";
            $posisi = 0;
        }
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inspektorat ORDER BY $OrderBy $ShortBy"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inspektorat WHERE nama_inspektorat like '%$keyword%' OR telepon like '%$keyword%' OR alamat like '%$keyword%' ORDER BY $OrderBy $ShortBy"));
            }
        }else{
            if(empty($keyword)){
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inspektorat ORDER BY $OrderBy $ShortBy"));
            }else{
                $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM inspektorat WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy"));
            }
        }
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM inspektorat ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM inspektorat WHERE nama_inspektorat like '%$keyword%' OR telepon like '%$keyword%' OR alamat like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM inspektorat ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM inspektorat WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        if(empty($jml_data)){
            echo '
                <tr>
                    <td colspan="7" class="text-center text-danger">Tidak Ada Data Yang Ditampilkan</td>
                </tr>
            ';
        }else{
            while ($data = mysqli_fetch_array($query)) {
                $id_inspektorat= $data['id_inspektorat'];
                $id_provinsi= $data['id_provinsi'];
                $id_kabkot= $data['id_kabkot'];
                $nama_inspektorat= $data['nama_inspektorat'];
                //Buka Nama Provinsi
                $provinsi=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');
                $kabkot=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
                //Hitung Jumlah User Dan OPD
                $jumlah_opd=mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd WHERE id_inspektorat='$id_inspektorat'"));
                $jumlah_akses=mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses_inspektorat WHERE id_inspektorat='$id_inspektorat'"));
                echo '
                    <tr>
                        <td><small>'.$no.'</small></td>
                        <td>
                            <a href="javascript:void(0);" class="detail_inspektorat" data-id="'.$id_inspektorat.'">
                                <small>'.$nama_inspektorat.'</small>
                            </a>
                        </td>
                        <td><small>'.$provinsi.'</small></td>
                        <td><small>'.$kabkot.'</small></td>
                        <td><small>'.$jumlah_akses.' Orang</small></td>
                        <td><small>'.$jumlah_akses.' OPD</small></td>
                        <td>
                            <button class="btn btn-sm btn-floating btn-outline-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditInspektorat" data-id="'.$id_inspektorat.'">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusInspektorat" data-id="'.$id_inspektorat.'">
                                        <i class="bi bi-x"></i> Hapus
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                ';
                $no++;
            }
        }
        $JmlHalaman = ceil($jml_data/$batas); 
    }
?>
<script>
    //Creat Javascript Variabel
    var page_count="<?php echo $JmlHalaman; ?>";
    var curent_page="<?php echo $page; ?>";
    
    //Put Into Pagging Element
    $('#page_info_inspektorat').html('Page '+curent_page+' Of '+page_count+'');
    
    //Set Pagging Button
    if(curent_page==1){
        $('#prev_button_inspektorat').prop('disabled', true);
    }else{
        $('#prev_button_inspektorat').prop('disabled', false);
    }
    if(page_count<=curent_page){
        $('#next_button_inspektorat').prop('disabled', true);
    }else{
        $('#next_button_inspektorat').prop('disabled', false);
    }
</script>