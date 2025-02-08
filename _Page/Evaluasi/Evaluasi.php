<?php
    if(empty($_GET['Sub'])){
        include "_Page/Evaluasi/EvaluasiHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailEvaluasi"){
            include "_Page/Evaluasi/DetailEvaluasi.php";
        }else{
            if($Sub=="DetailEvaluasiByWilayah"){
                include "_Page/Evaluasi/DetailEvaluasiByWilayah.php";
            }else{
                include "_Page/Evaluasi/EvaluasiHome.php";
            }
        }
    }
?>