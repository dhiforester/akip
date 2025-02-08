<?php
    if(!empty($_GET['Sub'])){
        $Sub=$_GET['Sub'];
        if($Sub=="AnggaranRincian"){
            include "_Page/Anggaran/AnggaranRincian.php";
        }else{
            if($Sub=="DetailAnggaranRincian"){
                include "_Page/Anggaran/DetailAnggaranRincian.php";
            }else{
                include "_Page/Anggaran/AnggaranHome.php";
            }
        }
    }else{
        include "_Page/Anggaran/AnggaranHome.php";
    }
?>