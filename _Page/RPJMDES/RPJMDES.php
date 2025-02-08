<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="Rincian"){
            include "_Page/RPJMDES/RPJMDESRincian.php";
        }else{
            if($Sub=="DetailRincian"){
                include "_Page/RPJMDES/DetailRincian.php";
            }else{
                include "_Page/RPJMDES/RPJMDESHome.php";
            }
        }
    }else{
        include "_Page/RPJMDES/RPJMDESHome.php";
    }
?>