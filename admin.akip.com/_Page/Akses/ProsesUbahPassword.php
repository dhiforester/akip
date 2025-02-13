<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    //Time Zone
    date_default_timezone_set('Asia/Jakarta');
    //Time Now Tmp
    $now=date('Y-m-d H:i:s');
    //Id Akses
    if(empty($_POST['id_akses'])){
        echo '<code class="text-danger">ID Akses tidak boleh kosong</code>';
    }else{
        $id_akses=$_POST['id_akses'];
        //Validasi Password tidak boleh kosong
        if(empty($_POST['password1'])){
            echo '<code class="text-danger">Password tidak boleh kosong</code>';
        }else{
            if($_POST['password1']!==$_POST['password2']){
                echo '<code class="text-danger">Password tidak sama</code>';
            }else{
                //Validasi jumlah dan jenis karakter password
                $JumlahKarakterPassword=strlen($_POST['password1']);
                if($JumlahKarakterPassword>20||$JumlahKarakterPassword<6||!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password1'])){
                    echo '<code class="text-danger">Password hanya boleh terdiri dari 6-20 karakter numerik dan huruf</code>';
                }else{                 
                    //Variabel Lainnya
                    $password1=$_POST['password1'];
                    //md5
                    $password1=MD5($password1);                          
                    $UpdatePassword = mysqli_query($Conn,"UPDATE akses SET 
                        password='$password1',
                        updatetime='$now'
                    WHERE id_akses='$id_akses'") or die(mysqli_error($Conn)); 
                    if($UpdatePassword){
                        echo '<code class="text-success" id="NotifikasiUbahPasswordBerhasil">Success</code>';
                    }else{
                        echo '<code class="text-danger">Terjadi kesalahan pada saat menyimpan data</code>';
                    }
                }
            }
        }
    }
?>