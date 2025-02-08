<?php
    if(empty($_GET['Page'])){
        $PageMenu="";
    }else{
        $PageMenu=$_GET['Page'];
    }
    if(empty($_GET['Sub'])){
        $SubMenu="";
    }else{
        $SubMenu=$_GET['Sub'];
    }
    if(empty($SessionIdAkses)){
        include "_Partial/MenuGuest.php";
    }else{
        if($SessionAkses=="Admin"){
            include "_Partial/MenuAdmin.php";
        }else{
            if($SessionAkses=="Provinsi"){
                include "_Partial/MenuProvinsi.php";
            }else{
                if($SessionAkses=="Kabupaten"){
                    include "_Partial/MenuKabupaten.php";
                }else{
                    if($SessionAkses=="Kecamatan"){
                        include "_Partial/MenuKecamatan.php";
                    }else{
                        if($SessionAkses=="Desa"){
                            include "_Partial/MenuDesa.php";
                        }else{
                            include "_Partial/MenuGuest.php";
                        }
                    }
                }
            }
        }
    }
?>