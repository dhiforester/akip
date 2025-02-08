<?php
    if(empty($_GET['Sub'])){
        include "_Page/EvaluasiDesa/EvaluasiDesaHome.php";
    }else{
        $Sub=$_GET['Sub'];
        if($Sub=="DetailEvaluasi"){
            include "_Page/EvaluasiDesa/DetailEvaluasiDesa.php";
        }else{
            if($Sub=="RincianEvaluasi"){
                include "_Page/EvaluasiDesa/RincianEvaluasi.php";
            }else{
                include "_Page/EvaluasiDesa/EvaluasiDesaHome.php";
            }
        }
    }
?>