<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Tangkap id_bidang_kegiatan
    if(empty($_POST['id_bidang_kegiatan'])){
        echo '<div class="row">';
        echo '  <div class="col-md-12 mb-3 text-center text-danger">';
        echo '      ID Bidang/Kegiatan Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_bidang_kegiatan=$_POST['id_bidang_kegiatan'];
        $id_wilayah=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'id_wilayah');
        $nama_daerah=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'nama_daerah');
        $kode=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'kode');
        $kode_bidang=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'kode_bidang');
        $kode_sub_bidang=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'kode_sub_bidang');
        $kode_kegiatan=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'kode_kegiatan');
        $level=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'level');
        $nama=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'nama');
        $updatetime=getDataDetail($Conn,'bidang_kegiatan','id_bidang_kegiatan',$id_bidang_kegiatan,'updatetime');
        if($level=="Bidang"){
            $KodeBidang=$kode;
            $KodeSubBidang="-";
            $KodeKegiatan="-";
            $NamaBidang=$nama;
            $NamaSubBidang="-";
            $NamaKegiatan="-";
        }else{
            if($level=="Sub Bidang"){
                $KodeBidang=$kode_bidang;
                $KodeSubBidang=$kode;
                $KodeKegiatan="-";
                //Buka Nama
                $QryNamaBidang = mysqli_query($Conn,"SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND kode='$KodeBidang'")or die(mysqli_error($Conn));
                $DataNamaBidang = mysqli_fetch_array($QryNamaBidang);
                $NamaBidang=$DataNamaBidang['nama'];
                $NamaSubBidang=$nama;
                $NamaKegiatan="-";
            }else{
                if($level=="Kegiatan"){
                    $KodeBidang=$kode_bidang;
                    $KodeSubBidang=$kode_sub_bidang;
                    $KodeKegiatan=$kode;
                    //Buka Nama
                    $QryNamaBidang = mysqli_query($Conn,"SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND kode='$KodeBidang'")or die(mysqli_error($Conn));
                    $DataNamaBidang = mysqli_fetch_array($QryNamaBidang);
                    $NamaBidang=$DataNamaBidang['nama'];
                    $QryNamaSubBidang = mysqli_query($Conn,"SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah' AND kode='$KodeSubBidang'")or die(mysqli_error($Conn));
                    $DataNamaSubBidang = mysqli_fetch_array($QryNamaSubBidang);
                    $NamaSubBidang=$DataNamaSubBidang['nama'];
                    $NamaKegiatan=$nama;
                }else{
                    $KodeBidang="-";
                    $KodeSubBidang="-";
                    $KodeKegiatan="-";
                    $NamaBidang="-";
                    $NamaSubBidang="-";
                    $NamaKegiatan="-";
                }
            }
        }
?>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="row mb-3">
                <div class="col-md-12">
                    <table width="100%">
                        <tr>
                            <td valign="top"><small class="credit">Kabupaten</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$id_wilayah. $nama_daerah"; ?></small>
                                </code>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><small class="credit">Bidang</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$KodeBidang. $NamaBidang"; ?></small>
                                </code>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><small class="credit">Sub</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$KodeSubBidang. $NamaSubBidang"; ?></small>
                                </code>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><small class="credit">Kegiatan</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$KodeKegiatan. $NamaKegiatan"; ?></small>
                                </code>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><small class="credit">Level</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$level"; ?></small>
                                </code>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><small class="credit">Update</small></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <code class="text-grayish">
                                    <small class="ceredit"><?php echo "$updatetime"; ?></small>
                                </code>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>