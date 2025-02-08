<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'xbAqBMe2Vm');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form action="javascript:void(0);" id="ProsesBatas">
                            <div class="row">
                                <div class="col-md-2 text-center mt-3 mb-3">
                                    <a href="index.php?Page=ApiDoc&Sub=TambahApiDoc" class="btn btn-md btn-primary btn-block btn-rounded">
                                        <i class="bi bi-save"></i> Creat New
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="MenampilkanTabelApiDoc">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php
                            $jml_data = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM dokumentasi_api"));
                            echo "JUMLAH DATA : $jml_data";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>