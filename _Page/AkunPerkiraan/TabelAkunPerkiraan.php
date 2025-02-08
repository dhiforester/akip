<?php
    //koneksi dan session
    ini_set("display_errors","off");
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
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
        $ShortBy="ASC";
        $NextShort="DESC";
    }
    //OrderBy
    if(!empty($_POST['OrderBy'])){
        $OrderBy=$_POST['OrderBy'];
    }else{
        $OrderBy="kode";
    }
    //Atur Page
    if(!empty($_POST['page'])){
        $page=$_POST['page'];
        $posisi = ( $page - 1 ) * $batas;
    }else{
        $page="1";
        $posisi = 0;
    }
    if($SessionAkses=="Admin"){
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akun_perkiraan"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akun_perkiraan WHERE nama like '%$keyword%' OR saldo_normal like '%$keyword%'"));
        }
    }else{
        if(empty($keyword)){
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akun_perkiraan WHERE (id_mitra='$SessionIdMitra' OR id_mitra='' OR id_mitra='0')"));
        }else{
            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akun_perkiraan  WHERE (id_mitra='$SessionIdMitra' OR id_mitra='' OR id_mitra='0') AND (nama like '%$keyword%' OR saldo_normal like '%$keyword%')"));
        }
    }
?>
<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext=$('#NextPage').val();
        var batas="<?php echo $batas;?>";
        var keyword="<?php echo $keyword;?>";
        $('#MenampilkanTabelAkunPerkiraan').html('Loading..');
        $.ajax({
            url     : "_Page/AkunPerkiraan/TabelAkunPerkiraan.php",
            method  : "POST",
            data 	:  { page: valueNext, batas: batas, keyword: keyword },
            success: function (data) {
                $('#MenampilkanTabelAkunPerkiraan').html(data);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas="<?php echo $batas;?>";
        var keyword="<?php echo $keyword;?>";
        $('#MenampilkanTabelAkunPerkiraan').html('Loading..');
        $.ajax({
            url     : "_Page/AkunPerkiraan/TabelAkunPerkiraan.php",
            method  : "POST",
            data 	:  { page: ValuePrev,batas: batas, keyword: keyword },
            success : function (data) {
                $('#MenampilkanTabelAkunPerkiraan').html(data);
            }
        })
    });
    <?php 
        $JmlHalaman =ceil($jml_data/$batas); 
        $a=1;
        $b=$JmlHalaman;
        for ( $i =$a; $i<=$b; $i++ ){
    ?>
        //ketika klik page number
        $('#PageNumber<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i;?>').val();
            var batas="<?php echo $batas;?>";
            var keyword="<?php echo $keyword;?>";
            $('#MenampilkanTabelAkunPerkiraan').html('Loading..');
            $.ajax({
                url     : "_Page/AkunPerkiraan/TabelAkunPerkiraan.php",
                method  : "POST",
                data 	:  { page: PageNumber, batas: batas, keyword: keyword },
                success: function (data) {
                    $('#MenampilkanTabelAkunPerkiraan').html(data);
                }
            })
        });
    <?php } ?>
    //Tambah Akun Perkiraan
    $('#ModalTambahAkunPerkiraan').on('show.bs.modal', function (e) {
        var id_perkiraan = $(e.relatedTarget).data('id');
        $('#FormTambahAkunPerkiraan').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/AkunPerkiraan/FormTambahAkunPerkiraan.php',
            data        : {id_perkiraan: id_perkiraan},
            success     : function(data){
                $('#FormTambahAkunPerkiraan').html(data);
                //Proses Tambah Akun perkiraan
                $('#ProsesTambahAkunPerkiraan').submit(function(){
                    $('#NotifikasiTambahAkunPerkiraan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                    var form = $('#ProsesTambahAkunPerkiraan')[0];
                    var data = new FormData(form);
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/AkunPerkiraan/ProsesTambahAkunPerkiraan.php',
                        data 	    :  data,
                        cache       : false,
                        processData : false,
                        contentType : false,
                        enctype     : 'multipart/form-data',
                        success     : function(data){
                            $('#NotifikasiTambahAkunPerkiraan').html(data);
                            var NotifikasiTambahAkunPerkiraanBerhasil=$('#NotifikasiTambahAkunPerkiraanBerhasil').html();
                            if(NotifikasiTambahAkunPerkiraanBerhasil=="Success"){
                                $('#MenampilkanTabelAkunPerkiraan').html('Loading..');
                                $('#ModalTambahAkunPerkiraan').modal('toggle');
                                var batas=$('#batas').val();
                                var keyword=$('#keyword').val();
                                var GetPage=$('#GetPage').val();
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/AkunPerkiraan/TabelAkunPerkiraan.php',
                                    data 	    :  {keyword: keyword, batas: batas, page: GetPage},
                                    success     : function(data){
                                        $('#MenampilkanTabelAkunPerkiraan').html(data);
                                        $('#ModalDeleteAkunPerkiraan').modal('hide');
                                        swal("Good Job!", "Tambah Akun Perkiraan Berhasil!", "success");
                                    }
                                });
                            }
                        }
                    });
                });
            }
        });
    });
</script>
<input type="hidden" name="GetPage" id="GetPage" value="<?php echo "$page";?>">
<div class="card-body">
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><b class="sub-title">No</b></th>
                            <th><b class="sub-title">Kode Akun Perkiraan</b></th>
                            <th><b class="sub-title">Mitra</b></th>
                            <th><b class="sub-title">Level</b></th>
                            <th><b class="sub-title">Saldo Normal</b></th>
                            <th><b class="sub-title">Status</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1+$posisi;
                            //KONDISI PENGATURAN MASING FILTER
                            if($SessionAkses=="Admin"){
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM akun_perkiraan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM akun_perkiraan WHERE nama like '%$keyword%' OR saldo_normal like '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }else{
                                if(empty($keyword)){
                                    $query = mysqli_query($Conn, "SELECT*FROM akun_perkiraan WHERE (id_mitra='$SessionIdMitra' OR id_mitra='' OR id_mitra='0') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }else{
                                    $query = mysqli_query($Conn, "SELECT*FROM akun_perkiraan WHERE (id_mitra='$SessionIdMitra' OR id_mitra='' OR id_mitra='0') AND (nama like '%$keyword%' OR saldo_normal like '%$keyword%') ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                                }
                            }
                            while ($data = mysqli_fetch_array($query)) {
                                $id_perkiraan = $data['id_perkiraan'];
                                if(empty($data['id_mitra'])){
                                    $id_mitra ="";
                                    $NamaMitra ='<i class="text-danger">General</i>';
                                }else{
                                    $id_mitra = $data['id_mitra'];
                                    //Buka nama mitra
                                    $QryMitra = mysqli_query($Conn,"SELECT * FROM mitra WHERE id_mitra='$id_mitra'")or die(mysqli_error($Conn));
                                    $DataMitra = mysqli_fetch_array($QryMitra);
                                    $NamaMitra= $DataMitra['nama_mitra'];
                                }
                                $kode_perkiraan = $data['kode'];
                                $nama_perkiraan = $data['nama'];
                                $level_perkiraan= $data['level'];
                                $saldo_normal= $data['saldo_normal'];
                                $status= $data['status'];
                                //WARNA TEXT
                                if($saldo_normal=='Kredit'){
                                    $LabelSaldo="<b class='text-danger'>$saldo_normal</b>";
                                }else{
                                    $LabelSaldo="<b class='text-info'>$saldo_normal</b>";
                                }
                                //Label Status
                                if($status==''){
                                    $LabelStatus="<small class=''>None</small>";
                                }else{
                                    if($status=='Closed'){
                                        $LabelStatus="<small class='text-success'><i class='ti-lock'></i> Closed</small>";
                                    }else{
                                        $LabelStatus="<small class='text-info'><i class='ti-unlock'></i> Open</small>";
                                    }
                                }
                                //menghitung jumlah anak
                                if($level_perkiraan=='1'){
                                    $jml_anak_akun="2";
                                }else{
                                    $jml_anak_akun = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM akun_perkiraan WHERE kd$level_perkiraan='$kode_perkiraan' AND level>'$level_perkiraan'"));
                                }
                                //Mengatur warna tabel
                                if($level_perkiraan=="1"){
                                    $ClassTabel="table-primary";
                                }else{
                                    if($level_perkiraan=="2"){
                                        $ClassTabel="table-info";
                                    }else{
                                        if($level_perkiraan=="3"){
                                            $ClassTabel="table-secondary";
                                        }else{
                                            $ClassTabel="table-light";
                                        }
                                    }
                                }

                            ?>
                                <tr tabindex="0" class="table-light" data-bs-toggle="modal" data-bs-target="#ModalDetailAkunPerkiraan" data-id="<?php echo "$id_perkiraan";?>" onmousemove="this.style.cursor='pointer'">
                                    <td><?php echo "<small>$no</small>";?></td>    
                                    <td class="" align="left">
                                        <small>
                                            <?php 
                                                for ( $i = 1; $i<= $level_perkiraan; $i++ ){
                                                    echo "&emsp;";
                                                }
                                                if(empty($jml_anak_akun)){
                                                    echo "$kode_perkiraan - ";
                                                }else{
                                                    echo "<b>$kode_perkiraan - </b>";
                                                }
                                            ?>
                                            <?php 
                                                // for ( $i = 1; $i<= $level_perkiraan; $i++ ){
                                                //     echo "&emsp;";
                                                // }
                                                if(empty($jml_anak_akun)){
                                                    echo "$nama_perkiraan";
                                                }else{
                                                    echo "<b>$nama_perkiraan</b>";
                                                }
                                            ?>
                                        </small>
                                    </td>
                                    <td class="text-left" align="left">
                                        <small>
                                            <?php
                                                if(empty($jml_anak_akun)){
                                                    echo "<i>$NamaMitra</i>";
                                                }else{
                                                    echo "<i><b>$NamaMitra</b></i>";
                                                }
                                            ?>
                                        </small>
                                    </td>
                                    <td class="text-left" align="left"><small><?php echo "$level_perkiraan";?></small></td>
                                    <td class="text-left" align="left"><small><?php echo "$LabelSaldo";?></small></td>
                                    <td class="text-left" align="left"><small><?php echo "$LabelStatus";?></small></td>
                                </tr>
                        <?php
                            $no++; }
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<div class="card-footer text-center">
    <div class="btn-group shadow-0" role="group" aria-label="Basic example">
        <?php
            //Mengatur Halaman
            $JmlHalaman = ceil($jml_data/$batas); 
            $JmlHalaman_real = ceil($jml_data/$batas); 
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
        <button class="btn btn-sm btn-outline-info" id="PrevPage" value="<?php echo $prev;?>">
            <span aria-hidden="true">«</span>
        </button>
        <?php 
            //Navigasi nomor
            if($JmlHalaman>3){
                if($page>=2){
                    $a=$page-1;
                    $b=$page+1;
                    if($JmlHalaman<=$b){
                        $a=$page-1;
                        $b=$JmlHalaman;
                    }
                }else{
                    $a=1;
                    $b=$page+1;
                    if($JmlHalaman<=$b){
                        $a=1;
                        $b=$JmlHalaman;
                    }
                }
            }else{
                $a=1;
                $b=$JmlHalaman;
            }
            for ( $i =$a; $i<=$b; $i++ ){
                if($page=="$i"){
                    echo '<button class="btn btn-sm btn-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }else{
                    echo '<button class="btn btn-sm btn-outline-info" id="PageNumber'.$i.'" value="'.$i.'"><span aria-hidden="true">'.$i.'</span></button>';
                }
            }
        ?>
        <button class="btn btn-sm btn-outline-info" id="NextPage" value="<?php echo $next;?>">
            <span aria-hidden="true">»</span>
        </button>
    </div>
</div>