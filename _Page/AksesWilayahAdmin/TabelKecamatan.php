<?php
    //koneksi dan session
    include "../../_Config/Connection.php";
    include "../../_Config/Function.php";
    include "../../_Config/Session.php";
    include "../../_Config/SettingGeneral.php";
    $Kabupaten =$NamaWilayahOfficial;
    $JumlahKecamatan = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='Kecamatan' AND kabupaten='$NamaWilayahOfficial'"));
    if(empty($JumlahKecamatan)){
        echo '<tr>';
        echo '  <td colspan="6" class="text-center text-danger">';
        echo '      Tidak Ditemukan Data Kecamatan Untuk Kabupaten <b>'.$Kabupaten.'</b>';
        echo '  </td>';
        echo '</tr>';
    }else{
        $no = 1;
        //KONDISI PENGATURAN MASING FILTER
        $query = mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='kecamatan' AND kabupaten='$Kabupaten' ORDER BY kecamatan ASC");
        while ($data = mysqli_fetch_array($query)) {
            $id_wilayah= $data['id_wilayah'];
            $kategori= $data['kategori'];
            $propinsi= $data['propinsi'];
            $kabupaten= $data['kabupaten'];
            $kecamatan= $data['kecamatan'];
            //Jumlah Kabupaten
            $JumlahDesa = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM wilayah WHERE kategori='desa' AND kecamatan='$kecamatan' AND kabupaten='$Kabupaten'"));
            //Jumlah Akses
            $JumlahAkses = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE id_wilayah='$id_wilayah'"));
    ?>
        <tr>
            <td align="center"><?php echo "$no"; ?></td>
            <td align="left"><?php echo "$id_wilayah"; ?></td>
            <td align="left"><?php echo "$kecamatan"; ?></td>
            <td align="left"><?php echo "$JumlahDesa Desa"; ?></td>
            <td align="left"><?php echo "$JumlahAkses Akun"; ?></td>
            <td align="center">
                <a class="btn btn-sm btn-outline-black" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                    <li class="dropdown-header text-start">
                        <h6>Option</h6>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalListDesa" data-id="<?php echo "$id_wilayah"; ?>">
                            <i class="bi bi-list-columns"></i> List Desa
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalListAkun" data-id="<?php echo "$id_wilayah"; ?>">
                            <i class="bi bi-list-check"></i> List Akun Kecamatan
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDownloadTemplateDesa" data-id="<?php echo "$id_wilayah"; ?>">
                            <i class="bi bi-cloud-arrow-down"></i> Download Template Desa
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalImportAksesDesa" data-id="<?php echo "$id_wilayah"; ?>">
                            <i class="bi bi-upload"></i> Import Akses Desa
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="index.php?Page=AksesWilayahAdmin&Sub=DetailKecamatan&id=<?php echo "$id_wilayah"; ?>" data-id="<?php echo "$id_wilayah"; ?>">
                            <i class="bi bi-info-circle"></i> Detail Selengkapnya
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
<?php
            $no++; 
        }
    }
?>
<script>
    //Ketika KeywordBy Diubah
    $('.ShowKabupaten').click(function(){
        var id_wilayah = $(this).attr('value');
        var show = $(this).attr('show');
        if(show=="true"){
            $('#TampilkanDataKabupatenByProvinsi'+id_wilayah).html('Loading...');
            $.ajax({
                type 	    : 'POST',
                url 	    : '_Page/RegionalData/TabelKabupaten.php',
                data 	    :  {id_wilayah: id_wilayah},
                success     : function(data){
                    $('#TampilkanDataKabupatenByProvinsi'+id_wilayah).html(data);
                    //Remove Class
                    $('#NamaProvinsi'+id_wilayah).removeClass('text-info');
                    $('#NamaProvinsi'+id_wilayah).addClass('text-primary');
                    //Merubah Nilai Atribut Show
                    $('#NamaProvinsi'+id_wilayah).attr('show', 'false');
                }
            });
        }else{
            $('#TampilkanDataKabupatenByProvinsi'+id_wilayah).html("");
            //Remove Class
            $('#NamaProvinsi'+id_wilayah).removeClass('text-primary');
            $('#NamaProvinsi'+id_wilayah).addClass('text-info');
            //Merubah Nilai Atribut Show
            $('#NamaProvinsi'+id_wilayah).attr('show', 'true');
        }
    });
</script>