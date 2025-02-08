<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Validasi akses tidak boleh kosong
    if(empty($_POST['akses'])){
        echo '<small class="text-danger">Nama Akses Tidak Boleh Kosong</small>';
    }else{
        //Validasi entitas tidak boleh kosong
        if(empty($_POST['entitas'])){
            echo '<small class="text-danger">Nama entitas Tidak Boleh Kosong</small>';
        }else{
            //Validasi Standar Fitur tidak boleh kosong
            if(empty($_POST['id_akses_fitur'])){
                echo '<small class="text-danger">Standar Fitur Tidak Boleh Kosong</small>';
            }else{
                 //Validasi id_akses_entitas tidak boleh kosong
                if(empty($_POST['id_akses_entitas'])){
                    echo '<small class="text-danger">ID Entitas Tidak Boleh Kosong</small>';
                }else{
                    //Validasi nama akses tidak boleh lebih dari 20 karakter
                    $JumlahKarakterAkses=strlen($_POST['akses']);
                    $JumlahKarakterEntitas=strlen($_POST['entitas']);
                    if($JumlahKarakterAkses>20){
                        echo '<small class="text-danger">Nama Akses Tidak Boleh Lebih Dari 20 Karakter</small>';
                    }else{
                        if($JumlahKarakterEntitas>20){
                            echo '<small class="text-danger">Nama Entitas Tidak Boleh Lebih Dari 20 Karakter</small>';
                        }else{
                            $id_akses_entitas=$_POST['id_akses_entitas'];
                            $akses=$_POST['akses'];
                            $entitas=$_POST['entitas'];
                            $standar_fitur=$_POST['id_akses_fitur'];
                            $jumlah_standar_fitur=count($standar_fitur);
                            if(empty($jumlah_standar_fitur)){
                                echo '<small class="text-danger">Standar Fitur Tidak Boleh Kosong</small>';
                            }else{
                                //Buka data lama
                                $EntitasLama=getDataDetail($Conn,'akses_entitas','id_akses_entitas',$id_akses_entitas,'entitas');
                                if($entitas==$EntitasLama){
                                    $ValidasiEntitas=0;
                                }else{
                                    $ValidasiEntitas=mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM akses_entitas WHERE entitas='$entitas'"));
                                }
                                //Validasi Nama akses sama 
                                if(!empty($ValidasiEntitas)){
                                    echo '<small class="text-danger">Nama Entitas Tersebut Sudah Ada</small>';
                                }else{
                                    //Membuat Json
                                    $standar_fitur_json = array();
                                    foreach($standar_fitur as $id_akses_fitur) {
                                        //Buka Kode Fitur
                                        $kode=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'kode');
                                        $nama=getDataDetail($Conn,'akses_fitur','id_akses_fitur',$id_akses_fitur,'nama');
                                        $item = array(
                                            'id_akses_fitur' => $id_akses_fitur,
                                            'kode' => $kode,
                                            'nama' => $nama
                                        );
                                        $standar_fitur_json[] = $item;
                                    }
                                    $json_list = json_encode($standar_fitur_json);
                                    //Simpan Data Ke Database
                                    $UpdateEntitas = mysqli_query($Conn,"UPDATE akses_entitas SET 
                                        akses='$akses',
                                        entitas='$entitas',
                                        standar_fitur='$json_list'
                                    WHERE id_akses_entitas='$id_akses_entitas'") or die(mysqli_error($Conn)); 
                                    if($UpdateEntitas){
                                        $kategori_log="Entitas Akses";
                                        $deskripsi_log="Edit Entitas Akses Baru Berhasil";
                                        $InputLog=addLog($Conn,$SessionIdAkses,$now,$kategori_log,$deskripsi_log);
                                        if($InputLog=="Success"){
                                            echo '<small class="text-success" id="NotifikasiEditEntitasBerhasil">Success</small>';
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
            }
        }
    }
?>