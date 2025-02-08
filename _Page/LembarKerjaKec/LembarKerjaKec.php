<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'xxviTqdZFa');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
        if(empty($_GET['Sub'])){
            include "_Page/LembarKerjaKec/LembarKerjaKecHome.php";
        }else{
            $Sub=$_GET['Sub'];
            if($Sub=="ListDesaByKecamatan"){
                include "_Page/LembarKerjaKec/ListDesaByKecamatan.php";
            }else{
                include "_Page/LembarKerjaKec/LembarKerjaKecHome.php";
            }
        }
    }
?>