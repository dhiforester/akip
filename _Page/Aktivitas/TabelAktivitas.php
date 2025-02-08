<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    // include "../../_Config/Session.php";
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
        $OrderBy="id_log";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE id_akses like '%$keyword%' OR datetime_log like '%$keyword%' OR kategori_log like '%$keyword%' OR deskripsi_log like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE $keyword_by like '%$keyword%'"));
        }
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
            url     : "_Page/Aktivitas/TabelAktivitas.php",
            method  : "POST",
            data 	:  { page: page, BatasAktivitasUmum: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelAktivitas').html(data);
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
            url     : "_Page/Aktivitas/TabelAktivitas.php",
            method  : "POST",
            data 	:  { page: page, BatasAktivitasUmum: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelAktivitas').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<div class="card-body">
    <?php
        if(empty($jml_data)){
            echo '<div class="row">';
            echo '  <div class="col-md-12 text-center text-danger">';
            echo '      Tidak Ada Data Log Yang Ditemukan';
            echo '  </div>';
            echo '</div>';
        }else{
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
            $no = 1+$posisi;
            //KONDISI PENGATURAN MASING FILTER
            if(empty($keyword_by)){
                if(empty($keyword)){
                    $query = mysqli_query($Conn, "SELECT*FROM log ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM log WHERE id_akses like '%$keyword%' OR datetime_log like '%$keyword%' OR kategori_log like '%$keyword%' OR deskripsi_log like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }else{
                if(empty($keyword)){
                    $query = mysqli_query($Conn, "SELECT*FROM log ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }else{
                    $query = mysqli_query($Conn, "SELECT*FROM log WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                }
            }
            while ($data = mysqli_fetch_array($query)) {
                $id_log= $data['id_log'];
                $id_akses= $data['id_akses'];
                $datetime_log= $data['datetime_log'];
                $kategori_log= $data['kategori_log'];
                $deskripsi_log= $data['deskripsi_log'];
                //Buka data akses
                $QryAkses=mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                $DataAkses=mysqli_fetch_array($QryAkses);
                if(!empty($DataAkses['nama'])){
                    $nama_akses=$DataAkses['nama'];
                }else{
                    $nama_akses="No Data";
                }
                //Mengubah format tanggal
                $datetime_log=strtotime($datetime_log);
                $datetime_log=date('d/m/y H:i:s', $datetime_log);
    ?>
        <div class="row mb-3 border-bottom border-1">
            <div class="col-md-12">
                <b class="text-dark" title="Nama Akses">
                    <?php echo "$no. $nama_akses"; ?>
                </b>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "ID.Log $id_log"; ?>
                        </code>
                    </li>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "ID.Akses $id_akses"; ?>
                        </code>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Kategori. $kategori_log"; ?>
                        </code>
                    </li>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Tgl/Jam. $datetime_log"; ?>
                        </code>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>
                        <code class="text-dark">
                            <i></i> <?php echo "Keterangan. $deskripsi_log"; ?>
                        </code>
                    </li>
                </ul>
            </div>
        </div>
    <?php 
                $no++; 
            }
        }
    ?>
</div>
<div class="card-footer text-center">
    <div class="btn-group shadow-0" role="group" aria-label="Basic example">
        <button class="btn btn-sm btn-info" id="PrevPage" value="<?php echo $prev;?>">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="btn btn-sm btn-outline-info">
            <?php echo "$page/$JmlHalaman"; ?>
        </button>
        <button class="btn btn-sm btn-info" id="NextPage" value="<?php echo $next;?>">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
</div>