<?php
    //Koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";
    include "../../_Config/Function.php";
    if(empty($_POST['id_api_key'])){
        echo '<div class="row">';
        echo '  <div class="col col-md-12 text-center text-danger">';
        echo '      ID API Key Tidak Boleh Kosong!';
        echo '  </div>';
        echo '</div>';
    }else{
        $id_api_key=$_POST['id_api_key'];
        $nama=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'nama');
?>
        <input type="hidden" name="id_api_key" value="<?php echo "$id_api_key"; ?>">
        <div class="row">
                <div class="col col-md-12 text-center">
                    <b><?php echo $nama; ?></b>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12 text-center mb-3">
                    <code>Apakah Anda Yakin Akan Menghapus Data Tersebut?</code>
                </div>
            </div>
        </div>
<?php } ?>