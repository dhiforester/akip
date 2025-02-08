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
    if(empty($_POST['id_struktur_organisasi'])){
        echo '<small class="text-danger">ID tidak boleh kosong</small>';
    }else{
        if(empty($_POST['nama'])){
            echo '<small class="text-danger">Nama tidak boleh kosong</small>';
        }else{
            //Validasi jabatan tidak boleh kosong
            if(empty($_POST['jabatan'])){
                echo '<small class="text-danger">Jabatan tidak boleh kosong</small>';
            }else{
                $id_struktur_organisasi=$_POST['id_struktur_organisasi'];
                $nama=$_POST['nama'];
                $jabatan=$_POST['jabatan'];
                if(empty($_POST['part_of'])){
                    $part_of="0";
                }else{
                    $part_of=$_POST['part_of'];
                }
                if(empty($_POST['NIP'])){
                    $NIP="";
                    $JumlahKarakterNip="19";
                }else{
                    $NIP=$_POST['NIP'];
                    $JumlahKarakterNip=strlen($NIP);
                }
                //Validasi kontak tidak boleh lebih dari 20 karakter
                if($JumlahKarakterNip>20||$JumlahKarakterNip<1){
                    echo '<small class="text-danger">Kontak terdiri dari 1-20 karakter</small>';
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
                        $path = "../../assets/img/so/".$namabaru;
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
                        $namabaru=getDataDetail($Conn,'struktur_organisasi','id_struktur_organisasi',$id_struktur_organisasi,'foto');
                    }
                    //Apabila validasi upload valid maka simpan di database
                    if($ValidasiGambar!=="Valid"){
                        echo '<small class="text-danger">'.$ValidasiGambar.'</small>';
                    }else{
                        $UpdateStrukturOrganisasi = mysqli_query($Conn,"UPDATE struktur_organisasi SET 
                            part_of='$part_of',
                            nama='$nama',
                            jabatan='$jabatan',
                            NIP='$NIP',
                            updatetime='$now',
                            foto='$namabaru'
                        WHERE id_struktur_organisasi='$id_struktur_organisasi'") or die(mysqli_error($Conn)); 
                        if($UpdateStrukturOrganisasi){
                            $kategori_log="Struktur Organisasi";
                            $deskripsi_log="Edit Struktur Organisasi Berhasil";
                            $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                            if($InputLog=="Success"){
                                $_SESSION['NotifikasiSwal']="Edit Struktur Organisasi Berhasil";
                                echo '<small class="text-success" id="NotifikasiEditStrukturOrganisasiBerhasil">Success</small>';
                            }else{
                                echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan Log</small>';
                            }
                        }else{
                            echo '<small class="text-danger">Terjadi kesalahan pada saat menyimpan data</small>';
                        }
                    }
                }
            }
        }
    }
?>