<?php
    include "_Page/Logout/ModalLogout.php";
    if(empty($_GET['Page'])){
        $Page="";
    }else{
        $Page=$_GET['Page'];
    }
    if($Page=="FiturAkses"){
        include "_Page/FiturAkses/ModalFiturAkses.php";
    }
    if($Page=="Akses"){
        include "_Page/Akses/ModalAkses.php";
    }
    if($Page=="AksesWilayahAdmin"){
        include "_Page/AksesWilayahAdmin/ModalAksesWilayahAdmin.php";
    }
    if($Page=="EntitasAkses"){
        include "_Page/EntitasAkses/ModalEntitasAkses.php";
    }
    if($Page=="PengajuanAkses"){
        include "_Page/PengajuanAkses/ModalPengajuanAkses.php";
    }
    if($Page=="MyProfile"){
        include "_Page/MyProfile/ModalMyProfile.php";
    }
    if($Page=="SettingGeneral"){
        include "_Page/SettingGeneral/ModalSettingGeneral.php";
    }
    if($Page=="SettingEmail"){
        include "_Page/SettingEmail/ModalSettingEmail.php";
    }
    if($Page=="ApiKey"){
        include "_Page/ApiKey/ModalApiKey.php";
    }
    if($Page=="Wilayah"){
        include "_Page/RegionalData/ModalRegionalData.php";
    }
    if($Page=="BidangKegiatan"){
        include "_Page/BidangKegiatan/ModalBidangKegiatan.php";
    }
    if($Page=="LampiranBukti"){
        include "_Page/LampiranBukti/ModalLampiranBukti.php";
    }
    if($Page=="KriteriaIndikator"){
        include "_Page/KriteriaIndikator/ModalKriteriaIndikator.php";
    }
    if($Page=="ApiDoc"){
        include "_Page/ApiDoc/ModalApiDoc.php";
    }
    if($Page=="Help"){
        include "_Page/Help/ModalHelp.php";
    }
    if($Page=="Aktivitas"){
        include "_Page/Aktivitas/ModalAktivitas.php";
    }
    if($Page=="WilayahProfilAdmin"){
        include "_Page/WilayahProfilAdmin/ModalWilayahProfilAdmin.php";
    }
    if($Page=="Evaluasi"){
        include "_Page/Evaluasi/ModalEvaluasi.php";
    }
    //Level Akses Desa
    if($Page=="AksesWilayah"){
        include "_Page/AksesWilayah/ModalAksesWilayah.php";
    }
    if($Page=="WilayahProfil"){
        include "_Page/WilayahProfil/ModalWilayahProfil.php";
    }
    if($Page=="RPJMDES"){
        include "_Page/RPJMDES/ModalRPJMDES.php";
    }
    if($Page=="RKPDES"){
        include "_Page/RKPDES/ModalRKPDES.php";
    }
    if($Page=="APBDES"){
        include "_Page/APBDES/ModalAPBDES.php";
    }
    if($Page=="PerjanjianKinerja"){
        include "_Page/PerjanjianKinerja/ModalPerjanjianKinerja.php";
    }
    if($Page=="Anggaran"){
        include "_Page/Anggaran/ModalAnggaran.php";
    }
    if($Page=="AnggaranAdmin"){
        include "_Page/AnggaranAdmin/ModalAnggaranAdmin.php";
    }
    if($Page=="EvaluasiDesa"){
        include "_Page/EvaluasiDesa/ModalEvaluasiDesa.php";
    }
    if($Page=="Penduduk"){
        include "_Page/Penduduk/ModalPenduduk.php";
    }
    if($Page=="LembarKerja"){
        include "_Page/LembarKerja/ModalLembarKerja.php";
    }
    //Kecamatan
    if($Page=="LembarKerjaKec"){
        include "_Page/LembarKerjaKec/ModalLembarKerjaKec.php";
    }
?>