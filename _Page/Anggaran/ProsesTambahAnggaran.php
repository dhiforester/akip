<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi periode_awal tidak boleh kosong
    if(empty($_POST['periode_awal'])){
        echo '<small class="text-danger">Periode Awal tidak boleh kosong</small>';
    }else{
        //Validasi Periode Akhir tidak boleh kosong
        if(empty($_POST['periode_akhir'])){
            echo '<small class="text-danger">Periode Akhir tidak boleh kosong</small>';
        }else{
            //Validasi kepala_desa tidak boleh kosong
            if(empty($_POST['kepala_desa'])){
                echo '<small class="text-danger">Kepala Desa tidak boleh kosong</small>';
            }else{
                if(empty($_POST['sekretaris_desa'])){
                    echo '<small class="text-danger">Sekretaris Desa tidak boleh kosong</small>';
                }else{
                    $periode_awal=$_POST['periode_awal'];
                    $periode_akhir=$_POST['periode_akhir'];
                    $kepala_desa=$_POST['kepala_desa'];
                    $sekretaris_desa=$_POST['sekretaris_desa'];
                    //Mencari ID wilayah Kabupaten
                    $propinsi=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'propinsi');
                    $kabupaten=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kabupaten');
                    $kecamatan=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'kecamatan');
                    $desa=getDataDetail($Conn,'wilayah','id_wilayah',$SessionIdWilayah,'desa');
                    //Buka ID wilayah kabupaten tersebut
                    $QryWilayah = mysqli_query($Conn,"SELECT * FROM wilayah WHERE kabupaten='$kabupaten' AND kategori='Kabupaten'")or die(mysqli_error($Conn));
                    $DataWilayah = mysqli_fetch_array($QryWilayah);
                    if(empty($DataWilayah['id_wilayah'])){
                        echo '<small class="text-danger">Identifikasi ID kabupaten anda tidak ditemukan</small>';
                    }else{
                        $id_wilayah_kabupaten=$DataWilayah['id_wilayah'];
                        //Validasi Karakter Angka
                        if(!preg_match("/^[0-9]*$/", $periode_awal)){
                            echo '<small class="text-danger">Periode Awal Hanya Boleh Berformat Angka</small>';
                        }else{
                            if(!preg_match("/^[0-9]*$/", $periode_akhir)){
                                echo '<small class="text-danger">Periode Akhir Hanya Boleh Berformat Angka</small>';
                            }else{
                                if($periode_akhir<=$periode_awal){
                                    echo '<small class="text-danger">Periode akhir tidak lebih kecil atau sama dengan periode awal</small>';
                                }else{
                                    $entry="INSERT INTO anggaran (
                                        id_wilayah,
                                        propinsi,
                                        kabupaten,
                                        kecamatan,
                                        desa,
                                        periode_awal,
                                        periode_akhir,
                                        kepala_desa,
                                        sekretaris_desa,
                                        jumlah,
                                        status
                                    ) VALUES (
                                        '$SessionIdWilayah',
                                        '$propinsi',
                                        '$kabupaten',
                                        '$kecamatan',
                                        '$desa',
                                        '$periode_awal',
                                        '$periode_akhir',
                                        '$kepala_desa',
                                        '$sekretaris_desa',
                                        '0',
                                        'Edited'
                                    )";
                                    $Input=mysqli_query($Conn, $entry);
                                    if($Input){
                                        //Cari ID Anggaran
                                        $QryAnggaranId = mysqli_query($Conn,"SELECT * FROM anggaran WHERE periode_awal='$periode_awal' AND periode_akhir='$periode_akhir' AND id_wilayah='$SessionIdWilayah'")or die(mysqli_error($Conn));
                                        $DataAnggaranId = mysqli_fetch_array($QryAnggaranId);
                                        if(empty($DataAnggaranId['id_anggaran'])){
                                            echo '<small class="text-danger">ID Anggaran yang baru anda input tidak ditemukan</small>';
                                        }else{
                                            $id_anggaran=$DataAnggaranId['id_anggaran'];
                                            //Jumlah Data Bidang
                                            $JumlahDataBidang = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah_kabupaten'"));
                                            //Jumlah Tahun
                                            $total_years = 0;
                                            for ($year = $periode_awal; $year <= $periode_akhir; $year++) {
                                                $total_years=$total_years+1;
                                            }
                                            //Jumlah Total Data
                                            $JumlahDataTotal=$total_years*$JumlahDataBidang;
                                            //Looping Tahun
                                            $ValidasiJumlahData=0;
                                            for ($year = $periode_awal; $year <= $periode_akhir; $year++) {
                                                //Loop Bidang
                                                $query = mysqli_query($Conn, "SELECT * FROM bidang_kegiatan WHERE id_wilayah='$id_wilayah_kabupaten' ORDER BY kode ASC");
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $id_bidang_kegiatan= $data['id_bidang_kegiatan'];
                                                    $kode= $data['kode'];
                                                    $kode_bidang= $data['kode_bidang'];
                                                    $kode_sub_bidang= $data['kode_sub_bidang'];
                                                    $kode_kegiatan= $data['kode_kegiatan'];
                                                    $level= $data['level'];
                                                    $nama= $data['nama'];
                                                    //Simpan Ke Rincian Anggran
                                                    $EntriRincian="INSERT INTO anggaran_rincian (
                                                        id_anggaran,
                                                        tahun,
                                                        kode,
                                                        kode_bidang,
                                                        kode_sub_bidang,
                                                        kode_kegiatan,
                                                        nama,
                                                        level,
                                                        sasaran,
                                                        volume,
                                                        satuan,
                                                        anggaran,
                                                        durasi
                                                    ) VALUES (
                                                        '$id_anggaran',
                                                        '$year',
                                                        '$kode',
                                                        '$kode_bidang',
                                                        '$kode_sub_bidang',
                                                        '$kode_kegiatan',
                                                        '$nama',
                                                        '$level',
                                                        '',
                                                        '',
                                                        '',
                                                        '0',
                                                        ''
                                                    )";
                                                    $InputRincian=mysqli_query($Conn, $EntriRincian);
                                                    if($InputRincian){
                                                        $ValidasiJumlahData=$ValidasiJumlahData+1;
                                                    }else{
                                                        $ValidasiJumlahData=$ValidasiJumlahData+0;
                                                    }
                                                }
                                            }
                                            if($ValidasiJumlahData==$JumlahDataTotal){
                                                $kategori_log="Anggaran";
                                                $deskripsi_log="Tambah Anggaran Berhasil";
                                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                if($InputLog=="Success"){
                                                    echo '<small class="text-success" id="NotifikasiTambahAnggaranBerhasil">Success</small>';
                                                    // echo '<small class="text-success">Jumlah 1 : '.$ValidasiJumlahData.'</small>';
                                                    // echo '<small class="text-success">Jumlah 2 : '.$JumlahDataTotal.'</small>';
                                                }else{
                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                                }
                                            }else{
                                                //Hapus Kedua Data Tabel
                                                $HapusAnggaran = mysqli_query($Conn, "DELETE FROM anggaran WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
                                                $HapusRincianAnggaran = mysqli_query($Conn, "DELETE FROM anggaran_rincian WHERE id_anggaran='$id_anggaran'") or die(mysqli_error($Conn));
                                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data rincian anggaran</small>';
                                            }
                                        }
                                    }else{
                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data ke dalam database</small>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>