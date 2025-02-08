<?php
    if(empty($_GET['Sub'])){
        include "_Page/AksesWilayahAdmin/AksesWilayahAdminHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailKecamatan"){
            include "_Page/AksesWilayahAdmin/DetailKecamatan.php";
        }else{
            if($Sub=="DetailDesa"){
                include "_Page/AksesWilayahAdmin/DetailDesa.php";
            }else{
                include "_Page/AksesWilayahAdmin/AksesWilayahAdminHome.php";
            }
        }
    }
?>