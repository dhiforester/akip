<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    date_default_timezone_set("Asia/Jakarta");
    if(empty($_POST['id_wilayah'])){
        echo '<div class="row mb-3">';
        echo '   <div class="col col-md-12 text-center text-danger">';
        echo '      ID Wilayah Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        //keyword
        $id_wilayah=$_POST['id_wilayah'];
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
        $ShortBy="ASC";
        //OrderBy
        $OrderBy="kode";
        //Atur Page
        if(!empty($_POST['page'])){
            $page=$_POST['page'];
            $posisi = ( $page - 1 ) * $batas;
        }else{
            $page="1";
            $posisi = 0;
        }
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah'"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE (id_wilayah='$id_wilayah') AND (nama like '%$keyword%')"));
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
            var id_wilayah="<?php echo "$id_wilayah"; ?>";
            var batas="<?php echo "$batas"; ?>";
            var keyword="<?php echo "$keyword"; ?>";
            $.ajax({
                url     : '_Page/BidangKegiatan/TabelBidangByKabupaten.php',
                method  : "POST",
                data 	:  { page: page, batas: batas, keyword: keyword, id_wilayah: id_wilayah },
                success: function (data) {
                    $('#TabelBidangByKabupaten').html(data);
                    $('#PutPage').val(page);
                }
            })
        });
        //Ketika klik Previous
        $('#PrevPage').click(function() {
            var page = $('#PrevPage').val();
            var id_wilayah="<?php echo "$id_wilayah"; ?>";
            var batas="<?php echo "$batas"; ?>";
            var keyword="<?php echo "$keyword"; ?>";
            $.ajax({
                url     : '_Page/BidangKegiatan/TabelBidangByKabupaten.php',
                method  : "POST",
                data 	:  { page: page,batas: batas, keyword: keyword, id_wilayah: id_wilayah },
                success : function (data) {
                    $('#TabelBidangByKabupaten').html(data);
                    $('#PutPage').val(page);
                }
            })
        });
    </script>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg bg-black">
                        <tr>
                            <th><b class="text-light">Kode</b></th>
                            <th><b class="text-light">Bidang, Sub Bidang, Kegiatan</b></th>
                            <th><b class="text-light">Option</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(empty($jml_data)){
                                echo '<tr>';
                                echo '  <td colspan="3" class="text-center">';
                                echo '      Tidak Ada Data Bidang Yang Ditemukan';
                                echo '  </td>';
                                echo '</tr>';
                            }else{
                                $no = 1+$posisi;
                                //KONDISI PENGATURAN MASING FILTER
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE (id_wilayah='$id_wilayah') AND (nama like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                                while ($data = mysqli_fetch_array($query)) {
                                    $id_bidang_kegiatan= $data['id_bidang_kegiatan'];
                                    $kode= $data['kode'];
                                    $nama= $data['nama'];
                                    $level= $data['level'];
                        ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if($level=="Bidang"){
                                                    echo '<b>'.$kode.'</b>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        echo ''.$kode.'';
                                                    }else{
                                                        echo '<code class="text text-grayish">'.$kode.'</code>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($level=="Bidang"){
                                                    echo '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailBidang" data-id="'.$id_bidang_kegiatan.'" class="text-dark"><b>'.$nama.'</b></a>';
                                                }else{
                                                    if($level=="Sub Bidang"){
                                                        echo '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailBidang" data-id="'.$id_bidang_kegiatan.'" class="text-dark">'.$nama.'</a>';
                                                    }else{
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailBidang" data-id="'.$id_bidang_kegiatan.'" class="text-dark"><code class="text text-grayish">'.$nama.'</code></a>';
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-dark" title="Edit Parameter" data-bs-toggle="modal" data-bs-target="#ModalEditBidang" data-id="<?php echo $id_bidang_kegiatan; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-dark" title="Hapus Parameter" data-bs-toggle="modal" data-bs-target="#ModalHapusBidang" data-id="<?php echo $id_bidang_kegiatan; ?>">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                    $no++; 
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
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
<?php } ?>