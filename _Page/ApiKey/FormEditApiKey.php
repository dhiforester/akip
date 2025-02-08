<?php
    //Koneksi
    date_default_timezone_set('Asia/Jakarta');
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
    <input type="hidden" name="id_api_key" value="<?php echo "$id_api_key"; ?>">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="nama_edit">Nama Pengguna</label>
        </div>
        <div class="col-md-8">
            <input type="text" name="nama" id="nama_edit" class="form-control" value="<?php echo "$nama"; ?>">
            <small class="credit">Diisi dengan nama pemegang API Key</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="email_edit">Alamat Email</label>
        </div>
        <div class="col-md-8">
            <input type="email" name="email" id="email_edit" class="form-control" value="<?php echo "$email"; ?>">
            <small class="credit">Alamat email pemegang API key</small>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="api_key_edit">API Key</label>
        </div>
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" name="api_key" id="api_key_edit" class="form-control" value="<?php echo "$api_key"; ?>">
                <button type="button" class="btn btn-sm btn-dark" id="GenerateApiKey">
                    <i class="bi bi-arrow-clockwise"></i> Generate
                </button>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="status_edit">Status</label>
        </div>
        <div class="col-md-8">
            <select name="status" id="status_edit" class="form-control">
                <option <?php if($status==""){echo "selected";} ?> value="">Pilih</option>
                <option <?php if($status=="Active"){echo "selected";} ?> value="Active">Active</option>
                <option <?php if($status=="Request"){echo "selected";} ?> value="Request">Request</option>
                <option <?php if($status=="Block"){echo "selected";} ?> value="Block">Block</option>
            </select>
        </div>
    </div>
<?php } ?>