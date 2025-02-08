<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="Detail"){
            include "_Page/RKPDES/RKPDESDetail.php";
        }else{
            include "_Page/RKPDES/RKPDESHome.php";
        }
    }else{
        include "_Page/RKPDES/RKPDESHome.php";
    }
?>