<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
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
        $OrderBy="id_penduduk";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE id_wilayah='$SessionIdWilayah'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE (id_wilayah='$SessionIdWilayah') AND (nama like '%$keyword%' OR nik like '%$keyword%' OR kk like '%$keyword%')"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE id_wilayah='$SessionIdWilayah'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM penduduk WHERE (id_wilayah='$SessionIdWilayah') AND ($keyword_by like '%$keyword%')"));
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
            url     : "_Page/Penduduk/TabelPenduduk.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelPenduduk').html(data);
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
            url     : "_Page/Penduduk/TabelPenduduk.php",
            method  : "POST",
            data 	:  { page: page,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelPenduduk').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-center">';
        echo '              Tidak Ada Data Penduduk Yang Ditemukan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM penduduk WHERE id_wilayah='$SessionIdWilayah' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM penduduk WHERE (id_wilayah='$SessionIdWilayah') AND (nama like '%$keyword%' OR nik like '%$keyword%' OR kk like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM penduduk WHERE id_wilayah='$SessionIdWilayah' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM penduduk WHERE (id_wilayah='$SessionIdWilayah') AND ($keyword_by like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_penduduk= $data['id_penduduk'];
            $id_wilayah= $data['id_wilayah'];
            $nama= $data['nama'];
            $nik= $data['nik'];
            $kk= $data['kk'];
            $kontak_akses= $data['kontak'];
            $hidup= $data['hidup'];
            $keberadaan= $data['keberadaan'];
            $updatetime= $data['updatetime'];
            $strtotime=strtotime($updatetime);
            $updatetime=date('d/m/Y H:i',$strtotime);
            if($hidup=="Hidup"){
                $LabelHidup='<span class="text-success">Hidup</span>';
            }else{
                $LabelHidup='<span class="text-danger">Meninggal</span>';
            }
            if($keberadaan=="Ada"){
                $LabelKeberadaan='<span class="text-success">Ada</span>';
            }else{
                $LabelKeberadaan='<span class="text-danger">Pindah</span>';
            }
?>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailPenduduk" data-id="<?php echo "$id_penduduk"; ?>">
                                <i class="bi bi-info-circle"></i> Detail Penduduk
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditPenduduk" data-id="<?php echo "$id_penduduk"; ?>">
                                <i class="bi bi-pencil"></i> Edit Penduduk
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusPenduduk" data-id="<?php echo "$id_penduduk"; ?>">
                                <i class="bi bi-x"></i> Hapus Data
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title" data-bs-toggle="modal" data-bs-target="#ModalDetailPenduduk" data-id="<?php echo "$id_penduduk"; ?>" title="Lihat Detai Penduduk">
                        <b><?php echo "$no. $nama";?></b>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="credit">
                                NIK : <code class="text-grayish"><?php echo "$nik"; ?></code><br>
                                No.KK : <code class="text-grayish"><?php echo "$kk"; ?></code>
                            </small>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">
                                Status Hidup : <code class="text-grayish"><?php echo "$LabelHidup"; ?></code><br>
                                Keberadaan : <code class="text-grayish"><?php echo "$LabelKeberadaan"; ?></code>
                            </small>
                        </div>
                        <div class="col-md-4">
                            <small class="credit">
                                Update : <code class="text-grayish"><?php echo "$updatetime"; ?></code>
                            </small>
                        </div>
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
<div class="row mb-3">
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