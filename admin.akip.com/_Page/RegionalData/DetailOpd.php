<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    $nama_opd="";
    //Validasi Session
    if(empty($SessionIdAkses)){
        echo '
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        Sesi Akses Sudah Berakhir. Silahkan Login Ulang!
                    </div>
                </div>
            </div>
        ';
    }else{
        if(empty($_POST['id_opd'])){
            echo '
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            ID OPD Tidak Boleh Kosong!
                        </div>
                    </div>
                </div>
            ';
        }else{
            $id_opd=$_POST['id_opd'];
            
            //Buka Data OPD
            $Qry = $Conn->prepare("SELECT * FROM opd WHERE id_opd = ?");
            $Qry->bind_param("s", $id_opd);
            if (!$Qry->execute()) {
                $error=$Conn->error;
                echo '
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Error: '.$error.'
                            </div>
                        </div>
                    </div>
                ';
            }else{
                $Result = $Qry->get_result();
                $Data = $Result->fetch_assoc();
                $Qry->close();
                if(empty($Data['id_opd'])){
                    echo '
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    Data OPD Tidak Ditemukan!
                                </div>
                            </div>
                        </div>
                    ';
                }else{
                    //Buka Data
                    $id_provinsi=$Data['id_provinsi'];
                    $id_kabkot=$Data['id_kabkot'];
                    $nama_opd=$Data['nama_opd'];
                    $telepon=$Data['telepon'];
                    $alamat=$Data['alamat'];

                    //Buka Nama Provinsi
                    $provinsi=GetDetailData($Conn, 'wilayah_provinsi', 'id_provinsi', $id_provinsi, 'provinsi');

                    //Buka nama Kabupaten
                    $kabkot=GetDetailData($Conn, 'wilayah_kabkot', 'id_kabkot', $id_kabkot, 'kabkot');
                    echo '
                        <div class="row mb-3">
                            <div class="col-4 col-md-3"><small>Provinsi</small></div>
                            <div class="col-8 col-md-9"><small class="text text-grayish">'.$provinsi.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 col-md-3"><small>Kabupaten/Kota</small></div>
                            <div class="col-8 col-md-9"><small class="text text-grayish">'.$kabkot.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 col-md-3"><small>Nama OPD</small></div>
                            <div class="col-8 col-md-9"><small class="text text-grayish">'.$nama_opd.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 col-md-3"><small>Telepon</small></div>
                            <div class="col-8 col-md-9"><small class="text text-grayish">'.$telepon.'</small></div>
                        </div>
                        <div class="row mb-3 border-1 border-bottom">
                            <div class="col-4 col-md-3 mb-3"><small>Alamat</small></div>
                            <div class="col-8 col-md-9 mb-3"><small class="text text-grayish">'.$alamat.'</small></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3">
                                <b>Data Akun Akses OPD</b>
                            </div>
                            <div class="col-6 mb-3 text-end">
                                <button type="button" class="btn btn-sm btn-floating btn-outline-grayish" data-bs-toggle="modal" data-bs-target="#ModalTambahAkses" data-id="'.$id_opd.'" title="Tambah Akses">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    ';
                    $no = 1;
                    //Buka data askes OPD
                    $query = mysqli_query($Conn, "SELECT id_akses FROM akses_opd WHERE id_opd='$id_opd' ORDER BY id_akses ASC");
                    $jml_data = mysqli_num_rows($query);
                    if(empty($jml_data)){
                        echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        Tidak Ada Data Akses Pada OPD Ini!
                                    </div>
                                </div>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="table table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><b>No</b></th>
                                                    <th><b>Nama</b></th>
                                                    <th><b>Kontak</b></th>
                                                    <th><b>Email</b></th>
                                                    <th><b>Option</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                        ';
                                            while ($data = mysqli_fetch_array($query)) {
                                                $id_akses= $data['id_akses'];
                                                //Buka Detail Akses

                                                $nama=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'nama');
                                                $email=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'email');
                                                $kontak=GetDetailData($Conn, 'akses', 'id_akses', $id_akses, 'kontak');
                                                echo '
                                                    <tr>
                                                        <td><small>'.$no.'</small></td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailAkses" data-id="'.$id_akses.'">
                                                                <small class="text-primary">'.$nama.'</small>
                                                            </a>
                                                        </td>
                                                        <td><small>'.$kontak.'</small></td>
                                                        <td><small>'.$email.'</small></td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-floating btn-outline-dark" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalEditAkses" data-id="'.$id_akses.'">
                                                                        <i class="bi bi-pencil"></i> Edit User
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword" data-id="'.$id_akses.'" data-idopd="'.$id_opd.'">
                                                                        <i class="bi bi-key"></i> Ubah Password
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalUbahFoto" data-id="'.$id_akses.'" data-idopd="'.$id_opd.'">
                                                                        <i class="bi bi-image"></i> Ubah Foto
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalHapusAkses" data-id="'.$id_akses.'" data-idopd="'.$id_opd.'">
                                                                        <i class="bi bi-trash"></i> Hapus User
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                ';
                                                $no++; 
                                            }
                        echo '
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            }
        }
    }
?>
<script>
    //Creat Javascript Variabel
    var nama_opd="<?php echo $nama_opd; ?>";

    //Tempelkan Nama OPD
    $('#put_opd_name').html(nama_opd);

</script>
