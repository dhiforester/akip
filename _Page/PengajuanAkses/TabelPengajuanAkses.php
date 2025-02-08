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
        $OrderBy="id_akses_pengajuan";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_pengajuan"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_pengajuan WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR status like '%$keyword%' OR tanggal like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_pengajuan"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_pengajuan WHERE $keyword_by like '%$keyword%'"));
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
        $('#MenampilkanTabelPengajuanAkses').html('Loading...');
        $.ajax({
            url     : "_Page/PengajuanAkses/TabelPengajuanAkses.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelPengajuanAkses').html(data);
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
        $('#MenampilkanTabelPengajuanAkses').html('Loading...');
        $.ajax({
            url     : "_Page/PengajuanAkses/TabelPengajuanAkses.php",
            method  : "POST",
            data 	:  { page: page,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelPengajuanAkses').html(data);
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
        echo '          <div class="card-body text-danger text-center">';
        echo '              Tidak Ada Pengajuan Akses Yang Ditemukan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM akses_pengajuan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM akses_pengajuan WHERE nama like '%$keyword%' OR email like '%$keyword%' OR kontak like '%$keyword%' OR status like '%$keyword%' OR tanggal like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM akses_pengajuan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM akses_pengajuan WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_akses_pengajuan= $data['id_akses_pengajuan'];
            $id_wilayah= $data['id_wilayah'];
            $tanggal= $data['tanggal'];
            $nama= $data['nama'];
            $kontak= $data['kontak'];
            $email= $data['email'];
            $status= $data['status'];
            $surat_pengajuan= $data['surat_pengajuan'];
            $strtotime=strtotime($tanggal);
            $tanggal=date('d/m/Y H:i',$strtotime);
            //Routing Status
            if($status=="Pengajuan"){
                $LabelStatus='<span class="badge badge-info"><i class="bi bi-send"></i> Pengajuan</span>';
            }else{
                if($status=="Diterima"){
                    $LabelStatus='<span class="badge badge-success"><i class="bi bi-check"></i> Diterima</span>';
                }else{
                    if($status=="Ditolak"){
                        $LabelStatus='<span class="badge badge-danger"><i class="bi bi-check"></i> Ditolak</span>';
                    }else{
                        $LabelStatus='<span class="badge badge-dark">Tidak Diketahui</span>';
                    }
                }
            }
            //Buka Data Wilayah
            $NamaKecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'kecamatan');
            $NamaDesa=getDataDetail($Conn,'wilayah','id_wilayah',$id_wilayah,'desa');
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b class="card-title text-dark"><?php echo "$no. $nama"; ?></b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col col-md-4">Email</div>
                                <div class="col col-md-8"><code class="text-grayish"><?php echo "$email"; ?></code></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col col-md-4">Kontak</div>
                                <div class="col col-md-8"><code class="text-grayish"><?php echo "$kontak"; ?></code></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col col-md-4">Tanggal</div>
                                <div class="col col-md-8"><code class="text-grayish"><?php echo "$tanggal"; ?></code></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col col-md-4">Kecamatan</div>
                                <div class="col col-md-8"><code class="text-grayish"><?php echo "$NamaKecamatan"; ?></code></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col col-md-4">Desa</div>
                                <div class="col col-md-8"><code class="text-grayish"><?php echo "$NamaDesa"; ?></code></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col col-md-4">Status</div>
                                <div class="col col-md-8"><?php echo "$LabelStatus"; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-outline-grayish btn-sm btn-rounded" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> Option </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                        <li class="dropdown-header text-start">
                            <h6>Option</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLihatDokumen" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                <i class="bi bi-file-pdf"></i> Dokumen Pengajuan
                            </a>
                        </li>
                        <?php if($status=="Pengajuan"){ ?>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTerimaPengajuan" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                    <i class="bi bi-check"></i> Terima Pengajuan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTolakPengajuan" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                    <i class="bi bi-x"></i> Tolak Pengajuan
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($status=="Ditolak"){ ?>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalBatalkanPenolakan" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                    <i class="bi bi-arrow-90deg-left"></i> Batalkan Penolakan
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($status=="Diterima"){ ?>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalKwitansi" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                    <i class="bi bi-file-earmark-text"></i> Kwitansi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalSertifikat" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                    <i class="bi bi-file-text"></i> Sertifikat
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusPengajuanAkses" data-id="<?php echo "$id_akses_pengajuan"; ?>">
                                <i class="bi bi-trash"></i> Hapus Pengajuan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
            $no++; 
        }
    }
?>
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
