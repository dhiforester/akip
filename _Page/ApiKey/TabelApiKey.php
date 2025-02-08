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
    }else{
        $ShortBy="DESC";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="id_api_key";
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
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE nama like '%$keyword%' OR email like '%$keyword%' OR updatetime like '%$keyword%' OR api_key like '%$keyword%' OR status like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM api_key WHERE $keyword_by like '%$keyword%'"));
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
            url     : "_Page/ApiKey/TabelApiKey.php",
            method  : "POST",
            data 	:  { page: page, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function (data) {
                $('#MenampilkanTabelApiKey').html(data);
                $('#page').html(page);
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
            url     : "_Page/ApiKey/TabelApiKey.php",
            method  : "POST",
            data 	:  { page: page,batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success : function (data) {
                $('#MenampilkanTabelApiKey').html(data);
                $('#page').html(page);
            }
        })
    });
</script>
<?php
    if(empty($jml_data)){
        $JmlHalaman =0;
        echo '<div class="row">';
        echo '  <div class="col-md-12">';
        echo '      <div class="card">';
        echo '          <div class="card-body text-center text-danger">';
        echo '              Tidak Ada Data Yang Ditemukan';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
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
        $no = 1+$posisi;
        //KONDISI PENGATURAN MASING FILTER
        if(empty($keyword_by)){
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM api_key ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM api_key WHERE nama like '%$keyword%' OR email like '%$keyword%' OR updatetime like '%$keyword%' OR api_key like '%$keyword%' OR status like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }else{
            if(empty($keyword)){
                $query = mysqli_query($Conn, "SELECT*FROM api_key ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }else{
                $query = mysqli_query($Conn, "SELECT*FROM api_key WHERE $keyword_by like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
            }
        }
        while ($data = mysqli_fetch_array($query)) {
            $id_api_key= $data['id_api_key'];
            $nama= $data['nama'];
            $email= $data['email'];
            $updatetime= $data['updatetime'];
            $api_key= $data['api_key'];
            $status= $data['status'];
            //Ubah waktu ke format lokal
            $strtotime=strtotime($updatetime);
            $datetime_api_key=date('d/m/y H:i',$strtotime);
            //Routing Status
            if($status=="Active"){
                $LabelStatus='<code class="text-success">Active</code>';
            }else{
                if($status=="Request"){
                    $LabelStatus='<code class="text-warning">Request</code>';
                }else{
                    $LabelStatus='<code class="text-danger">Block</code>';
                }
            }
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
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditApiKey" data-id="<?php echo "$id_api_key"; ?>">
                                <i class="bi bi-pencil"></i> Edit API Key
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusApiKey" data-id="<?php echo "$id_api_key"; ?>">
                                <i class="bi bi-x"></i> Hapus API Key
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailApiKey" data-id="<?php echo "$id_api_key"; ?>">
                        <b><?php echo "$no. $nama"; ?></b>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <i class="bi bi-envelope"></i> <code class="text-grayish"><?php echo "$email"; ?></code>
                        </div>
                        <div class="col-md-2">
                            <i class="bi bi-calendar"></i> <code class="text-grayish"><?php echo "$datetime_api_key"; ?></code><br>
                        </div>
                        <div class="col-md-4">
                            <i class="bi bi-key"></i> <code class="text-grayish"><?php echo "$api_key"; ?></code>
                        </div>
                        <div class="col-md-2">
                            <i class="bi bi-tag"></i> <?php echo "$LabelStatus"; ?>
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
<div class="row mt-3">
    <div class="col-md-12 text-center">
        <div class="btn-group shadow-0" role="group" aria-label="Basic example">
            <button class="btn btn-sm btn-info" id="PrevPage" value="<?php echo $prev;?>">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-sm btn-outline-info">
                <?php echo "$page Of $JmlHalaman";?>
            </button>
            <button class="btn btn-sm btn-info" id="NextPage" value="<?php echo $next;?>">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
</div>