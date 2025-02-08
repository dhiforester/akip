<?php
    // Tahun Sekarang
    $tahun_ini=date('Y');
    //Nama Kabupaten
    $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SettingIdWilayahUtama,'kabupaten');
    $IdEvaluasi=getDataDetail($Conn,'evaluasi','periode',$tahun_ini,'id_evaluasi');
    $id_evaluasi=getDataDetail($Conn,'evaluasi','periode',$tahun_ini,'id_evaluasi');
    //Menghitung Jumlah
    $JumlahKecamatan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='Kecamatan'"));
    $JumlahDesa = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='desa'"));
    $JumlahPengguna = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
    //Miskin
    $SqlTargetMiskin = "SELECT SUM(capaian) AS jumlah_persen_miskin FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='Miskin' AND status='Valid'";
    $ResultMiskin = $Conn->query($SqlTargetMiskin);
    if ($ResultMiskin->num_rows > 0) {
        $RowMiskin = $ResultMiskin->fetch_assoc();
        $jumlah_persen_miskin=$RowMiskin['jumlah_persen_miskin'];
    } else {
        $jumlah_persen_miskin=0;
    }
    $JumlahDesaMiskin = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='Miskin' AND status='Valid'"));
    if(!empty($JumlahDesaMiskin)){
        $RataRataPersenMiskin=($jumlah_persen_miskin/$JumlahDesaMiskin);
    }else{
        $RataRataPersenMiskin=0;
    }
    $RataRataPersenMiskin=round($RataRataPersenMiskin,2);
    //Stunting
    $SqlTargetStunting = "SELECT SUM(capaian) AS jumlah_persen_stunting FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='Stunting' AND status='Valid'";
    $ResultStunting = $Conn->query($SqlTargetStunting);
    if ($ResultStunting->num_rows > 0) {
        $RowStunting = $ResultStunting->fetch_assoc();
        $jumlah_persen_stunting=$RowStunting['jumlah_persen_stunting'];
    } else {
        $jumlah_persen_stunting=0;
    }
    $JumlahDesaStunting = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='Stunting' AND status='Valid'"));
    if(!empty($JumlahDesaStunting)){
        $RataRataPersenStunting=($jumlah_persen_stunting/$JumlahDesaStunting);
    }else{
        $RataRataPersenStunting=0;
    }
    $RataRataPersenStunting=round($RataRataPersenStunting,2);
    //IKM
    $SqlIkm = "SELECT SUM(capaian) AS jumlah_ikm FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='IKM' AND status='Valid'";
    $ResultIkm = $Conn->query($SqlIkm);
    if ($ResultIkm->num_rows > 0) {
        $RowIkm = $ResultIkm->fetch_assoc();
        $jumlah_ikm=$RowIkm['jumlah_ikm'];
    } else {
        $jumlah_ikm=0;
    }
    $JumlahDesaIkm = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='IKM' AND status='Valid'"));
    if(!empty($JumlahDesaIkm)){
        $RataRataPersenIkm=($jumlah_ikm/$JumlahDesaIkm);
    }else{
        $RataRataPersenIkm=0;
    }
    $RataRataPersenIkm=round($RataRataPersenIkm,2);
    //IDM
    $SqlIdm = "SELECT SUM(capaian) AS jumlah_idm FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='IDM' AND status='Valid'";
    $ResultIdm = $Conn->query($SqlIdm);
    if ($ResultIdm->num_rows > 0) {
        $RowIdm = $ResultIdm->fetch_assoc();
        $jumlah_idm=$RowIdm['jumlah_idm'];
    } else {
        $jumlah_idm=0;
    }
    $JumlahDesaIdm = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM capaian WHERE kabupaten='$NamaKabupaten' AND id_evaluasi='$id_evaluasi' AND indikator='IDM' AND status='Valid'"));
    if(!empty($JumlahDesaIdm)){
        $RataRataPersenIdm=($jumlah_idm/$JumlahDesaIdm);
    }else{
        $RataRataPersenIdm=0;
    }
    $RataRataPersenIdm=round($RataRataPersenIdm,2);
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 border-1 border-right">
                                    <h5 class="card-title">
                                        <i class="bi bi-grid-3x3"></i>
                                        Kecamatan <br><span><?php echo "$JumlahKecamatan";?> Record</span>
                                    </h5>
                                </div>
                                <div class="col-md-4 border-1 border-right">
                                    <h5 class="card-title">
                                        <i class="bi bi-grid-3x3-gap"></i> 
                                        Desa/Kelurahan <br><span><?php echo "$JumlahDesa";?> Record</span>
                                    </h5>
                                </div>
                                <div class="col-md-4 border-1 border-right">
                                    <h5 class="card-title">
                                        <i class="bi bi-people-fill"></i>
                                        Pengguna <br><span><?php echo "$JumlahPengguna";?> Record</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="assets/img/card/6.png" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-light">Capaian KK Miskin</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light bg-danger">
                                    <i class="bi bi-grid-3x3"></i>
                                </div>
                                <div class="ps-3" class="text-light">
                                    <h3 class="text-light">
                                        <?php echo "$RataRataPersenMiskin %";?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartKkMiskin">
                        
                        </div>
                        <div class="card-footer">
                            <small>
                                <code class="text text-grayish">
                                    Update : <?php echo date('d/m/Y'); ?>
                                </code>
                            </small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartKkMiskin"), {
                                        series: [<?php echo $RataRataPersenMiskin; ?>],
                                        chart: {
                                            type: 'radialBar',
                                            height: 300,
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        plotOptions: {
                                            radialBar: {
                                                dataLabels: {
                                                    name: {
                                                        fontSize: '22px',
                                                    },
                                                    value: {
                                                        fontSize: '16px',
                                                    },
                                                    total: {
                                                        show: true,
                                                        label: 'Capaian',
                                                        formatter: function (w) {
                                                            return <?php echo "$RataRataPersenMiskin"; ?>
                                                        }
                                                    }
                                                }
                                            }
                                        },
                                        labels: ['Capaian'],
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="assets/img/card/11.png" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-light">Capaian Stunting</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light bg-success">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </div>
                                <div class="ps-3" class="text-light">
                                    <h3 class="text-light">
                                        <?php echo "$RataRataPersenStunting %";?>
                                    </h3>
                                    <!-- <span class="text text-white">Record</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartStunting">
                        
                        </div>
                        <div class="card-footer">
                            <small>
                                <code class="text text-grayish">
                                    Update : <?php echo date('d/m/Y'); ?>
                                </code>
                            </small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartStunting"), {
                                    series: [<?php echo $RataRataPersenStunting; ?>],
                                    chart: {
                                        type: 'radialBar',
                                        height: 300,
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '22px',
                                                },
                                                value: {
                                                    fontSize: '16px',
                                                },
                                                total: {
                                                    show: true,
                                                    label: 'Capaian',
                                                    formatter: function (w) {
                                                        return <?php echo "$RataRataPersenStunting"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian'],
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="assets/img/card/1.png" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-light">IKM</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light bg-info">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <div class="ps-3" class="text-light">
                                    <h3 class="text-light"><?php echo "$RataRataPersenIkm %";?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartCapaianIkm">
                        
                        </div>
                        <div class="card-footer">
                            <small>
                                <code class="text text-grayish">
                                    Update : <?php echo date('d/m/Y'); ?>
                                </code>
                            </small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartCapaianIkm"), {
                                    series: [<?php echo $RataRataPersenIkm; ?>],
                                    chart: {
                                        type: 'radialBar',
                                        height: 300,
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '22px',
                                                },
                                                value: {
                                                    fontSize: '16px',
                                                },
                                                total: {
                                                    show: true,
                                                    label: 'Capaian',
                                                    formatter: function (w) {
                                                        return <?php echo "$RataRataPersenIkm"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian'],
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="assets/img/card/4.png" class="card-img-top" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title text-light">IDM</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-light bg-warning">
                                    <i class="bi bi-grid-3x3"></i>
                                </div>
                                <div class="ps-3" class="text-light">
                                    <h3 class="text-light"><?php echo "$RataRataPersenIdm %";?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartCapaianIdm">
                        
                        </div>
                        <div class="card-footer">
                            <small>
                                <code class="text text-grayish">
                                    Update : <?php echo date('d/m/Y'); ?>
                                </code>
                            </small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartCapaianIdm"), {
                                    series: [<?php echo $RataRataPersenIdm; ?>],
                                    chart: {
                                        type: 'radialBar',
                                        height: 300,
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    plotOptions: {
                                        radialBar: {
                                            dataLabels: {
                                                name: {
                                                    fontSize: '22px',
                                                },
                                                value: {
                                                    fontSize: '16px',
                                                },
                                                total: {
                                                    show: true,
                                                    label: 'Capaian',
                                                    formatter: function (w) {
                                                        return <?php echo "$RataRataPersenIdm"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian'],
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">Evaluasi Implementasi SAKIP</b>
                        </div>
                        <div id="DaftarSakipDesa">
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>