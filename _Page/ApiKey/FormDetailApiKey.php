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
        $email=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'email');
        $updatetime=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'updatetime');
        $api_key=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'api_key');
        $status=getDataDetail($Conn,'api_key','id_api_key',$id_api_key,'status');
        $strtotime=strtotime($updatetime);
        $datetime_api_key=date('d/m/y H:i',$strtotime);
        //Routing Status
        if($status=="Active"){
            $LabelStatus='<code class="text-success">Active</code>';
        }else{
            if($status=="Request"){
                $LabelStatus='<code class="text-warning">Request</code>';
            }else{
                $LabelStatus='<code class="text-danger">Block</code>';
            }
        }
?>
        <div class="row mb-3">
            <div class="col-md-4">Nama</div>
            <div class="col-md-8"><code class="text text-grayish"><?php echo "$nama"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Email</div>
            <div class="col-md-8"><code class="text text-grayish"><?php echo "$email"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">API Key</div>
            <div class="col-md-8"><code class="text text-grayish"><?php echo "$api_key"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Updatetime</div>
            <div class="col-md-8"><code class="text text-grayish"><?php echo "$datetime_api_key"; ?></code></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">Status</div>
            <div class="col-md-8"><?php echo "$LabelStatus"; ?></div>
        </div>
<?php } ?>