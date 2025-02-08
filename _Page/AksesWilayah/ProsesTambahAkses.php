<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi nama tidak boleh kosong
    if(empty($_POST['nama'])){
        echo '<small class="text-danger">Nama tidak boleh kosong</small>';
    }else{
        //Validasi kontak tidak boleh kosong
        if(empty($_POST['kontak'])){
            echo '<small class="text-danger">Kontak tidak boleh kosong</small>';
        }else{
            //Validasi email tidak boleh kosong
            if(empty($_POST['email'])){
                echo '<small class="text-danger">Email tidak boleh kosong</small>';
            }else{
                if(empty($_POST['password1'])){
                    echo '<small class="text-danger">Password tidak boleh kosong</small>';
                }else{
                    if(empty($_POST['password2'])){
                        echo '<small class="text-danger">Password tidak boleh kosong</small>';
                    }else{
                        if(empty($_POST['id_akses_entitas'])){
                            echo '<small class="text-danger">Entitas Akses tidak boleh kosong</small>';
                        }else{
                            if(empty($_POST['id_wilayah_desa'])){
                                echo '<small class="text-danger">ID Wilayah Desa tidak boleh kosong</small>';
                            }else{
                                $nama=$_POST['nama'];
                                $kontak=$_POST['kontak'];
                                $email=$_POST['email'];
                                $password1=$_POST['password1'];
                                $password2=$_POST['password2'];
                                $password=MD5($password1);
                                $id_akses_entitas=$_POST['id_akses_entitas'];
                                $id_wilayah_desa=$_POST['id_wilayah_desa'];
                                //Validasi kontak tidak boleh lebih dari 20 karakter
                                $JumlahKarakterKontak=strlen($kontak);
                                if($JumlahKarakterKontak>20||$JumlahKarakterKontak<6||!preg_match("/^[0-9]*$/", $kontak)){
                                    echo '<small class="text-danger">Kontak terdiri dari 6-20 karakter numerik</small>';
                                }else{
                                    //Validasi kontak tidak boleh duplikat
                                    $ValidasiKontakDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE kontak='$kontak'"));
                                    if(!empty($ValidasiKontakDuplikat)){
                                        echo '<small class="text-danger">Nomor kontak tersebut sudah terdaftar</small>';
                                    }else{
                                        //Validasi email duplikat
                                        $ValidasiEmailDuplikat=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses WHERE email='$email'"));
                                        if(!empty($ValidasiEmailDuplikat)){
                                            echo '<small class="text-danger">Email sudah digunakan</small>';
                                        }else{
                                            //Validasi Password Harus Sanam
                                            if($password1!==$password2){
                                                echo '<small class="text-danger">Password Tidak sama</small>';
                                            }else{
                                                //Validasi jumlah dan jenis karakter password
                                                $JumlahKarakterPassword=strlen($password1);
                                                if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $password1)){
                                                    echo '<small class="text-danger">Password hanya boleh terdiri dari 6-20 karakter numerik dan huruf</small>';
                                                }else{
                                                    $id_wilayah=$id_wilayah_desa;
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
                                                                    $ValidasiGambar="Upload file gambar gagal";
                                                                }
                                                            }else{
                                                                $ValidasiGambar="File gambar tidak boleh lebih dari 2 mb";
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
                                                        $entry="INSERT INTO akses (
                                                            id_wilayah,
                                                            id_akses_entitas,
                                                            nama,
                                                            kontak,
                                                            email,
                                                            password,
                                                            akses,
                                                            foto,
                                                            updatetime
                                                        ) VALUES (
                                                            '$id_wilayah',
                                                            '$id_akses_entitas',
                                                            '$nama',
                                                            '$kontak',
                                                            '$email',
                                                            '$password',
                                                            'Desa',
                                                            '$namabaru',
                                                            '$now'
                                                        )";
                                                        $Input=mysqli_query($Conn, $entry);
                                                        if($Input){
                                                            $KategoriLog="Input Akses Baru";
                                                            $KeteranganLog="Input Akses Baru Berhasil";
                                                            //Cari id_akses bersangkutan
                                                            $id_akses =getDataDetail($Conn,'akses','email',$email,'id_akses');
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
                                                                $deskripsi_log="Tambah Akses Baru Berhasil";
                                                                $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                                                if($InputLog=="Success"){
                                                                    echo '<small class="text-success" id="NotifikasiTambahAksesBerhasil">Success</small>';
                                                                }else{
                                                                    echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                                                                }
                                                            }else{
                                                                echo '<small class="text-danger">'.$ValidasiInputStandarFitur.'</small>';
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
            }
        }
    }
?>