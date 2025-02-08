<?php
    $tahun_ini=date('Y');
    //Menghitung Jumlah
    $JumlahAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses"));
    $JumlahOpd = mysqli_num_rows(mysqli_query($Conn, "SELECT id_opd FROM opd"));
    $JumlahPeriode = mysqli_num_rows(mysqli_query($Conn, "SELECT DISTINCT periode FROM kriteria_indikator"));
?>
<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6 col-md-4 mb-3">
                    <h3>Akses (Pengguna)</h3>
                    <small class="text-grayish"><?php echo "$JumlahAkses Orang"; ?></small>
                </div>
                <div class="col-6 col-md-4 mb-3">
                    <h3>Jumlah OPD</h3>
                    <small class="text-grayish"><?php echo "$JumlahOpd OPD"; ?></small>
                </div>
                <div class="col-6 col-md-4 mb-3">
                    <h3>Periode (Sesi)</h3>
                    <small class="text-grayish"><?php echo "$JumlahPeriode Sesi"; ?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <!-- Reports -->
                <div class="col-md-8">
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
                            <h5 class="card-title">Aktivitas User <span>/ 7 hari Terakhir</span></h5>
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
                                    height: 350,
                                    type: 'area',
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
                <div class="col-md-4">
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
                            <h5 class="card-title">Aktivitas User <span>| Terakhir Kali</span></h5>
                            <div class="activity">
                                <?php
                                    if(empty($JumlahLog)){
                                        echo '<div class="activity-item d-flex">';
                                        echo '  No activity yet';
                                        echo '</div>';
                                    }else{
                                        //Arraykan log
                                        $QryLog = mysqli_query($Conn, "SELECT*FROM log ORDER BY id_log DESC LIMIT 6");
                                        while ($DataLog = mysqli_fetch_array($QryLog)) {
                                            $id_log= $DataLog['id_log'];
                                            $id_akses= $DataLog['id_akses'];
                                            $id_mitra= $DataLog['id_mitra'];
                                            $datetime_log= $DataLog['datetime_log'];
                                            $datetime_log= strtotime($datetime_log);
                                            $deskripsi_log= $DataLog['deskripsi_log'];
                                            $WaktuLog=date('d/m/y H:i', $datetime_log);
                                            //Buka nama akses
                                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                                            $id_mitra = $DataDetailAkses['id_mitra'];
                                            $nama_akses= $DataDetailAkses['nama_akses'];
                                            echo '<div class="activity-item d-flex">';
                                            echo '  <div class="activite-label">'.$WaktuLog.'</div>';
                                            echo '  <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>';
                                            echo '  <div class="activity-content">';
                                            echo '      <b>'.$nama_akses.'</b><br>'.$deskripsi_log.'';
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
        </div>
    </div>
</section>