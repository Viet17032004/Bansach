<?php

$group_id = _MY_DATA['id_group'];

if(!checkPermission($group_id, 'option', 'about')){
    redirect(_WEB_HOST_ERORR.'/permission.php');
}


if(is_Post()){

    $data = getRequest();

    $errors = [];

    if(empty($errors)){
        $dataUpdate = [
            'opt_value' => $data['web_about'],
            'update_at' => date('Y-m-d H:i:s')
        ];
        if(update('options', $dataUpdate, "opt_key='web_about'")){
            setFlashData('msg', 'Cập nhập thông tin thành công');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống');
            setFlashData('type', 'danger');
        }
    }

    redirect('?module=option&action=about');

}

$msg = getFlashData('msg');
$type = getFlashData('type');

$old = getRow("SELECT * FROM options WHERE opt_key='web_about'");

?>


<div class="container_my">

<?php getAlert($msg, $type) ?>

<form action="" method="post">

<div class="form-group">
    <textarea name="web_about" id="" cols="" rows="100" class="ckediter w-100"><?php echo $old['opt_value']; ?></textarea>
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Cập nhập">
</div>

</form>

</div>