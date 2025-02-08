<?php
    //koneksi dan session
    ini_set("display_errors","off");
    include "../../_Config/Connection.php";
    // include "../../_Config/Session.php";
    //Keyword_by
    if(!empty($_POST['KeywordBy'])){
        $keyword_by=$_POST['KeywordBy'];
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
        $OrderBy="id_wilayah";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori like '%$keyword%' OR propinsi like '%$keyword%' OR kabupaten like '%$keyword%' OR kecamatan like '%$keyword%' OR desa like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE $keyword_by like '%$keyword%'"));
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
        $('#MenampilkanTabelRegionalData').html("Loading...");
        $.ajax({
            url     : "_Page/RegionalData/TabelRegionalData.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelRegionalData').html(data);
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
        $('#MenampilkanTabelRegionalData').html("Loading...");
        $.ajax({
            url     : "_Page/RegionalData/TabelRegionalData.php",
            method  : "POST",
            data 	:  { page: page,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelRegionalData').html(data);
                $('#page').val(page);
            }
        })
    });
</script>
<?php
    if(empty($jml_data)){
        echo '<div class="row mb-3">';
        echo '  <div class="col-md-12 text-center text-danger">';
        echo '      Data Wilayah Tidak Ditemukan';
        echo '  </div>';
        echo '</div>';
    }else{
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM wilayah ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori like '%$keyword%' OR propinsi like '%$keyword%' OR kabupaten like '%$keyword%' OR kecamatan like '%$keyword%' OR desa like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM wilayah ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_wilayah= $data['id_wilayah'];
            $kategori= $data['kategori'];
            $propinsi= $data['propinsi'];
            $kabupaten= $data['kabupaten'];
            $kecamatan= $data['kecamatan'];
            $desa= $data['desa'];
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                            <li class="dropdown-header text-start">
                                <h6>Option</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditRegionalData" data-id="<?php echo "$id_wilayah"; ?>">
                                    <i class="bi bi-pencil"></i> Edit Wilayah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDeleteRegionalData" data-id="<?php echo "$id_wilayah"; ?>">
                                    <i class="bi bi-x"></i> Hapus Wilayah
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                        if($kategori=="desa"){
                            echo '<div class="card-header">';
                            echo '  <b class="card-title">'.$id_wilayah.'. '.$desa.'</b><br>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            echo '  <div class="row">';
                            echo '      <div class="col-md-3">';
                            echo '          <code class="text-dark"><i class="bi bi-tag"></i> '.$kategori.'</code>';
                            echo '      </div>';
                            echo '      <div class="col-md-3">';
                            echo '          <code class="text-dark">Prov : '.$propinsi.'</code>';
                            echo '      </div>';
                            echo '      <div class="col-md-3">';
                            echo '          <code class="text-dark">Kab : '.$kabupaten.'</code>';
                            echo '      </div>';
                            echo '      <div class="col-md-3">';
                            echo '          <code class="text-dark">Kec : '.$kecamatan.'</code>';
                            echo '      </div>';
                            echo '  </div>';
                            echo '</div>';
                        }else{
                            if($kategori=="Kecamatan"){
                                //Hitung Jumlah Desa
                                $query_jumlah = mysqli_query($Conn, "SELECT COUNT(*) AS jumlah_desa FROM wilayah WHERE kategori='desa' AND kecamatan='$kecamatan'");
                                $Baris = mysqli_fetch_assoc($query_jumlah);
                                $JumlahDesa = $Baris['jumlah_desa'];
                                echo '<div class="card-header">';
                                echo '  <b class="card-title">'.$id_wilayah.'. '.$kecamatan.'</b><br>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '  <div class="row">';
                                echo '      <div class="col-md-3">';
                                echo '          <code class="text-dark"><i class="bi bi-tag"></i> '.$kategori.'</code>';
                                echo '      </div>';
                                echo '      <div class="col-md-3">';
                                echo '          <code class="text-dark">Prov : '.$propinsi.'</code>';
                                echo '      </div>';
                                echo '      <div class="col-md-3">';
                                echo '          <code class="text-dark">Kab : '.$kabupaten.'</code>';
                                echo '      </div>';
                                echo '      <div class="col-md-3">';
                                echo '          <code class="text-dark">Desa : '.$JumlahDesa.' Desa</code>';
                                echo '      </div>';
                                echo '  </div>';
                                echo '</div>';
                            }else{
                                if($kategori=="Kabupaten"){
                                    //Hitung Jumlah Kecamatan dan Desa
                                    $query_jumlah = mysqli_query($Conn, "SELECT COUNT(*) AS jumlah_desa FROM wilayah WHERE kategori='desa' AND kabupaten='$kabupaten'");
                                    $Baris = mysqli_fetch_assoc($query_jumlah);
                                    $JumlahDesa = $Baris['jumlah_desa'];
                                    $JumlahKecamatan=$jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$kabupaten'"));
                                    echo '<div class="card-header">';
                                    echo '  <b class="card-title">'.$id_wilayah.'. '.$kabupaten.'</b><br>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '  <div class="row">';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark"><i class="bi bi-tag"></i> '.$kategori.'</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">Prov : '.$propinsi.'</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">'.$JumlahKecamatan.' Kecamatan</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">'.$JumlahDesa.' Desa</code>';
                                    echo '      </div>';
                                    echo '  </div>';
                                    echo '</div>';
                                }else{
                                    //Hitung Jumlah Desa
                                    $query_jumlah = mysqli_query($Conn, "SELECT COUNT(*) AS jumlah_desa FROM wilayah WHERE kategori='desa' AND propinsi='$propinsi'");
                                    $Baris = mysqli_fetch_assoc($query_jumlah);
                                    $JumlahDesa = $Baris['jumlah_desa'];
                                    //Hitung Jumlah Kecamatan
                                    $query_jumlah_kecamatan = mysqli_query($Conn, "SELECT COUNT(*) AS jumlah_kecamatan FROM wilayah WHERE kategori='Kecamatan' AND propinsi='$propinsi'");
                                    $BarisKecamatan = mysqli_fetch_assoc($query_jumlah_kecamatan);
                                    $JumlahKecamatan = $BarisKecamatan['jumlah_kecamatan'];
                                    //Hitung Jumlah Kabupaten
                                    $query_jumlah_kabupaten = mysqli_query($Conn, "SELECT COUNT(*) AS jumlah_kabupaten FROM wilayah WHERE kategori='Kabupaten' AND propinsi='$propinsi'");
                                    $BarisKabupaten = mysqli_fetch_assoc($query_jumlah_kabupaten);
                                    $JumlahKabupaten = $BarisKabupaten['jumlah_kabupaten'];
                                    echo '<div class="card-header">';
                                    echo '  <b class="card-title">'.$id_wilayah.'. '.$propinsi.'</b><br>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '  <div class="row">';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark"><i class="bi bi-tag"></i> '.$kategori.'</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">'.$JumlahKabupaten.' Kabupaten</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">'.$JumlahKecamatan.' Kecamatan</code>';
                                    echo '      </div>';
                                    echo '      <div class="col-md-3">';
                                    echo '          <code class="text-dark">'.$JumlahDesa.' Desa</code>';
                                    echo '      </div>';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php
            $no++; 
        }
    }
?>
<div class="row mb-3 mt-3">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-sm btn-info" id="PrevPage" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-sm btn-outline-info" id="PrevPage" value="<?php echo $prev;?>">
                <?php echo "$page OF $JmlHalaman"; ?>
            </button>
            <button class="btn btn-sm btn-info" id="NextPage" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>