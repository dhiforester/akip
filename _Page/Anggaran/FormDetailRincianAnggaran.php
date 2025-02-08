<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_anggaran_rincian
    if(empty($_POST['id_anggaran_rincian'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Anggaran Rincian Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_anggaran_rincian=$_POST['id_anggaran_rincian'];
        $id_anggaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'id_anggaran');
        $tahun=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'tahun');
        //Mencari Nama Bidang
        $kode_bidang=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'kode_bidang');
        $QryBidang = mysqli_query($Conn,"SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND level='Bidang' AND kode_bidang='$kode_bidang'")or die(mysqli_error($Conn));
        $DataBidang = mysqli_fetch_array($QryBidang);
        $KodeBidang=$DataBidang['kode'];
        $NamaBidang=$DataBidang['nama'];
        //Mencari Sub Bidang
        $kode_sub_bidang=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'kode_sub_bidang');
        $QrySubBidang = mysqli_query($Conn,"SELECT * FROM anggaran_rincian WHERE id_anggaran='$id_anggaran' AND level='Sub Bidang' AND kode_sub_bidang='$kode_sub_bidang'")or die(mysqli_error($Conn));
        $DataSubBidang = mysqli_fetch_array($QrySubBidang);
        $KodeSubBidang=$DataSubBidang['kode'];
        $NamaSubBidang=$DataSubBidang['nama'];
        //Kegiatan
        $kode_kegiatan=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'kode_kegiatan');
        $kode=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'kode');
        $nama=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'nama');
        $sasaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'sasaran');
        $volume=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'volume');
        $satuan=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'satuan');
        $anggaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'anggaran');
        $durasi=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'durasi');
        //Format Rupiah
        if(empty($anggaran)){
            $anggaran="0";
        }
        $rupiahAnggaran = "Rp " . number_format($anggaran, 2, ',', '.');
?>
    <div class="row mb-3">
        <div class="col-md-4">
            Tahun Anggaran
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$tahun"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Bidang
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$KodeBidang. $NamaBidang"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Sub Bidang
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$KodeSubBidang. $NamaSubBidang"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Kegiatan
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$kode. $nama"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Sasaran Kegiatan
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$sasaran"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Volume
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$volume $satuan"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Anggaran
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$rupiahAnggaran"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            Lama Pengerjaan
        </div>
        <div class="col-md-8">
            <small class="credit text text-grayish">
                <?php echo "$durasi"; ?>
            </small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="index.php?Page=Anggaran&Sub=DetailAnggaranRincian&id=<?php echo "$id_anggaran_rincian"; ?>" class="btn btn-md btn-outline-info btn-block">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
<?php 
    }

?>