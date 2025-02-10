<?php
    //Koneksi
    include "_Config/Connection.php";
    
    //Session
    include "_Config/Session.php";

    //Apabila sesion id_akses tidak ada maka redirect ke halaman login
    if(empty($SessionIdAkses)){
        header("Location:Login.php");
    }else{
        include "_Config/Function.php";
        include "_Config/SettingGeneral.php";
?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <?php
                include "_Partial/JsPlugin.php";
            ?>
        </head>
        <!-- <body class="toggle-sidebar"> -->
        <body class="">
            <?php
                include "_Partial/Navbar.php";
                include "_Partial/Menu.php";
            ?>
            <main id="main" class="main">
                <?php
                    include "_Partial/PageTitle.php";
                    include "_Partial/RoutingPage.php";
                    include "_Partial/Modal.php";
                ?>
            </main>
            <?php
                include "_Partial/Copyright.php";
                include "_Partial/BackToTop.php";
                include "_Partial/FooterJs.php";
                include "_Partial/RoutingJs.php";
            ?>
        </body>
    </html>
<?php 
    } 
?>