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
            $OrderBy="id_akses";
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
                $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM akses WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR akses like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM akses ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM akses WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        $jml_data = mysqli_num_rows($query);
        if(empty($jml_data)){
            echo '
                <tr>
                    <td colspan="5" class="text-center">Tidak Ada Data Yang Ditampilkan</td>
                </tr>
            ';
        }else{
            while ($data = mysqli_fetch_array($query)) {
                $id_akses= $data['id_akses'];
                $id_opd= $data['id_opd'];
                $id_provinsi= $data['id_provinsi'];
                $id_kabkot= $data['id_kabkot'];
                $nama= $data['nama'];
                $kontak_akses= $data['kontak'];
                $email_akses= $data['email'];
                $akses= $data['akses'];
                echo '
                    <tr>
                        <td><small>'.$no.'</small></td>
                        <td><small>'.$nama.'</small></td>
                        <td><small>'.$email_akses.'</small></td>
                        <td><small>'.$akses.'</small></td>
                        <td>
                            <button class="btn btn-sm btn-floating btn-outline-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="'.$id_akses.'">
                                        <i class="bi bi-info-circle"></i> Detail Akses
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="'.$id_akses.'">
                                        <i class="bi bi-key"></i> Ubah Password
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="'.$id_akses.'">
                                        <i class="bi bi-pencil"></i> Edit Akses
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="'.$id_akses.'">
                                        <i class="bi bi-x"></i> Hapus Akses
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
    $('#page_info_provinsi').html('Page '+curent_page+' Of '+page_count+'');
    
    //Set Pagging Button
    if(curent_page==1){
        $('#prev_button_akses').prop('disabled', true);
    }else{
        $('#prev_button_akses').prop('disabled', false);
    }
    if(page_count<=curent_page){
        $('#next_button_akses').prop('disabled', true);
    }else{
        $('#next_button_akses').prop('disabled', false);
    }
</script>