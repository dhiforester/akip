<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //ID Akses Tidak Boleh Kosong
    if(empty($_POST['id_akses'])){
        echo '<code class="text-danger">ID Akses tidak boleh kosong</code>';
    }else{
        //Validasi nama tidak boleh kosong
        if(empty($_POST['nama'])){
            echo '<code class="text-danger">Nama tidak boleh kosong</code>';
        }else{
            //Validasi kontak tidak boleh kosong
            if(empty($_POST['kontak'])){
                echo '<code class="text-danger">Kontak tidak boleh kosong</code>';
            }else{
                //Validasi email tidak boleh kosong
                if(empty($_POST['email'])){
                    echo '<code class="text-danger">Email tidak boleh kosong</code>';
                }else{
                    if(empty($_POST['id_akses_entitas'])){
                        echo '<code class="text-danger">Entitas Akses tidak boleh kosong</code>';
                    }else{
                        if(empty($_POST['id_wilayah_desa'])){
                            echo '<code class="text-danger">Wilyah Otoritas tidak boleh kosong</code>';
                        }else{
                            $id_akses=$_POST['id_akses'];
                            $id_wilayah_desa=$_POST['id_wilayah_desa'];
                            $nama=$_POST['nama'];
                            $kontak=$_POST['kontak'];
                            $email=$_POST['email'];
                            $id_akses_entitas=$_POST['id_akses_entitas'];
                            //Buka data askes lama
                            $QryDetailAkses = mysqli_query($Conn,"SELECT * FROM akses WHERE id_akses='$id_akses'")or die(mysqli_error($Conn));
                            $DataDetailAkses = mysqli_fetch_array($QryDetailAkses);
                            $id_akses_entitas_lama= $DataDetailAkses['id_akses_entitas'];
                            $kontak_akses_lama= $DataDetailAkses['kontak'];
                            $email_akses_lama = $DataDetailAkses['email'];
                            $FotoLama = $DataDetailAkses['foto'];
                            //Validasi kontak tidak boleh lebih dari 20 karakter
                            $JumlahKarakterKontak=strlen($kontak);
                            if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $kontak)){
                                echo '<code class="text-danger">Kontak hanya boleh terdiri dari 6-20 karakter numerik</code>';
                            }else{
                                //Validasi kontak tidak boleh duplikat
                                if($kontak_akses_lama==$kontak){
                                    $ValidasiKontakDuplikat=0;
                                }else{
                                    $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE kontak='$kontak'"));
                                }
                                if(!empty($ValidasiKontakDuplikat)){
                                    echo '<code class="text-danger">Nomor kontak sudah terdaftar</code>';
                                }else{
                                    if($email_akses_lama==$email){
                                        $ValidasiEmailDuplikat=0;
                                    }else{
                                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE email='$email'"));
                                    }
                                    if(!empty($ValidasiEmailDuplikat)){
                                        echo '<small class="text-danger">Email yang anda gunakan sudah terdaftar</small>';
                                    }else{
                                        //Validasi Gambar
                                        if(!empty($_FILES['foto']['name'])){
                                            //nama gambar
                                            $nama_gambar=$_FILES['foto']['name'];
                                            //ukuran gambar
                                            $ukuran_gambar = $_FILES['foto']['size']; 
                                            //tipe
                                            $tipe_gambar = $_FILES['foto']['type']; 
                                            //sumber gambar
                                            $tmp_gambar = $_FILES['foto']['tmp_name'];
                                            $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
                                            $key=implode('', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
                                            $FileNameRand=$key;
                                            $Pecah = explode("." , $nama_gambar);
                                            $BiasanyaNama=$Pecah[0];
                                            $Ext=$Pecah[1];
                                            $namabaru = "$FileNameRand.$Ext";
                                            $path = "../../assets/img/User/".$namabaru;
                                            if($tipe_gambar == "image/jpeg"||$tipe_gambar == "image/jpg"||$tipe_gambar == "image/gif"||$tipe_gambar == "image/png"){
                                                if($ukuran_gambar<2000000){
                                                    if(move_uploaded_file($tmp_gambar, $path)){
                                                        $ValidasiGambar="Valid";
                                                    }else{
                                                        $ValidasiGambar="Upload gambar gagal";
                                                    }
                                                }else{
                                                    $ValidasiGambar="File gambar tidak boleh lebih dari 2 Mb";
                                                }
                                            }else{
                                                $ValidasiGambar="tipe file hanya boleh JPG, JPEG, PNG and GIF";
                                            }
                                        }else{
                                            $ValidasiGambar="Valid";
                                            $namabaru="";
                                        }
                                        //Apabila validasi upload valid maka simpan di database
                                        if($ValidasiGambar!=="Valid"){
                                            echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                                        }else{
                                            if(!empty($_FILES['foto']['name'])){
                                                $image_akses=$namabaru;
                                            }else{
                                                $image_akses=$FotoLama;
                                            }
                                            $UpdateAkses = mysqli_query($Conn,"UPDATE akses SET 
                                                id_wilayah='$id_wilayah_desa',
                                                nama='$nama',
                                                kontak='$kontak',
                                                email='$email',
                                                id_akses_entitas='$id_akses_entitas',
                                                foto='$image_akses',
                                                updatetime='$now'
                                            WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                                            if($UpdateAkses){
                                                if($id_akses_entitas_lama!==$id_akses_entitas){
                                                    //Hapus Semua Ijin Akses
                                                    $HapusIjinAkses = mysqli_query($Conn, "DELETE FROM akses_ijin WHERE id_akses='$id_akses'") or die(mysqli_error($Conn));
                                                    if($HapusIjinAkses){
                                                        //Input Ulang
                                                        //Buka Standar Fitur
                                                        $standar_fitur =getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'standar_fitur');
                                                        //Decode Standar Fitur Menjadi Array
                                                        $standar_fitur = json_decode($standar_fitur, true);
                                                        //Hitung Jumlah Keseluruhan
                                                        $JumlahStandarFitur=count($standar_fitur);
                                                        //Jika Standar fitur tidak kosong
                                                        if(!empty($JumlahStandarFitur)){
                                                            $JumlahBerhasilInput=0;
                                                            foreach($standar_fitur as $list_standar){
                                                                $id_akses_fitur=$list_standar['id_akses_fitur'];
                                                                $kode=$list_standar['kode'];
                                                                //Input Ke ijin akses
                                                                $EntryIjinAkses="INSERT INTO akses_ijin (
                                                                    id_akses,
                                                                    id_akses_fitur,
                                                                    kode
                                                                ) VALUES (
                                                                    '$id_akses',
                                                                    '$id_akses_fitur',
                                                                    '$kode'
                                                                )";
                                                                $InputIjinAkses=mysqli_query($Conn, $EntryIjinAkses);
                                                                if($InputIjinAkses){
                                                                    $JumlahBerhasilInput=$JumlahBerhasilInput+1;
                                                                }else{
                                                                    $JumlahBerhasilInput=$JumlahBerhasilInput+0;
                                                                }
                                                            }
                                                            if($JumlahBerhasilInput==$JumlahStandarFitur){
                                                                $ValidasiInputStandarFitur="Valid";
                                                            }else{
                                                                $ValidasiInputStandarFitur="Input Akses Berhasil, Namun Terjadi Kesalahan Pada Saat Input Ijin Akses Standar";
                                                            }
                                                        }else{
                                                            $ValidasiInputStandarFitur="Valid";
                                                        }
                                                        if($ValidasiInputStandarFitur=="Valid"){
                                                            $kategori_log="Akses";
                                                            $deskripsi_log="Edit Akses Berhasil";
                                                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                            if($InputLog=="Success"){
                                                                echo '<small class="text-success" id="NotifikasiEditAksesBerhasil">Success</small>';
                                                            }else{
                                                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                                            }
                                                        }else{
                                                            echo '<small class="text-danger">'.$ValidasiInputStandarFitur.'</small>';
                                                        }
                                                    }
                                                }else{
                                                    $kategori_log="Akses";
                                                    $deskripsi_log="Edit Akses Berhasil";
                                                    $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                    if($InputLog=="Success"){
                                                        echo '<small class="text-success" id="NotifikasiEditAksesBerhasil">Success</small>';
                                                    }else{
                                                        echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                                    }
                                                }
                                            }else{
                                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                                            }
                                        }
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