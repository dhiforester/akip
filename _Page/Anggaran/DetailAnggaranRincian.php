<section class="section dashboard">
    <?php
        if(empty($_GET['id'])){
            echo '<div class="row">';
            echo '  <div class="col-md-12">';
            echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '          ID Periode Anggaran Tidak Boleh Kosong!';
            echo '          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        }else{
            $id_anggaran_rincian=$_GET['id'];
            //Buka Infromasi Periode Anggaran Rincian
            $id_anggaran=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'id_anggaran');
            $NamaKegiatan=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'nama');
            $tahun=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'tahun');
            //ID Wilayah Pada Tabel Anggaran
            $IdWilayahAnggaran=getDataDetail($Conn,'anggaran','id_anggaran',$id_anggaran,'id_wilayah');
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
            $NamaKegiatan=getDataDetail($Conn,'anggaran_rincian','id_anggaran_rincian',$id_anggaran_rincian,'nama');
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

            //Buka Data Progress
            $id_anggaran_progress=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'id_anggaran_progress');
            $status_pekerjaan=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'status_pekerjaan');
            $alokasi_anggaran=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'alokasi_anggaran');
            $KeteranganAnggaran=getDataDetail($Conn,'anggaran_progress ','id_anggaran_rincian ',$id_anggaran_rincian,'keterangan');
            //Ubah Dalam Format Rupiah
            if(!empty($alokasi_anggaran)){
                $AlokasiAnggaranRp="Rp" . number_format($alokasi_anggaran, 0, ',', '.');
                $AlokasiAnggaranRp="<code class='text text-grayish'>$AlokasiAnggaranRp</code>";
            }else{
                $AlokasiAnggaranRp="<code>Rp 0</code>";
            }
            if(empty($status_pekerjaan)){
                $StatusPekerjaan='<code>None</code>';
            }else{
                if($status_pekerjaan=="Dalam Pengerjaan"){
                    $StatusPekerjaan='<code class="text-info">'.$status_pekerjaan.'</code>';
                }else{
                    if($status_pekerjaan=="Terkendala"){
                        $StatusPekerjaan='<code class="text-danger">'.$status_pekerjaan.'</code>';
                    }else{
                        if($status_pekerjaan=="Selesai"){
                            $StatusPekerjaan='<code class="text-success">'.$status_pekerjaan.'</code>';
                        }else{
                            $StatusPekerjaan='<code>None</code>';
                        }
                    }
                }
            }
            if(!empty($KeteranganAnggaran)){
                $LabelKeterangan="<code class='text text-grayish'>$KeteranganAnggaran</code>";
            }else{
                $LabelKeterangan="<code class='text-danger'>None</code>";
            }
            if(!empty($alokasi_anggaran)){
                if(!empty($anggaran)){
                    $PersentaseAlokasi=($alokasi_anggaran/$anggaran)*100;
                    $PersentaseAlokasi=round($PersentaseAlokasi);
                    $PersentaseAlokasi='<code class="text-info">'.$PersentaseAlokasi.'</code>';
                }else{
                    $PersentaseAlokasi="0";
                    $PersentaseAlokasi='<code class="text-danger">'.$PersentaseAlokasi.'</code>';
                }
            }else{
                $PersentaseAlokasi="0";
                $PersentaseAlokasi='<code class="text-danger">'.$PersentaseAlokasi.'</code>';
            }
    ?>
        <input type="hidden" id="id_anggaran" name="id_anggaran" value="<?php echo "$id_anggaran"; ?>">
        <input type="hidden" id="id_wilayah" name="id_wilayah" value="<?php echo "$SessionIdWilayah"; ?>">
        <input type="hidden" id="id_anggaran_rincian" name="id_anggaran_rincian" value="<?php echo "$id_anggaran_rincian"; ?>">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    Berikut ini adalah halaman untuk mengelola rincian anggaran yang di uraikan berdasarkan bidang kegiatan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                            <li class="dropdown-header text-start">
                                <h6>Option</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalTambahRincianRab" data-id="<?php echo "$id_anggaran_rincian"; ?>">
                                    <i class="bi bi-plus"></i> Tambah Manual
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUpdateProgress" data-id="<?php echo "$id_anggaran_rincian"; ?>">
                                    <i class="bi bi-repeat"></i> Update Progress
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalImportDariExcelRab" data-id="<?php echo "$id_anggaran_rincian"; ?>">
                                    <i class="bi bi-upload"></i> Import Dari Excel
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalExportRab" data-id="<?php echo "$id_anggaran_rincian"; ?>">
                                    <i class="bi bi-download"></i> Export/Download
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <b class="card-title">Rencana Anggaran Biaya (RAB)</b><br>
                                <a href="index.php?Page=Anggaran&Sub=AnggaranRincian&id=<?php echo "$id_anggaran"; ?>" class="text-primary">
                                    <small class="credit">
                                        <i class="bi bi-chevron-left"></i> Kembali Ke Halaman Sebelumnya
                                    </small>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row border-bottom border-1 mb-3">
                            <div class="col-md-12">
                                <?php
                                    //Informasi Reverensi
                                    $KategoriWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayahAnggaran,'kategori');
                                    $ProvinsiWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayahAnggaran,'propinsi');
                                    $KabupatenWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayahAnggaran,'kabupaten');
                                    $KecamatanWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayahAnggaran,'kecamatan');
                                    $DesaWilayah=getDataDetail($Conn,'wilayah','id_wilayah',$IdWilayahAnggaran,'desa');
                                ?>
                                <div class="row mb-3">
                                    <div class="col col-md-12">
                                        <b>Informasi Daerah Penyelenggara</b>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Provinsi</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$ProvinsiWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                <div class="col col-md-3">Kabupaten/Kota</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$KabupatenWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                <div class="col col-md-3">Kecamatan</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$KecamatanWilayah"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Kelurahan/Desa</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$DesaWilayah"; ?></code></div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom border-1 mb-3">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="col col-md-12">
                                        <b>Informasi Bidang & Kegiatan</b>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Bidang</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$NamaBidang"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Sub Bidang</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$NamaSubBidang"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Kegiatan</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$NamaKegiatan"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Kode</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$kode"; ?></code></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Anggaran</div>
                                    <div class="col md-9"><code class="text-grayish"><?php echo "$rupiahAnggaran"; ?></code></div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom border-1 mb-3">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="col col-md-12">
                                        <b>Progress Anggaran</b>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Status Anggaran</div>
                                    <div class="col md-9"><?php echo "$StatusPekerjaan"; ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Anggaran Tersalurkan</div>
                                    <div class="col md-9"><?php echo "$AlokasiAnggaranRp ($PersentaseAlokasi %)"; ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col col-md-3">Keterangan</div>
                                    <div class="col md-9"><?php echo "$LabelKeterangan"; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="MenampilkanTabelRincianAnggaranRab">

                            </div>
                        </div>
                        <!-- Menampilkan Tabel Rincian Anggaran Disini -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
