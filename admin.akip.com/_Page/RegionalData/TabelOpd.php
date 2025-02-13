<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $jml_data =0;
    $id_kabkot="";
    $kabkot="";
    $provinsi="";
    if(empty($SessionIdAkses)){
        echo '
            <tr>
                <td colspan="4" class="text-center">
                    <small class="text-danger">Sesi Akses Sudah Berakhir. Silahkan Login Ulang!</small>
                </td>
            </tr>
        ';
    }else{
        if(empty($_POST['id_kabkot'])){
            echo '
                <tr>
                    <td colspan="4" class="text-center">
                        <small class="text-danger">ID Kabupaten/Kota Tidak Boleh Kosong!</small>
                    </td>
                </tr>
            ';
        }else{
            $id_kabkot=$_POST['id_kabkot'];
            //Buka Nama kabkot
            $kabkot=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
            $id_provinsi=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'id_provinsi');
            $provinsi=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');
            if(empty($kabkot)){
                echo '
                    <tr>
                        <td colspan="4" class="text-center">
                            <small class="text-danger">Kabupaten/Kota Yang Anda Pilih Tidak Ditemukan</small>
                        </td>
                    </tr>
                ';
            }else{
                $no = 1;
                //KONDISI PENGATURAN MASING FILTER
                if(empty($_POST['keyword'])){
                    $query = mysqli_query($Conn, "SELECT id_opd, nama_opd, telepon, alamat FROM opd WHERE id_kabkot='$id_kabkot' ORDER BY nama_opd ASC");
                }else{
                    $keyword=$_POST['keyword'];
                    $query = mysqli_query($Conn, "SELECT id_opd, nama_opd, telepon, alamat FROM opd WHERE id_kabkot='$id_kabkot' AND nama_opd like '%$keyword%' ORDER BY nama_opd ASC");
                }
                $jml_data = mysqli_num_rows($query);
                if(empty($jml_data)){
                    echo '
                        <tr>
                            <td colspan="4" class="text-center">
                                <small class="text-danger">Tidak Ada Data Yang Ditemukan</small>
                            </td>
                        </tr>
                    ';
                }else{
                    while ($data = mysqli_fetch_array($query)) {
                        $id_opd= $data['id_opd'];
                        $nama_opd= $data['nama_opd'];
                        $telepon= $data['telepon'];
                        $alamat= $data['alamat'];
                        //Jumlah Akses
                        $JumlahAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT id_akses FROM akses WHERE id_kabkot='$id_kabkot' AND akses='OPD'"));
                        echo '
                            <tr>
                                <td><small>'.$no.'</small></td>
                                <td>
                                    <a href="javascript:void(0);" class="show_detail_opd" data-id="'.$id_opd.'">
                                        <small>'.$nama_opd.'</small>
                                    </a>
                                </td>
                                <td><small>'.$JumlahAkses.'</small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditOpd" data-id="'.$id_opd.'" data-name="'.$nama_opd.'" data-tel="'.$telepon.'" data-alamat="'.$alamat.'">
                                                <i class="bi bi-pencil"></i> Edit OPD
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusOpd" data-id="'.$id_opd.'" data-name="'.$nama_opd.'" data-tel="'.$telepon.'" data-alamat="'.$alamat.'">
                                                <i class="bi bi-trash"></i> Hapus OPD
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        ';
                        $no++; 
                    }
                }
            }
        }
    }
?>
<script>

    //Creat Javascript Variabel
    var jml_data="<?php echo $jml_data; ?>";
    var id_kabkot="<?php echo $id_kabkot; ?>";
    var provinsi_name="<?php echo $provinsi; ?>";
    var kabkot_name="<?php echo $kabkot; ?>";
    
    //Tempelkan Nama Kabkot
    $('#put_provinsi_name2').html(provinsi_name);
    $('#put_kabkot_name').html(kabkot_name);

    //Put Into Pagging Element
    $('#page_info_opd').html('Jumlah Data: '+jml_data+' OPD');

    //Tempelkan id_kabkot
    $("#button_tambah_opd").attr("data-id", id_kabkot)
</script>
