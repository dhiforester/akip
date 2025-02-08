<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
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
    if(empty($keyword_by)){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR akses like '%$keyword%' OR updatetime like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE $keyword_by like '%$keyword%'"));
        }
    }
    //Mengatur Halaman
    $JmlHalaman = ceil($jml_data/$batas); 
    $prev=$page-1;
    $next=$page+1;
    if($next>$JmlHalaman){
        $next=$page;
    }else{
        $next=$page+1;
    }
    if($prev<"1"){
        $prev="1";
    }else{
        $prev=$page-1;
    }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var page=$('#NextPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/Akses/TabelAkses.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelAkses').html(data);
                $('#page').val(page);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var page = $('#PrevPage').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var keyword_by="<?php echo "$keyword_by"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/Akses/TabelAkses.php",
            method  : "POST",
            data 	:  { page: page,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelAkses').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<div class="row mb-3">
    <?php
        if(empty($jml_data)){
            echo '<div class="col-md-12">';
            echo '  <div class="card">';
            echo '      <div class="card-body text-center">';
            echo '          Tidak Ada Data Akses Yang Ditemukan';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
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
            while ($data = mysqli_fetch_array($query)) {
                $id_akses= $data['id_akses'];
                $nama_akses= $data['nama'];
                $kontak_akses= $data['kontak'];
                $email_akses= $data['email'];
                $akses= $data['akses'];
                if(empty( $data['foto'])){
                    $url_foto='assets/img/User/No-Image.png';
                }else{
                    $foto= $data['foto'];
                    $url_foto='assets/img/User/'.$foto.'';
                }
                $datetime_update= $data['updatetime'];
                $strtotime=strtotime($datetime_update);
                $datetime_update=date('d/m/Y H:i',$strtotime);
                //Menghitung Jumlah Izin Akses
                $JumlahFitur = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_ijin WHERE id_akses='$id_akses'"));
                if(!empty($data['id_wilayah'])){
                    $id_wilayah= $data['id_wilayah'];
                    if($akses=="Provinsi"){
                        $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'propinsi');
                    }else{
                        if($akses=="Kabupaten"){
                            $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kabupaten');
                        }else{
                            if($akses=="Kecamatan"){
                                $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
                            }else{
                                $LabelWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
                            }
                        }
                    }
                    
                }else{
                    $id_wilayah="";
                    $LabelWilayah='<span class="text-danger">No Data</span>';
                }
    ?>
    </div>
        <div class="col-md-12">
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="<?php echo "$id_akses"; ?>">
                                <i class="bi bi-key"></i> Ubah Password
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahIjinAkses" data-id="<?php echo "$id_akses"; ?>">
                                <i class="bi bi-clipboard2-check"></i> Ijin Akses
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="<?php echo "$id_akses"; ?>">
                                <i class="bi bi-pencil"></i> Edit Akses
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="<?php echo "$id_akses"; ?>">
                                <i class="bi bi-x"></i> Hapus Akses
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="<?php echo "$id_akses"; ?>" title="Lihat Detai Akun <?php echo "$nama_akses"; ?>">
                        <b><i class="bi bi-person-circle"></i> <?php echo "$nama_akses";?></b>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 text-center mb-2">
                            <img src="<?php echo "$url_foto";?>" alt="Profile" class="rounded-circle" width="50%">
                        </div>
                        <div class="col-md-4">
                            <code class="text-dark" title="Alamat Email">
                                <i class='bi bi-envelope'></i> <?php echo "$email_akses"; ?>
                            </code><br>
                            <code class="text-dark" title="Kontak/HP">
                                <i class='bi bi-phone'></i> <?php echo "$kontak_akses"; ?>
                            </code>
                        </div>
                        <div class="col-md-4">
                            <code class="text-dark" title="Level Akses">
                                <i class='bi bi-tag'></i> <?php echo "$akses"; ?>
                            </code><br>
                            <code class="text-dark" title="Ijin Akses">
                                <i class="bi bi-map"></i> <?php echo "$LabelWilayah";?>
                            </code>
                        </div>
                        <div class="col-md-3">
                            <code class="text-dark" title="Otoritas Wilayah">
                                <i class="bi bi-key"></i> <?php echo "$JumlahFitur Fitur";?>
                            </code><br>
                            <code class="text-dark" title="Update Time">
                                <i class="bi bi-calendar"></i> <?php echo "$datetime_update";?>
                            </code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
                $no++; 
            }
        }
    ?>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-sm btn-info" id="PrevPage" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-sm btn-outline-info">
                <?php echo "$page of $JmlHalaman"; ?>
            </button>
            <button class="btn btn-sm btn-info" id="NextPage" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>