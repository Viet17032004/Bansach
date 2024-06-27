<?php

$id_group = _MY_DATA['id_group'];

if(!checkPermission($id_group, 'group', 'permission')){
    redirect(_WEB_HOST_ERORR."/permission.php");
}

$body = getRequest("get");

$id = $body['id'];

require _WEB_PATH_ROOT.'/admin/permission/model/permission.php';

$count = 0;

$groupPermission = json_decode($detailGroup['permission'], true);

if(is_Post()){

    $data = getRequest();

    $jsonData = json_encode($data);

    $dataUpdate = [
        'permission' => $jsonData
    ];

    $update = update('groups', $dataUpdate, "id='$id'");
    
    if(!empty($update)){
        setFlashData('msg', "Lưu quyền thành công !!!");
        setFlashData('type', 'success');
    }else{
        setFlashData('msg', "Lỗi hệ thống !!!");
        setFlashData('type', 'danger');
    }


    redirect("?module=permission&id=$id");

}

$msg = getFlashData('msg');
$type = getFlashData('type');

?>


<div class="container_my">

<?php getAlert($msg, $type); ?>

<form action="" method="post" class="box_permission">

<table class="w-100">

    <thead>
        <tr>
            <th class="board_th" width="5%">STT</th>
            <th class="board_th" width="15%">Module</th>
            <th class="board_th">Các quyền</th>
        </tr>
    </thead>

    <tbody>
<?php
    if(!empty($allModule)):
        foreach ($allModule as $key => $value):
            $count++;
?>
        <tr>
            <td class="board_td text-center"><?= $count ?></td>
            <td class="board_td"><?= $value['name'] ?></td>
            <td class="board_td d-flex align-items-center py-3">
                <?php   
                    $allPermission = json_decode($value['permission'], true);
                    foreach ($allPermission as $keyper => $per):
                        $permission = false;
                        if(!empty($groupPermission[$value['name']])){
                            if(in_array($keyper, array_keys($groupPermission[$value['name']]))){
                            $permission = true;
                            }
                        }

                ?>
                <div class="form-group m-0 mx-5">
                        <label for="" class="m-0"><?= $per ?></label>
                        <input class="input_permission" type="checkbox" name="<?php echo $value['name'].'['.$keyper.']'; ?>" <?php echo !empty($permission)?'checked':''; ?> value="<?= $per ?>"> 
                </div>
                <?php
                    endforeach; 
                ?>
            </td>
        </tr>
<?php
    endforeach;
    endif;
?>
    </tbody>

</table>

<br>

<input type="submit" value="Lưu quyền" class="btn btn-primary ml-auto d-block">

</form>

<hr>

<a href="?module=groups" class="btn btn-success">Danh sách</a>

<span class="btn btn-warning btn_all_permission">Cấp hết</span>
<span class="btn btn-danger btn_remove_permission">Hủy hết</span>








</div>