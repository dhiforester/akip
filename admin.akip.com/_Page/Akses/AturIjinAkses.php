<?php
    if(empty($_GET['id_akses'])){
        echo '<section class="section dashboard">';
        echo '  <div class="row">';
        echo '      <div class="col-lg-12">';
        echo '          <div class="card">';
        echo '              <div class="card-body">';
        echo '                  ID Akses Tidak Boleh Kosong';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_akses=$_GET['id_akses'];
        //Buka data askes
        $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
        $id_mitra = $DataDetailAkses['id_mitra'];
        $nama_akses= $DataDetailAkses['nama_akses'];
        $kontak_akses= $DataDetailAkses['kontak_akses'];
        $email_akses = $DataDetailAkses['email_akses'];
        $password= $DataDetailAkses['password'];
        $Akses= $DataDetailAkses['akses'];
        $gambar= $DataDetailAkses['image_akses'];
        if(empty($gambar)){
            $gambar="No-Image.png";
        }else{
            $gambar="$gambar";
        }
        $akses= $DataDetailAkses['akses'];
        $status= $DataDetailAkses['status'];
        $datetime_daftar= $DataDetailAkses['datetime_daftar'];
        $datetime_update= $DataDetailAkses['datetime_update'];
        $registration=$datetime_daftar;
        $updatetime=$datetime_update;
        //Buka data acc_dashboard
        $QryAccDashboard = mysqli_query($Conn,"SELECT * FROM acc_dashboard WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataDashboard = mysqli_fetch_array($QryAccDashboard);
        if(!empty($DataDashboard['id_acc_dashboard'])){
            $acc_dashboard1 = $DataDashboard['acc_dashboard1'];
            $acc_dashboard2 = $DataDashboard['acc_dashboard2'];
            $acc_dashboard3 = $DataDashboard['acc_dashboard3'];
        }else{
            $acc_dashboard1 = "";
            $acc_dashboard2 = "";
            $acc_dashboard3 = "";
        }
        //Buka data acc_akses
        $QryAcc1 = mysqli_query($Conn,"SELECT * FROM acc_akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAcc1 = mysqli_fetch_array($QryAcc1);
        if(!empty($DataAcc1['id_acc_akses'])){
            $acc_akses1 = $DataAcc1['acc_akses1'];
            $acc_akses2 = $DataAcc1['acc_akses2'];
            $acc_akses3 = $DataAcc1['acc_akses3'];
            $acc_akses4 = $DataAcc1['acc_akses4'];
            $acc_akses5 = $DataAcc1['acc_akses5'];
        }else{
            $acc_akses1 = "";
            $acc_akses2 = "";
            $acc_akses3 = "";
            $acc_akses4 = "";
            $acc_akses5 = "";
        }
        //Buka data acc_mitra
        $QryAccMitra = mysqli_query($Conn,"SELECT * FROM acc_mitra WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccMitra = mysqli_fetch_array($QryAccMitra);
        if(!empty($DataAccMitra['id_acc_mitra'])){
            $acc_mitra1 = $DataAccMitra['acc_mitra1'];
            $acc_mitra2 = $DataAccMitra['acc_mitra2'];
            $acc_mitra3 = $DataAccMitra['acc_mitra3'];
            $acc_mitra4 = $DataAccMitra['acc_mitra4'];
            $acc_mitra5 = $DataAccMitra['acc_mitra5'];
        }else{
            $acc_mitra1 = "";
            $acc_mitra2 = "";
            $acc_mitra3 = "";
            $acc_mitra4 = "";
            $acc_mitra5 = "";
        }
        //Buka data acc_pasien
        $QryAccPasien = mysqli_query($Conn,"SELECT * FROM acc_pasien WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccPasien = mysqli_fetch_array($QryAccPasien);
        if(!empty($DataAccPasien['id_acc_pasien'])){
            $acc_pasien1 = $DataAccPasien['acc_pasien1'];
            $acc_pasien2 = $DataAccPasien['acc_pasien2'];
            $acc_pasien3 = $DataAccPasien['acc_pasien3'];
            $acc_pasien4 = $DataAccPasien['acc_pasien4'];
            $acc_pasien5 = $DataAccPasien['acc_pasien5'];
        }else{
            $acc_pasien1 = "";
            $acc_pasien2 = "";
            $acc_pasien3 = "";
            $acc_pasien4 = "";
            $acc_pasien5 = "";
        }
        //Buka data acc_kunjungan
        $QryAccKunjungan = mysqli_query($Conn,"SELECT * FROM acc_kunjungan WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccKunjungan = mysqli_fetch_array($QryAccKunjungan);
        if(!empty($DataAccKunjungan['id_acc_kunjungan'])){
            $acc_kunjungan1 = $DataAccKunjungan['acc_kunjungan1'];
            $acc_kunjungan2 = $DataAccKunjungan['acc_kunjungan2'];
            $acc_kunjungan3 = $DataAccKunjungan['acc_kunjungan3'];
            $acc_kunjungan4 = $DataAccKunjungan['acc_kunjungan4'];
            $acc_kunjungan5 = $DataAccKunjungan['acc_kunjungan5'];
            $acc_kunjungan6 = $DataAccKunjungan['acc_kunjungan6'];
            $acc_kunjungan7 = $DataAccKunjungan['acc_kunjungan7'];
            $acc_kunjungan8 = $DataAccKunjungan['acc_kunjungan8'];
            $acc_kunjungan9 = $DataAccKunjungan['acc_kunjungan9'];
        }else{
            $acc_kunjungan1 = "";
            $acc_kunjungan2 = "";
            $acc_kunjungan3 = "";
            $acc_kunjungan4 = "";
            $acc_kunjungan5 = "";
            $acc_kunjungan6 = "";
            $acc_kunjungan7 = "";
            $acc_kunjungan8 = "";
            $acc_kunjungan9 = "";
        }
        //Buka data acc_form
        $QryAccForm = mysqli_query($Conn,"SELECT * FROM acc_form WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccForm = mysqli_fetch_array($QryAccForm);
        if(!empty($DataAccForm['id_acc_form'])){
            $acc_form1 = $DataAccForm['acc_form1'];
            $acc_form2 = $DataAccForm['acc_form2'];
            $acc_form3 = $DataAccForm['acc_form3'];
            $acc_form4 = $DataAccForm['acc_form4'];
        }else{
            $acc_kunjungan1 = "";
            $acc_form1 = "";
            $acc_form2 = "";
            $acc_form3 = "";
            $acc_form4 = "";
        }
        //Buka data acc_pengaturan
        $QryAccPengaturan = mysqli_query($Conn,"SELECT * FROM acc_pengaturan WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccPengaturan = mysqli_fetch_array($QryAccPengaturan);
        if(!empty($DataAccPengaturan['id_acc_pengaturan'])){
            $acc_pengaturan1 = $DataAccPengaturan['acc_pengaturan1'];
            $acc_pengaturan2 = $DataAccPengaturan['acc_pengaturan2'];
            $acc_pengaturan3 = $DataAccPengaturan['acc_pengaturan3'];
            $acc_pengaturan4 = $DataAccPengaturan['acc_pengaturan4'];
            $acc_pengaturan5 = $DataAccPengaturan['acc_pengaturan5'];
            $acc_pengaturan6 = $DataAccPengaturan['acc_pengaturan6'];
            $acc_pengaturan7 = $DataAccPengaturan['acc_pengaturan7'];
            $acc_pengaturan8 = $DataAccPengaturan['acc_pengaturan8'];
        }else{
            $acc_pengaturan1 = "";
            $acc_pengaturan2 = "";
            $acc_pengaturan3 = "";
            $acc_pengaturan4 = "";
            $acc_pengaturan5 = "";
            $acc_pengaturan6 = "";
            $acc_pengaturan7 = "";
            $acc_pengaturan8 = "";
        }
        //Buka data acc_wilayah
        $QryAccWilayah = mysqli_query($Conn,"SELECT * FROM acc_wilayah WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccWilayah= mysqli_fetch_array($QryAccWilayah);
        if(!empty($DataAccWilayah['id_acc_wilayah'])){
            $acc_wilayah1 = $DataAccWilayah['acc_wilayah1'];
            $acc_wilayah2 = $DataAccWilayah['acc_wilayah2'];
            $acc_wilayah3 = $DataAccWilayah['acc_wilayah3'];
            $acc_wilayah4 = $DataAccWilayah['acc_wilayah4'];
        }else{
            $acc_wilayah1 = "";
            $acc_wilayah2 = "";
            $acc_wilayah3 = "";
            $acc_wilayah4 = "";
        }
        //Buka data acc_tindakan
        $QryAcTindakan= mysqli_query($Conn,"SELECT * FROM acc_tindakan WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccTindakan= mysqli_fetch_array($QryAcTindakan);
        if(!empty($DataAccTindakan['id_acc_tindakan'])){
            $acc_tindakan1 = $DataAccTindakan['acc_tindakan1'];
            $acc_tindakan2 = $DataAccTindakan['acc_tindakan2'];
            $acc_tindakan3 = $DataAccTindakan['acc_tindakan3'];
            $acc_tindakan4 = $DataAccTindakan['acc_tindakan4'];
        }else{
            $acc_tindakan1 = "";
            $acc_tindakan2 = "";
            $acc_tindakan3 = "";
            $acc_tindakan4 = "";
        }
        //Buka data acc_nakes
        $QryAcNakes= mysqli_query($Conn,"SELECT * FROM acc_nakes WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccNakes= mysqli_fetch_array($QryAcNakes);
        if(!empty($DataAccNakes['id_acc_nakes'])){
            $acc_nakes1 = $DataAccNakes['acc_nakes1'];
            $acc_nakes2 = $DataAccNakes['acc_nakes2'];
            $acc_nakes3 = $DataAccNakes['acc_nakes3'];
            $acc_nakes4 = $DataAccNakes['acc_nakes4'];
        }else{
            $acc_nakes1 = "";
            $acc_nakes2 = "";
            $acc_nakes3 = "";
            $acc_nakes4 = "";
        }
        //Buka data acc_jadwal
        $QryAcJadwal= mysqli_query($Conn,"SELECT * FROM acc_jadwal WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccJadwal= mysqli_fetch_array($QryAcJadwal);
        if(!empty($DataAccJadwal['id_acc_jadwal'])){
            $acc_jadwal1 = $DataAccJadwal['acc_jadwal1'];
            $acc_jadwal2 = $DataAccJadwal['acc_jadwal2'];
            $acc_jadwal3 = $DataAccJadwal['acc_jadwal3'];
            $acc_jadwal4 = $DataAccJadwal['acc_jadwal4'];
        }else{
            $acc_jadwal1 = "";
            $acc_jadwal2 = "";
            $acc_jadwal3 = "";
            $acc_jadwal4 = "";
        }
        //Buka data acc_supplier
        $QryAcSupplier= mysqli_query($Conn,"SELECT * FROM acc_supplier WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccSupplier= mysqli_fetch_array($QryAcSupplier);
        if(!empty($DataAccSupplier['id_acc_supplier'])){
            $acc_supplier1 = $DataAccSupplier['acc_supplier1'];
            $acc_supplier2 = $DataAccSupplier['acc_supplier2'];
            $acc_supplier3 = $DataAccSupplier['acc_supplier3'];
            $acc_supplier4 = $DataAccSupplier['acc_supplier4'];
        }else{
            $acc_supplier1 = "";
            $acc_supplier2 = "";
            $acc_supplier3 = "";
            $acc_supplier4 = "";
        }
        //Buka data  acc_barang
        $QryAccBarang= mysqli_query($Conn,"SELECT * FROM acc_barang WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccBarang= mysqli_fetch_array($QryAccBarang);
        if(!empty($DataAccBarang['id_acc_barang'])){
            $acc_barang1 = $DataAccBarang['acc_barang1'];
            $acc_barang2 = $DataAccBarang['acc_barang2'];
            $acc_barang3 = $DataAccBarang['acc_barang3'];
            $acc_barang4 = $DataAccBarang['acc_barang4'];
        }else{
            $acc_barang1 = "";
            $acc_barang2 = "";
            $acc_barang3 = "";
            $acc_barang4 = "";
        }
        //Buka data  acc_batch
        $QryAccBatch= mysqli_query($Conn,"SELECT * FROM acc_batch WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccBatch= mysqli_fetch_array($QryAccBatch);
        if(!empty($DataAccBatch['id_acc_batch'])){
            $acc_batch1 = $DataAccBatch['acc_batch1'];
            $acc_batch2 = $DataAccBatch['acc_batch2'];
            $acc_batch3 = $DataAccBatch['acc_batch3'];
            $acc_batch4 = $DataAccBatch['acc_batch4'];
        }else{
            $acc_batch1 = "";
            $acc_batch2 = "";
            $acc_batch3 = "";
            $acc_batch4 = "";
        }
        //Buka data  acc_transaksi
        $QryAccTransaksi= mysqli_query($Conn,"SELECT * FROM acc_transaksi WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccTransaksi= mysqli_fetch_array($QryAccTransaksi);
        if(!empty($DataAccTransaksi['id_acc_transaksi'])){
            $acc_transaksi1 = $DataAccTransaksi['acc_transaksi1'];
            $acc_transaksi2 = $DataAccTransaksi['acc_transaksi2'];
            $acc_transaksi3 = $DataAccTransaksi['acc_transaksi3'];
            $acc_transaksi4 = $DataAccTransaksi['acc_transaksi4'];
            $acc_transaksi5 = $DataAccTransaksi['acc_transaksi5'];
            $acc_transaksi6 = $DataAccTransaksi['acc_transaksi6'];
            $acc_transaksi7 = $DataAccTransaksi['acc_transaksi7'];
            $acc_transaksi8 = $DataAccTransaksi['acc_transaksi8'];
            $acc_transaksi9 = $DataAccTransaksi['acc_transaksi9'];
            $acc_transaksi10 = $DataAccTransaksi['acc_transaksi10'];
            $acc_transaksi11 = $DataAccTransaksi['acc_transaksi11'];
        }else{
            $acc_transaksi1 = "";
            $acc_transaksi2 = "";
            $acc_transaksi3 = "";
            $acc_transaksi4 = "";
            $acc_transaksi5 = "";
            $acc_transaksi6 = "";
            $acc_transaksi7 = "";
            $acc_transaksi8 = "";
            $acc_transaksi9 = "";
            $acc_transaksi10 = "";
            $acc_transaksi11 = "";
        }
        //Buka data  acc_pembayaran
        $QryAccPembayaran= mysqli_query($Conn,"SELECT * FROM acc_pembayaran WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccPembayaran= mysqli_fetch_array($QryAccPembayaran);
        if(!empty($DataAccPembayaran['id_acc_pembayaran'])){
            $acc_pembayaran1 = $DataAccPembayaran['acc_pembayaran1'];
            $acc_pembayaran2 = $DataAccPembayaran['acc_pembayaran2'];
            $acc_pembayaran3 = $DataAccPembayaran['acc_pembayaran3'];
        }else{
            $acc_pembayaran1 = "";
            $acc_pembayaran2 = "";
            $acc_pembayaran3 = "";
        }
        //Buka data  acc_akun
        $QryAccAkun= mysqli_query($Conn,"SELECT * FROM acc_akun WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccAkun= mysqli_fetch_array($QryAccAkun);
        if(!empty($DataAccAkun['id_acc_akun'])){
            $acc_akun1 = $DataAccAkun['acc_akun1'];
            $acc_akun2 = $DataAccAkun['acc_akun2'];
            $acc_akun3 = $DataAccAkun['acc_akun3'];
            $acc_akun4 = $DataAccAkun['acc_akun4'];
        }else{
            $acc_akun1 = "";
            $acc_akun2 = "";
            $acc_akun3 = "";
            $acc_akun4 = "";
        }
        //Buka data  acc_jurnal
        $QryAccJurnal= mysqli_query($Conn,"SELECT * FROM acc_jurnal WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccJurnal= mysqli_fetch_array($QryAccJurnal);
        if(!empty($DataAccJurnal['id_acc_jurnal'])){
            $acc_jurnal1 = $DataAccJurnal['acc_jurnal1'];
            $acc_jurnal2 = $DataAccJurnal['acc_jurnal2'];
            $acc_jurnal3 = $DataAccJurnal['acc_jurnal3'];
            $acc_jurnal4 = $DataAccJurnal['acc_jurnal4'];
        }else{
            $acc_jurnal1 = "";
            $acc_jurnal2 = "";
            $acc_jurnal3 = "";
            $acc_jurnal4 = "";
        }
        //Buka data  acc_komisi
        $QryAccKomisi= mysqli_query($Conn,"SELECT * FROM acc_komisi WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccKomisi= mysqli_fetch_array($QryAccKomisi);
        if(!empty($DataAccKomisi['id_acc_komisi'])){
            $acc_komisi1 = $DataAccKomisi['acc_komisi1'];
            $acc_komisi2 = $DataAccKomisi['acc_komisi2'];
        }else{
            $acc_komisi1 = "";
            $acc_komisi2 = "";
        }
        //Buka data  acc_laporan
        $QryAccLaporan= mysqli_query($Conn,"SELECT * FROM acc_laporan WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccLaporan= mysqli_fetch_array($QryAccLaporan);
        if(!empty($DataAccLaporan['id_acc_laporan'])){
            $acc_laporan1 = $DataAccLaporan['acc_laporan1'];
            $acc_laporan2 = $DataAccLaporan['acc_laporan2'];
            $acc_laporan3 = $DataAccLaporan['acc_laporan3'];
            $acc_laporan4 = $DataAccLaporan['acc_laporan4'];
            $acc_laporan5 = $DataAccLaporan['acc_laporan5'];
            $acc_laporan6 = $DataAccLaporan['acc_laporan6'];
        }else{
            $acc_laporan1 = "";
            $acc_laporan2 = "";
            $acc_laporan3 = "";
            $acc_laporan4 = "";
            $acc_laporan5 = "";
            $acc_laporan6 = "";
        }
        //Buka data  acc_whatsapp
        $QryAccWhatsapp= mysqli_query($Conn,"SELECT * FROM acc_whatsapp WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
        $DataAccWhatsapp= mysqli_fetch_array($QryAccWhatsapp);
        if(!empty($DataAccWhatsapp['id_acc_whatsapp'])){
            $acc_whatsapp1 = $DataAccWhatsapp['acc_whatsapp1'];
            $acc_whatsapp2 = $DataAccWhatsapp['acc_whatsapp2'];
            $acc_whatsapp3 = $DataAccWhatsapp['acc_whatsapp3'];
            $acc_whatsapp4 = $DataAccWhatsapp['acc_whatsapp4'];
            $acc_whatsapp5 = $DataAccWhatsapp['acc_whatsapp5'];
            $acc_whatsapp6 = $DataAccWhatsapp['acc_whatsapp6'];
            $acc_whatsapp7 = $DataAccWhatsapp['acc_whatsapp7'];
            $acc_whatsapp8 = $DataAccWhatsapp['acc_whatsapp8'];
            $acc_whatsapp9 = $DataAccWhatsapp['acc_whatsapp9'];
            $acc_whatsapp10 = $DataAccWhatsapp['acc_whatsapp10'];
            $acc_whatsapp11 = $DataAccWhatsapp['acc_whatsapp11'];
            $acc_whatsapp12 = $DataAccWhatsapp['acc_whatsapp12'];
        }else{
            $acc_whatsapp1 = "";
            $acc_whatsapp2 = "";
            $acc_whatsapp3 = "";
            $acc_whatsapp4 = "";
            $acc_whatsapp5 = "";
            $acc_whatsapp6 = "";
            $acc_whatsapp7 = "";
            $acc_whatsapp8 = "";
            $acc_whatsapp9 = "";
            $acc_whatsapp10 = "";
            $acc_whatsapp11 = "";
            $acc_whatsapp12 = "";
        }
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2"> 
                            <div class="col-md-12">
                                <table class="">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <small><dt>Nama</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $nama_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Email</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $email_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Kontak</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $kontak_akses; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Daftar</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $registration; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Update</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $updatetime; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Status</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $status; ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <small><dt>Akses</dt></small>
                                            </td>
                                            <td><b>:</b></td>
                                            <td>
                                                <small><?php echo $Akses; ?></small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="javascript:void(0);" id="ProsesAturIjinAkses">
                    <input type="hidden" name="id_akses" id="id_akses" value="<?php echo "$id_akses"; ?>">
                    <div class="card">
                        <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10 mt-3">
                                        <b>Atur Ijin Akses</b>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <a href="index.php?Page=Akses" class="btn btn-md btn-dark w-100">
                                            <i class="bi bi-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <?php if($Akses=="Admin"){ ?>
                                    <div class="col-md-4 mt-3">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="Ya" id="acc_akses1" name="acc_akses1" <?php if($acc_akses1=="Ya"){echo "checked";} ?>>
                                                <b>
                                                    <label class="form-check-label" for="acc_akses1">
                                                        Akses
                                                    </label>
                                                </b>
                                            </li>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses2" name="acc_akses2" <?php if($acc_akses2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_akses2">
                                                            Tambah Data Akses
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses3" name="acc_akses3" <?php if($acc_akses3=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_akses3">
                                                            Edit Data Akses
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_akses4">
                                                            Hapus Data Akses
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input akses_checked" type="checkbox" value="Ya" id="acc_akses5" name="acc_akses5" <?php if($acc_akses5=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_akses5">
                                                            Atur Fitur Akses
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_mitra1" name="acc_mitra1" <?php if($acc_mitra1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_mitra1">
                                                <b>Mitra</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <?php if($Akses=="Admin"){ ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra2" name="acc_mitra2" <?php if($acc_mitra2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_mitra2">
                                                            Tambah Data Mitra
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra3" name="acc_mitra3" <?php if($acc_mitra3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra3">
                                                        Edit Data Mitra
                                                    </label>
                                                </div>
                                            </li>
                                            <?php if($Akses=="Admin"){ ?>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_akses4" name="acc_akses4" <?php if($acc_akses4=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_akses4">
                                                            Hapus Data Mitra
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input mitra_checked" type="checkbox" value="Ya" id="acc_mitra5" name="acc_mitra5" <?php if($acc_mitra5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_mitra5">
                                                        Atur Akses Mitra
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_pasien1" name="acc_pasien1" <?php if($acc_pasien1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_pasien1">
                                                <b>Pasien</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien2" name="acc_pasien2" <?php if($acc_pasien2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien2">
                                                        Tambah Pasien Baru
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien3" name="acc_pasien3" <?php if($acc_pasien3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien3">
                                                        Edit Data Pasien
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien4" name="acc_pasien4" <?php if($acc_pasien4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien4">
                                                        Hapus Data Pasien
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pasien_checked" type="checkbox" value="Ya" id="acc_pasien5" name="acc_pasien5" <?php if($acc_pasien5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pasien5">
                                                        Menambahkan Kunjungan
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_kunjungan1" name="acc_kunjungan1" <?php if($acc_kunjungan1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_kunjungan1">
                                                <b>Kunjungan</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan2" name="acc_kunjungan2" <?php if($acc_kunjungan2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan2">
                                                        Tambah Kunjungan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan3" name="acc_kunjungan3" <?php if($acc_kunjungan3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan3">
                                                        Edit Kunjungan 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan4" name="acc_kunjungan4" <?php if($acc_kunjungan4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan4">
                                                        Delete Kunjungan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan5" name="acc_kunjungan5" <?php if($acc_kunjungan5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan5">
                                                        Tambah/Edit Screening
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan6" name="acc_kunjungan6" <?php if($acc_kunjungan6=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan6">
                                                        Buat Draft Medrek
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan7" name="acc_kunjungan7" <?php if($acc_kunjungan7=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan7">
                                                        Delete Draft Medrek
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan8" name="acc_kunjungan8" <?php if($acc_kunjungan8=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan8">
                                                        Edit Draft Medrek
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input kunjungan_checked" type="checkbox" value="Ya" id="acc_kunjungan9" name="acc_kunjungan9" <?php if($acc_kunjungan9=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_kunjungan9">
                                                        Cetak Draft
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <?php if($Akses=="Admin"){ ?>
                                    <div class="col-md-4 mt-3">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="Ya" id="acc_form1" name="acc_form1" <?php if($acc_form1=="Ya"){echo "checked";} ?>>
                                                <label class="form-check-label" for="acc_form1">
                                                    <b>Setting Form</b>
                                                </label>
                                            </li>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input form_checked" type="checkbox" value="Ya" id="acc_form2" name="acc_form2" <?php if($acc_form2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_form2">
                                                            Buat Tamplate
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input form_checked" type="checkbox" value="Ya" id="acc_form3" name="acc_form3" <?php if($acc_form3=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_form3">
                                                            Edit Tamplate
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input form_checked" type="checkbox" value="Ya" id="acc_form4" name="acc_form4" <?php if($acc_form4=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_form4">
                                                            Hapus Tamplate 
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <?php if($Akses=="Admin"){ ?>
                                    <div class="col-md-4 mt-3">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="Ya" id="acc_pengaturan1" name="acc_pengaturan1" <?php if($acc_pengaturan1=="Ya"){echo "checked";} ?>>
                                                <label class="form-check-label" for="acc_pengaturan1">
                                                    <b>Pengaturan Umum</b>
                                                </label>
                                            </li>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan2" name="acc_pengaturan2" <?php if($acc_pengaturan2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan2">
                                                            Pengaturan API Key 
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan3" name="acc_pengaturan3" <?php if($acc_pengaturan3=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan3">
                                                            Tambah Api Key 
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan4" name="acc_pengaturan4" <?php if($acc_pengaturan4=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan4">
                                                            Edit API key 
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan5" name="acc_pengaturan5" <?php if($acc_pengaturan5=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan5">
                                                            Delete API Key
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan6" name="acc_pengaturan6" <?php if($acc_pengaturan6=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan6">
                                                            Pengaturan WA Gateway
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan7" name="acc_pengaturan7" <?php if($acc_pengaturan7=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan7">
                                                            Pengaturan Payment Gateway
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input pengaturan_checked" type="checkbox" value="Ya" id="acc_pengaturan8" name="acc_pengaturan8" <?php if($acc_pengaturan8=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_pengaturan8">
                                                            Pengaturan Email Gateway
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <ul>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="Ya" id="acc_wilayah1" name="acc_wilayah1" <?php if($acc_wilayah1=="Ya"){echo "checked";} ?>>
                                                <label class="form-check-label" for="acc_wilayah1">
                                                    <b>Referensi Wilayah</b>
                                                </label>
                                            </li>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input wilayah_checked" type="checkbox" value="Ya" id="acc_wilayah2" name="acc_wilayah2" <?php if($acc_wilayah2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_wilayah2">
                                                            Tambah Wilayah 	
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input wilayah_checked" type="checkbox" value="Ya" id="acc_wilayah3" name="acc_wilayah3" <?php if($acc_wilayah3=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_wilayah3">
                                                            Edit Wilayah 
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_tindakan1" name="acc_tindakan1" <?php if($acc_tindakan1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_tindakan1">
                                                <b>Referensi Tindakan</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input tindakan_checked" type="checkbox" value="Ya" id="acc_tindakan2" name="acc_tindakan2" <?php if($acc_tindakan2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_tindakan2">
                                                        Tambah Tindakan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input tindakan_checked" type="checkbox" value="Ya" id="acc_tindakan3" name="acc_tindakan3" <?php if($acc_tindakan3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_tindakan3">
                                                        Edit Tindakan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input tindakan_checked" type="checkbox" value="Ya" id="acc_tindakan4" name="acc_tindakan4" <?php if($acc_tindakan4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_tindakan4">
                                                        Hapus Tindakan 
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_nakes1" name="acc_nakes1" <?php if($acc_nakes1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_nakes1">
                                                <b>Referesi Tenaga Kesehatan</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input nakes_checked" type="checkbox" value="Ya" id="acc_nakes2" name="acc_nakes2" <?php if($acc_nakes2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_nakes2">
                                                        Tabah Referensi Nakes
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input nakes_checked" type="checkbox" value="Ya" id="acc_nakes3" name="acc_nakes3" <?php if($acc_nakes3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_nakes3">
                                                        Edit Referensi Nakes
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input nakes_checked" type="checkbox" value="Ya" id="acc_nakes4" name="acc_nakes4" <?php if($acc_nakes4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_nakes4">
                                                        Hapus Referensi Nakes
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_jadwal1" name="acc_jadwal1" <?php if($acc_jadwal1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_jadwal1">
                                                <b>Referensi Jadwal Dokter</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jadwal_checked" type="checkbox" value="Ya" id="acc_jadwal2" name="acc_jadwal2" <?php if($acc_jadwal2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jadwal2">
                                                        Tambah Jadwal Dokter 	
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jadwal_checked" type="checkbox" value="Ya" id="acc_jadwal3" name="acc_jadwal3" <?php if($acc_jadwal3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jadwal3">
                                                        Edit Jadwal Dokter 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jadwal_checked" type="checkbox" value="Ya" id="acc_jadwal4" name="acc_jadwal4" <?php if($acc_jadwal4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jadwal4">
                                                        Hapus Jadwal Dokter 
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_supplier1" name="acc_supplier1" <?php if($acc_supplier1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_supplier1">
                                                <b>Supplier</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input supplier_checked" type="checkbox" value="Ya" id="acc_supplier2" name="acc_supplier2" <?php if($acc_supplier2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_supplier2">
                                                        Tambah Supplier
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input supplier_checked" type="checkbox" value="Ya" id="acc_supplier3" name="acc_supplier3" <?php if($acc_supplier3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_supplier3">
                                                        Edit Supplier
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input supplier_checked" type="checkbox" value="Ya" id="acc_supplier4" name="acc_supplier4" <?php if($acc_supplier4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_supplier4">
                                                        Hapus Supplier 
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_barang1" name="acc_barang1" <?php if($acc_barang1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_barang1">
                                                <b>Halaman Data Barang</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input barang_checked" type="checkbox" value="Ya" id="acc_barang2" name="acc_barang2" <?php if($acc_barang2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_barang2">
                                                        Tabah Barang
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input barang_checked" type="checkbox" value="Ya" id="acc_barang3" name="acc_barang3" <?php if($acc_barang3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_barang3">
                                                        Edit Barang
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input barang_checked" type="checkbox" value="Ya" id="acc_barang4" name="acc_barang4" <?php if($acc_barang4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_barang4">
                                                        Hapus Barang
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_batch1" name="acc_batch1" <?php if($acc_batch1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_batch1">
                                                <b>Batch & Expired</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input batch_checked" type="checkbox" value="Ya" id="acc_batch2" name="acc_batch2" <?php if($acc_batch2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_batch2">
                                                        Tambah Batch & Expired 	
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input batch_checked" type="checkbox" value="Ya" id="acc_batch3" name="acc_batch3" <?php if($acc_batch3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_batch3">
                                                        Edit Batch & Expired
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input batch_checked" type="checkbox" value="Ya" id="acc_batch4" name="acc_batch4" <?php if($acc_batch4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_batch4">
                                                        Hapus Batch & Expired
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_transaksi1" name="acc_transaksi1" <?php if($acc_transaksi1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_transaksi1">
                                                <b>Transaksi</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi2" name="acc_transaksi2" <?php if($acc_transaksi2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi2">
                                                        Tambah Transaksi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi3" name="acc_transaksi3" <?php if($acc_transaksi3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi3">
                                                        Edit Transaksi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi4" name="acc_transaksi4" <?php if($acc_transaksi4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi4">
                                                        Hapus Transaksi 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi5" name="acc_transaksi5" <?php if($acc_transaksi5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi5">
                                                        Tambah Rincian Transaksi 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi6" name="acc_transaksi6" <?php if($acc_transaksi6=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi6">
                                                        Edit Rincian Transaksi 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi7" name="acc_transaksi7" <?php if($acc_transaksi7=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi7">
                                                        Delete Rincian Transaksi 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi8" name="acc_transaksi8" <?php if($acc_transaksi8=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi8">
                                                        Tambah Jurnal Manual 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi9" name="acc_transaksi9" <?php if($acc_transaksi9=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi9">
                                                        Edit Jurnal Manual
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi10" name="acc_transaksi10" <?php if($acc_transaksi10=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi10 ">
                                                        Delete Jurnal Manual
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input transaksi_checked" type="checkbox" value="Ya" id="acc_transaksi11" name="acc_transaksi11" <?php if($acc_transaksi11=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_transaksi11 ">
                                                        Tambah Data Pembayaran
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_pembayaran1" name="acc_pembayaran1" <?php if($acc_pembayaran1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_pembayaran1">
                                                <b>Halaman Pembayaran</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pembayaran_checked" type="checkbox" value="Ya" id="acc_pembayaran2" name="acc_pembayaran2" <?php if($acc_pembayaran2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pembayaran2">
                                                        Tabah Pembayaran
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input pembayaran_checked" type="checkbox" value="Ya" id="acc_pembayaran3" name="acc_pembayaran3" <?php if($acc_pembayaran3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_pembayaran3">
                                                        Hapus Pembayaran
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_akun1" name="acc_akun1" <?php if($acc_akun1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_akun1">
                                                <b>Akun Perkiraan</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akun_checked" type="checkbox" value="Ya" id="acc_akun2" name="acc_akun2" <?php if($acc_akun2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akun2">
                                                        Tambah Akun Perkiraan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akun_checked" type="checkbox" value="Ya" id="acc_akun3" name="acc_akun3" <?php if($acc_akun3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akun3">
                                                        Edit Akun Perkiraan
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input akun_checked" type="checkbox" value="Ya" id="acc_akun4" name="acc_akun4" <?php if($acc_akun4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_akun4">
                                                        Hapus Akun Perkiraan
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_jurnal1" name="acc_jurnal1" <?php if($acc_jurnal1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_jurnal1">
                                                <b>Jurnal Transaksi</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jurnal_checked" type="checkbox" value="Ya" id="acc_jurnal2" name="acc_jurnal2" <?php if($acc_jurnal2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jurnal2">
                                                        Tambah Jurnal Transaksi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jurnal_checked" type="checkbox" value="Ya" id="acc_jurnal3" name="acc_jurnal3" <?php if($acc_jurnal3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jurnal3">
                                                        Edit Jurnal Transaksi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input jurnal_checked" type="checkbox" value="Ya" id="acc_jurnal4" name="acc_jurnal4" <?php if($acc_jurnal4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_jurnal4">
                                                        Hapus Jurnal Transaksi 
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_komisi1" name="acc_komisi1" <?php if($acc_komisi1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_komisi1">
                                                <b>Halaman Komisi</b>
                                            </label>
                                        </li>
                                        <?php if($SessionAkses=="Admin"){ ?>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input komisi_checked" type="checkbox" value="Ya" id="acc_komisi2" name="acc_komisi2" <?php if($acc_komisi2=="Ya"){echo "checked";} ?>>
                                                        <label class="form-check-label" for="acc_komisi2">
                                                            Tabah Pencairan
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_laporan1" name="acc_laporan1" <?php if($acc_laporan1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_laporan1">
                                                <b>Halaman Laporan</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input laporan_checked" type="checkbox" value="Ya" id="acc_laporan2" name="acc_laporan2" <?php if($acc_laporan2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_laporan2">
                                                        Buku Besar
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input laporan_checked" type="checkbox" value="Ya" id="acc_laporan3" name="acc_laporan3" <?php if($acc_laporan3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_laporan3">
                                                        Neraca Saldo
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input laporan_checked" type="checkbox" value="Ya" id="acc_laporan4" name="acc_laporan4" <?php if($acc_laporan4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_laporan4">
                                                        Laba Rugi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input laporan_checked" type="checkbox" value="Ya" id="acc_laporan5" name="acc_laporan5" <?php if($acc_laporan5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_laporan5">
                                                        Rekapitulasi Transaksi
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input laporan_checked" type="checkbox" value="Ya" id="acc_laporan6" name="acc_laporan6" <?php if($acc_laporan6=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_laporan6">
                                                        Bagi Hasil
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <ul>
                                        <li>
                                            <input class="form-check-input" type="checkbox" value="Ya" id="acc_whatsapp1" name="acc_whatsapp1" <?php if($acc_whatsapp1=="Ya"){echo "checked";} ?>>
                                            <label class="form-check-label" for="acc_whatsapp1">
                                                <b>Halaman Whatsapp Gateway</b>
                                            </label>
                                        </li>
                                        <ul>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp2" name="acc_whatsapp2" <?php if($acc_whatsapp2=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp2">
                                                        Tambah Akun Whatsapp 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp3" name="acc_whatsapp3" <?php if($acc_whatsapp3=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp3">
                                                        Hapus Akun Whatsapp 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp4" name="acc_whatsapp4" <?php if($acc_whatsapp4=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp4">
                                                        Halaman Chatbox 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp5" name="acc_whatsapp5" <?php if($acc_whatsapp5=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp5">
                                                        Kirim Chat
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp6" name="acc_whatsapp6" <?php if($acc_whatsapp6=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp6">
                                                        Hapus Chat 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp7" name="acc_whatsapp7" <?php if($acc_whatsapp7=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp7">
                                                        Halaman Tamplate Chat 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp8" name="acc_whatsapp8" <?php if($acc_whatsapp8=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp8">
                                                        Tambah/Edit Tamplate Chat 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp9" name="acc_whatsapp9" <?php if($acc_whatsapp9=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp9">
                                                        Halaman Rencana Kirim 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp10" name="acc_whatsapp10" <?php if($acc_whatsapp10=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp10">
                                                        Tambah Rencana Kirim Pesan 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp11" name="acc_whatsapp11" <?php if($acc_whatsapp11=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp11">
                                                        Edit Rencana Kirim Pesan 
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input whatsapp_checked" type="checkbox" value="Ya" id="acc_whatsapp12" name="acc_whatsapp12" <?php if($acc_whatsapp12=="Ya"){echo "checked";} ?>>
                                                    <label class="form-check-label" for="acc_whatsapp12">
                                                        Hapus Rencana Kirim Pesan 	 
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="NotifikasiAturIjinAkses">
                                    <span>Pastikan ijin akses sudah sesuai</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-md btn-success">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>