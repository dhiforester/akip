<?php
    //Menghitung jumlah Akses
    $JumlahAkses= mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses"));
    //Jumlah Opd
    $JumlahOpd = mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd"));
    //Jumlah Periode
    $JumlahPeriode = mysqli_num_rows(mysqli_query($Conn, "SELECT id_evaluasi_periode FROM evaluasi_periode"));
    //Jumlah Kompoonen
    $JumlahKomponen = mysqli_num_rows(mysqli_query($Conn, "SELECT id_komponen FROM komponen"));
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-secondary">
                                    <i class="bi bi-person-circle text-white"></i>
                                </div>
                                <div class="ps-3">
                                    <h4><?php echo $JumlahAkses;?></h4>
                                    <span class="text text-grayish small pt-1">User</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary">
                                    <i class="bi bi-calendar text-white"></i>
                                </div>
                                <div class="ps-3">
                                    <h4><?php echo $JumlahPeriode;?></h4>
                                    <span class="text text-grayish small pt-1">Periode Evaluasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning">
                                    <i class="bi bi-bag-check text-white"></i>
                                </div>
                                <div class="ps-3">
                                    <h4><?php echo $JumlahOpd;?></h4>
                                    <span class="text text-grayish small pt-1">OPD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info">
                                    <i class="bi bi-cart text-white"></i>
                                </div>
                                <div class="ps-3">
                                    <h4><?php echo $JumlahKomponen;?></h4>
                                    <span class="text text-grayish small pt-1">Komponen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" id="GrafikPendaftaranMember">
                    <!-- Line Chart Ditampilkan Disini-->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Log<span>| Aktivitas Terbaru</span></h5>
                    <div class="activity">
                        <?php
                            $JumlahLog = mysqli_num_rows(mysqli_query($Conn, "SELECT id_log FROM log"));
                            if(empty($JumlahLog)){
                                echo '<div class="activity-item d-flex">';
                                echo '  Belum Ada Aktivitas';
                                echo '</div>';
                            }else{
                                //Arraykan Pendaftaran Member
                                $QryLog = mysqli_query($Conn, "SELECT * FROM log ORDER BY datetime_log DESC LIMIT 5");
                                while ($DataLog = mysqli_fetch_array($QryLog)) {
                                    $datetime_log= $DataLog['datetime_log'];
                                    $kategori_log= $DataLog['kategori_log'];
                                    $strtotime= strtotime($datetime_log);
                                    $TanggalFormat=date('d/m/y H:i', $strtotime);
                                    echo '<div class="activity-item d-flex">';
                                    // echo '  <div class="activite-label">'.$WaktuLog.'</div>';
                                    echo '  <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                    echo '  <div class="activity-content">';
                                    echo '      <b>'.$kategori_log.'</b><br><small class="text text-grayish"><i class="bi bi-calendar"></i> '.$TanggalFormat.'</small>';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div> -->
</section>