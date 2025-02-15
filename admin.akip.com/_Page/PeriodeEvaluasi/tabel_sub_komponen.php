<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $jml_data =0;
    if(empty($SessionIdAkses)){
        echo '
            <div class="alert alert-danger">Sesi Akses Sudah Berakhir, Silahkan Login Ulang!</div>
        ';
    }else{
        if(empty($_POST['id_komponen'])){
            echo '
                <div class="alert alert-danger">ID Komponen Tidak Boleh Kosong!</div>
            ';
        }else{
            $id_komponen=$_POST['id_komponen'];
            
            //Buka Detail Komponen
            $Qry = $Conn->prepare("SELECT * FROM komponen WHERE id_komponen = ?");
            $Qry->bind_param("s", $id_komponen);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="alert alert-danger">'.$error.'</div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_evaluasi_periode'])){
                    echo '
                        <div class="alert alert-danger">Data Komponen Tidak Ditemukan</div>
                    ';
                }else{
                    //Buka Data
                    $nama_komponen=$Data['nama'];
                    $kode_komponen=$Data['kode'];
                    $keterangan_komponen=$Data['keterangan'];
                    echo '
                        <div class="row mb-2">
                            <div class="col-12 mb-3">
                                <ul>
                                    <li>
                                        <b class="text text-dark">
                                            '.$kode_komponen.'. '.$nama_komponen.'
                                        </b>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    ';
                }
            }
            echo '
                <div class="table table-responsive mt-3">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><b>Kode</b></th>
                                <th><b>Sub Komponen</b></th>
                                <th><b>Keterangan</b></th>
                                <th><b>Bobot</b></th>
                                <th><b>Opsi</b></th>
                            </tr>
                        </thead>
                        <tbody>
            ';
                $no = 1;
                $query = mysqli_query($Conn, "SELECT * FROM komponen_sub WHERE id_komponen='$id_komponen' ORDER BY kode ASC");
                $jml_data = mysqli_num_rows($query);
                if(empty($jml_data)){
                    echo '
                        <tr>
                            <td colspan="5" class="text-center">
                                <small class="text-danger">Tidak Ada Data Yang Ditampilkan</small>
                            </td>
                        </tr>
                    ';
                }else{
                    while ($data = mysqli_fetch_array($query)) {
                        $id_evaluasi_periode= $data['id_evaluasi_periode'];
                        $id_komponen_sub= $data['id_komponen_sub'];
                        $id_komponen= $data['id_komponen'];
                        $kode= $data['kode'];
                        $nama= $data['nama'];
                        $keterangan= $data['keterangan'];
                        //Menghitung Bobot Dari Tabel Uraian
                        $query_bobot = "SELECT SUM(bobot) AS total_bobot FROM uraian WHERE id_komponen_sub='$id_komponen_sub'";
                        $HasilBobot = $Conn->query($query_bobot);
                        // Ambil hasil
                        $BarisBobot = $HasilBobot->fetch_assoc();
                        $bobot = $BarisBobot['total_bobot'] ?? 0;
                        echo '
                            <tr>
                                <td><small>'.$kode_komponen.'.'.$kode.'</small></td>
                                <td>
                                    <a href="javascript:void(0);" class="show_kriteria" data-id="'.$id_komponen_sub.'" title="Tampilkan Uraian Kriteria">
                                        <small class="text-primary">'.$nama.'</small>
                                    </a>
                                </td>
                                <td>
                                    <small>
                                        <code class="text text-grayish">'.$keterangan.'</code>
                                    </small>
                                </td>
                                <td><small>'.$bobot.'</small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditIndikator" data-id="'.$id_komponen_sub.'" data-kode="'.$kode.'" data-nama="'.$nama.'" data-keterangan="'.$keterangan.'" data-level="Sub Komponen">
                                                <i class="bi bi-pencil"></i> Edit Sub Komponen
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusIndikator" data-id="'.$id_komponen_sub.'" data-kode="'.$kode.'" data-nama="'.$nama.'" data-keterangan="'.$keterangan.'" data-level="Sub Komponen">
                                                <i class="bi bi-trash"></i> Hapus Sub Komponen
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        ';
                        $no++; 
                    }
                }
            echo '
                        </tbody>
                    </table>
                </div>
            ';
        }
    }
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";

    //Put Into Pagging Element
    $('#FooterIndikator').html('<small><code class="text text-grayish">Jumlah Data: '+jml_data+' Sub Komponen</code></small>');
</script>
