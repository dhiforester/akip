<?php
    if(empty($_GET['Sub'])){
        include "_Page/RegionalData/RegionalDataHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="Perbaikan"){
            include "_Page/RegionalData/Perbaikan.php";
        }else{
            if($Sub=="Group"){
                include "_Page/RegionalData/RegionalDataGroup.php";
            }else{
                include "_Page/RegionalData/RegionalDataHome.php";
            }
        }
    }
?>