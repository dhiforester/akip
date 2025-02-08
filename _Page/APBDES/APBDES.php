<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="Detail"){
            include "_Page/APBDES/APBDESHome.php";
        }else{
            include "_Page/APBDES/APBDESHome.php";
        }
    }else{
        include "_Page/APBDES/APBDESHome.php";
    }
?>