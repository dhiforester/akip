<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    //keyword
    if(!empty($_POST['keyword_kabupaten'])){
        $keyword=$_POST['keyword_kabupaten'];
    }else{
        $keyword="";
    }
    //batas
    $batas="10";
    //ShortBy
    $ShortBy="ASC";
    //OrderBy
    $OrderBy="kabupaten";
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if(empty($keyword)){
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah WHERE kategori='Kabupaten'"));
    }else{
        $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM wilayah WHERE (kategori='Kabupaten') AND (kabupaten like '%$keyword%' OR propinsi like '%$keyword%')"));
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
    $('#NextPageKabupaten').click(function() {
        var page_kabupaten=$('#NextPageKabupaten').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/BidangKegiatan/ListKabupaten.php",
            method  : "POST",
            data 	:  { page: page_kabupaten, batas: batas, keyword_kabupaten: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#ListKabupaten').html(data);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPageKabupaten').click(function() {
        var page_kabupaten = $('#PrevPageKabupaten').val();
        var batas="<?php echo "$batas"; ?>";
        var keyword="<?php echo "$keyword"; ?>";
        var OrderBy="<?php echo "$OrderBy"; ?>";
        var ShortBy="<?php echo "$ShortBy"; ?>";
        $.ajax({
            url     : "_Page/BidangKegiatan/ListKabupaten.php",
            method  : "POST",
            data 	:  { page: page_kabupaten, batas: batas, keyword_kabupaten: keyword, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#ListKabupaten').html(data);
            }
        })
    });
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-center">';
        echo '              Tidak Ada Data Kabupaten Yang Ditemukan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword)){
            $query = mysqli_query($Conn, "SELECT * FROM wilayah WHERE kategori='Kabupaten' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
        }else{
            $query = mysqli_query($Conn, "SELECT * FROM wilayah WHERE (kategori='Kabupaten') AND (kabupaten like '%$keyword%' OR propinsi like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_wilayah= $data['id_wilayah'];
            $kabupaten= $data['kabupaten'];
            $propinsi= $data['propinsi'];
            //Hitung Jumlah Parameter Kegiatan Yang Sudah Diinput
            $JumlaBidangKegiatan = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND level='Bidang'"));
?>
    <div class="row border-1 border-bottom mb-3">
        <div class="col-md-12">
            <a href="index.php?Page=BidangKegiatan&Sub=BidangKegiatanKabupaten&id_wilayah=<?php echo "$id_wilayah"; ?>">
                <b><?php echo "$no. $kabupaten"; ?></b>
            </a>
            <ul>
                <li>
                    <small class="credit">
                        <?php echo "Provinsi: $propinsi"; ?>
                    </small>
                </li>
                <li>
                    <small class="credit">
                        <?php echo "Data: $JumlaBidangKegiatan Bidang"; ?>
                    </small>
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
<div class="row">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-sm btn-info" id="PrevPageKabupaten" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-sm btn-outline-info">
                <?php echo "$page of $JmlHalaman"; ?>
            </button>
            <button class="btn btn-sm btn-info" id="NextPageKabupaten" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>