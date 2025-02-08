<?php
    if(empty($_GET['Sub'])){
        include "_Page/Penduduk/PendudukHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="Detail"){
            include "_Page/Penduduk/DetailPenduduk.php";
        }else{
            include "_Page/Penduduk/PendudukHome.php";
        }
    }
?>