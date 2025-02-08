<?php
    // Tahun Sekarang
    $tahun_ini=date('Y');
    //Nama Kabupaten
    $NamaKabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SettingIdWilayahUtama,'kabupaten');
    $IdEvaluasi=getDataDetail($Conn,'evaluasi','periode',$tahun_ini,'id_evaluasi');
    //Menghitung Jumlah
    $JumlahKecamatan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='Kecamatan'"));
    $JumlahDesa = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='desa'"));
    $JumlahPengguna = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses"));
    //Looping Desa By Kabupaten
    $JumlahTotalDesa=0;
    $JumlahTotalPersenMiskin=0;
    $JumlahTotalStunting=0;
    $JumlahTotalIkm=0;
    $JumlahTotalIdm=0;
    $QryDesa = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kabupaten='$NamaKabupaten' AND kategori='desa'");
    while ($DataDesa = mysqli_fetch_array($QryDesa)) {
        $id_wilayah_desa=$DataDesa['id_wilayah'];
        //KK Miskin
        $SqlTargetMiskin = "SELECT SUM(persen_miskin) AS jumlah_persen_miskin FROM target_capaian WHERE id_wilayah='$id_wilayah_desa' AND periode='$tahun_ini'";
        $ResultMiskin = $Conn->query($SqlTargetMiskin);
        // Periksa apakah hasil kueri tersedia
        if ($ResultMiskin->num_rows > 0) {
            $RowMiskin = $ResultMiskin->fetch_assoc();
            $jumlah_persen_miskin=$RowMiskin['jumlah_persen_miskin'];
            $JumlahTotalPersenMiskin=$JumlahTotalPersenMiskin+$jumlah_persen_miskin;
        } else {
            $jumlah_persen_miskin=0;
            $JumlahTotalPersenMiskin=$JumlahTotalPersenMiskin+$jumlah_persen_miskin;
        }
        $JumlahDesaTerhitung = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM target_capaian WHERE id_wilayah='$id_wilayah_desa' AND periode='$tahun_ini'"));
        $JumlahTotalDesa=$JumlahTotalDesa+$JumlahDesaTerhitung;
        //Stunting
        $SqlTargetStunting = "SELECT SUM(persen_stunting) AS jumlah_persen_stunting FROM target_capaian WHERE id_wilayah='$id_wilayah_desa' AND periode='$tahun_ini'";
        $ResulktStunting = $Conn->query($SqlTargetStunting);
        // Periksa apakah hasil kueri tersedia
        if ($ResulktStunting->num_rows > 0) {
            $BarisStunting = $ResulktStunting->fetch_assoc();
            $jumlah_persen_stunting=$BarisStunting['jumlah_persen_stunting'];
            $JumlahTotalStunting=$JumlahTotalStunting+$jumlah_persen_stunting;
        } else {
            $jumlah_persen_stunting=0;
            $JumlahTotalStunting=$JumlahTotalStunting+$jumlah_persen_miskin;
        }
        //IKM
        $SqlIkm = "SELECT SUM(persen_ikm) AS jumlah_persen_ikm FROM target_capaian WHERE id_wilayah='$id_wilayah_desa' AND periode='$tahun_ini'";
        $ResultIkm = $Conn->query($SqlIkm);
        // Periksa apakah hasil kueri tersedia
        if ($ResultIkm->num_rows > 0) {
            $BarisIkm = $ResultIkm->fetch_assoc();
            $jumlah_persen_ikm=$BarisIkm['jumlah_persen_ikm'];
            $JumlahTotalIkm=$JumlahTotalIkm+$jumlah_persen_ikm;
        } else {
            $jumlah_persen_ikm=0;
            $JumlahTotalIkm=$JumlahTotalIkm+$jumlah_persen_ikm;
        }
        //IDM
        $SqlIdm = "SELECT SUM(persen_idm) AS jumlah_persen_idm FROM target_capaian WHERE id_wilayah='$id_wilayah_desa' AND periode='$tahun_ini'";
        $ResultIdm = $Conn->query($SqlIdm);
        // Periksa apakah hasil kueri tersedia
        if ($ResultIdm->num_rows > 0) {
            $BarisIdm = $ResultIdm->fetch_assoc();
            $jumlah_persen_idm=$BarisIdm['jumlah_persen_idm'];
            $JumlahTotalIdm=$JumlahTotalIdm+$jumlah_persen_idm;
        } else {
            $jumlah_persen_idm=0;
            $JumlahTotalIdm=$JumlahTotalIdm+$jumlah_persen_idm;
        }
    }
    //Miskon
    $RataRataPersenMiskin=($JumlahTotalPersenMiskin/$JumlahTotalDesa);
    $RataRataPersenMiskin=round($RataRataPersenMiskin,2);
    //Stunting
    $RataRataPersenStunting=($JumlahTotalStunting/$JumlahTotalDesa);
    $RataRataPersenStunting=round($RataRataPersenStunting,2);
    //IKM
    $RataRataPersenIkm=($JumlahTotalIkm/$JumlahTotalDesa);
    $RataRataPersenIkm=round($RataRataPersenIkm,2);
    //Sisa
    $SisaMiskin=100-$JumlahTotalPersenMiskin;
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
                                    <!-- <span class="text text-white">
                                        Total Persen : <?php echo $JumlahTotalPersenMiskin; ?>
                                        Jumlah Desa : <?php echo $JumlahDesaMiskin; ?>
                                    </span> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartKkMiskin">
                        
                        </div>
                        <div class="card-footer">
                            <small>Update : <?php echo date('d/m/Y H:i T'); ?></small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartKkMiskin"), {
                                        series: [<?php echo $JumlahTotalPersenMiskin; ?>, <?php echo $SisaMiskin;?>],
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
                                                        label: 'Total',
                                                        formatter: function (w) {
                                                            return <?php echo "$JumlahTotalPersenMiskin"; ?>
                                                        }
                                                    }
                                                }
                                            }
                                        },
                                        labels: ['Capaian', 'Target',],
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
                            <small>Update : <?php echo date('d/m/Y H:i T'); ?></small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartStunting"), {
                                    series: [<?php echo $RataRataPersenStunting; ?>, <?php echo 100-$RataRataPersenStunting;?>],
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
                                                    label: 'Total',
                                                    formatter: function (w) {
                                                        return <?php echo "$RataRataPersenStunting"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian', 'Target',],
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
                            <small>Update : <?php echo date('d/m/Y H:i T'); ?></small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartCapaianIkm"), {
                                    series: [<?php echo $RataRataPersenIkm; ?>, <?php echo 100-$RataRataPersenIkm;?>],
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
                                                    label: 'Total',
                                                    formatter: function (w) {
                                                        return <?php echo "$RataRataPersenIkm"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian', 'Target',],
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
                                    <h3 class="text-light"><?php echo "$JumlahTotalIdm %";?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="ChartCapaianIdm">
                        
                        </div>
                        <div class="card-footer">
                            <small>Update : <?php echo date('d/m/Y H:i T'); ?></small>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#ChartCapaianIdm"), {
                                    series: [<?php echo $JumlahTotalIdm; ?>, <?php echo 100-$JumlahTotalIdm;?>],
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
                                                    label: 'Total',
                                                    formatter: function (w) {
                                                        return <?php echo "$JumlahTotalIdm"; ?>
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    labels: ['Capaian', 'Target',],
                                    }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Evaluasi Implementasi SAKIP</h5>
                            <div class="activity" id="barChart">
                                <!-- Data Chart Disini -->
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                    series: [{
                                        name: 'Persentase',
                                        data: [
                                            <?php
                                                //Menampilkan Data Evaluasi
                                                $QryEvaluasi = mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE status='selesai' AND id_evaluasi='$IdEvaluasi' ORDER BY skor DESC LIMIT 10");
                                                while ($DataEvaluasi = mysqli_fetch_array($QryEvaluasi)) {
                                                    $NilaiSkor= $DataEvaluasi['skor'];
                                                    echo '"'.$NilaiSkor.'", ';
                                                }
                                            ?>
                                        ]
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 400,
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 4,
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        categories: [
                                            <?php
                                                //Menampilkan Data Evaluasi
                                                $QryEvaluasi = mysqli_query($Conn, "SELECT*FROM evaluasi_rekap WHERE status='selesai' AND id_evaluasi='$IdEvaluasi' ORDER BY skor DESC LIMIT 10");
                                                while ($DataEvaluasi = mysqli_fetch_array($QryEvaluasi)) {
                                                    $IdWilayah= $DataEvaluasi['id_wilayah'];
                                                    //Nama Desa
                                                    $NamaPesertaEvaluasi=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayah,'desa');
                                                    echo '"'.$NamaPesertaEvaluasi.'", ';
                                                }
                                            ?>
                                        ],
                                    }
                                }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!-- Reports -->
                <div class="col-md-6">
                    <div class="card">
                        <!-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start"><h6>Filter</h6></li>
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div> -->
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Data Masuk <span>/ 7 hari Terakhir</span></h5>
                            <div id="reportsChart">
                                <!-- Line Chart -->
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#reportsChart"), {
                                    series: [{
                                        name: 'Log Admin',
                                        data: [
                                                    <?php
                                                        date_default_timezone_set('UTC');
                                                        //7 hari kebelakang
                                                        $time_sekarang = time();
                                                        $AwalMinggu0=strtotime("-7 days", $time_sekarang);
                                                        $AwalMinggu1=strtotime("-6 days", $time_sekarang);
                                                        $AwalMinggu2=strtotime("-5 days", $time_sekarang);
                                                        $AwalMinggu3=strtotime("-4 days", $time_sekarang);
                                                        $AwalMinggu4=strtotime("-3 days", $time_sekarang);
                                                        $AwalMinggu5=strtotime("-2 days", $time_sekarang);
                                                        $AwalMinggu6=strtotime("-1 days", $time_sekarang);
                                                        $AwalMinggu7=$time_sekarang;
                                                        //Label
                                                        $LabelMinggu0=date('Y-m-d', $AwalMinggu0);
                                                        $LabelMinggu1=date('Y-m-d', $AwalMinggu1);
                                                        $LabelMinggu2=date('Y-m-d', $AwalMinggu2);
                                                        $LabelMinggu3=date('Y-m-d', $AwalMinggu3);
                                                        $LabelMinggu4=date('Y-m-d', $AwalMinggu4);
                                                        $LabelMinggu5=date('Y-m-d', $AwalMinggu5);
                                                        $LabelMinggu6=date('Y-m-d', $AwalMinggu6);
                                                        $LabelMinggu7=date('Y-m-d', $AwalMinggu7);
                                                        
                                                        // $LabelMinggu0=strtotime($LabelMinggu0);
                                                        // $LabelMinggu1=strtotime($LabelMinggu1);
                                                        // $LabelMinggu2=strtotime($LabelMinggu2);
                                                        // $LabelMinggu3=strtotime($LabelMinggu3);
                                                        // $LabelMinggu4=strtotime($LabelMinggu4);
                                                        // $LabelMinggu5=strtotime($LabelMinggu5);
                                                        // $LabelMinggu6=strtotime($LabelMinggu6);
                                                        // $LabelMinggu7=strtotime($LabelMinggu7);
                                                        //Hitung jumlah log
                                                        $JumlahLog1 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu1%'"));
                                                        $JumlahLog2 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu2%'"));
                                                        $JumlahLog3 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu3%'"));
                                                        $JumlahLog4 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu4%'"));
                                                        $JumlahLog5 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu5%'"));
                                                        $JumlahLog6 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu6%'"));
                                                        $JumlahLog7 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM log WHERE datetime_log like '%$LabelMinggu7%'"));

                                                        echo ''.$JumlahLog1.', ';
                                                        echo ''.$JumlahLog2.', ';
                                                        echo ''.$JumlahLog3.', ';
                                                        echo ''.$JumlahLog4.', ';
                                                        echo ''.$JumlahLog5.', ';
                                                        echo ''.$JumlahLog6.', ';
                                                        echo ''.$JumlahLog7.' ';
                                                    ?>
                                                    // 31, 40, 28, 51, 42, 82, 90
                                                ],
                                            }, 
                                            // {
                                            //     name: 'Revenue',
                                            //     data: [11, 32, 45, 32, 34, 52, 41]
                                            // }, 
                                            // {
                                            //     name: 'Customers',
                                            //     data: [15, 11, 32, 18, 9, 24, 11]
                                            // }
                                        ],
                                    chart: {
                                    height: 400,
                                    type: 'bar',
                                    toolbar: {
                                        show: false
                                    },
                                    },
                                    markers: {
                                    size: 4
                                    },
                                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                    fill: {
                                    type: "gradient",
                                    gradient: {
                                        shadeIntensity: 1,
                                        opacityFrom: 0.3,
                                        opacityTo: 0.4,
                                        stops: [0, 90, 100]
                                    }
                                    },
                                    dataLabels: {
                                    enabled: false
                                    },
                                    stroke: {
                                    curve: 'smooth',
                                    width: 2
                                    },
                                    xaxis: {
                                    type: 'text',
                                    categories: [
                                        <?php
                                            //7 hari kebelakang
                                            $time_sekarang = time();
                                            $AwalMinggu1=strtotime("-6 days", $time_sekarang);
                                            $AwalMinggu2=strtotime("-5 days", $time_sekarang);
                                            $AwalMinggu3=strtotime("-4 days", $time_sekarang);
                                            $AwalMinggu4=strtotime("-3 days", $time_sekarang);
                                            $AwalMinggu5=strtotime("-2 days", $time_sekarang);
                                            $AwalMinggu6=strtotime("-1 days", $time_sekarang);
                                            $AwalMinggu7=$time_sekarang;
                                            //Label
                                            $LabelMinggu1=date('d F', $AwalMinggu1);
                                            $LabelMinggu2=date('d F', $AwalMinggu2);
                                            $LabelMinggu3=date('d F', $AwalMinggu3);
                                            $LabelMinggu4=date('d F', $AwalMinggu4);
                                            $LabelMinggu5=date('d F', $AwalMinggu5);
                                            $LabelMinggu6=date('d F', $AwalMinggu6);
                                            $LabelMinggu7=date('d F', $AwalMinggu7);
                                            echo '"'.$LabelMinggu1.'", ';
                                            echo '"'.$LabelMinggu2.'", ';
                                            echo '"'.$LabelMinggu3.'", ';
                                            echo '"'.$LabelMinggu4.'", ';
                                            echo '"'.$LabelMinggu5.'", ';
                                            echo '"'.$LabelMinggu6.'", ';
                                            echo '"'.$LabelMinggu7.'", ';
                                        ?>
                                        // "2018-09-19T00:00:00.000Z", 
                                        // "2018-09-19T01:30:00.000Z", 
                                        // "2018-09-19T02:30:00.000Z", 
                                        // "2018-09-19T03:30:00.000Z", 
                                        // "2018-09-19T04:30:00.000Z", 
                                        // "2018-09-19T05:30:00.000Z", 
                                        // "2018-09-19T06:30:00.000Z"
                                    ]
                                    },
                                    tooltip: {
                                    x: {
                                        format: 'dd/MM/yy HH:mm'
                                    },
                                    }
                                }).render();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b class="card-title">Profil Kecamatan</b>
                        </div>
                        <div id="DaftarKecamatanByKabupaten">
                            <!-- Daftar Kecamatan By Kabupaten -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>