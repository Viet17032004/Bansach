
<?php 

$id_group = _MY_DATA['id_group'];


if(!empty(checkPermission($id_group, 'group', 'fix'))):


$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];

    require _WEB_PATH_ROOT.'/admin/groups/model/fix.php';

    if(!empty($detailGroup)){

    }else{
        setFlashData('msg', 'url này không tồn tại !!!');
        setFlashData('type', 'danger');
        redirect('?module=groups');
    }

}else{
    setFlashData('msg', 'url này lỗi !!!');
    setFlashData('type', 'danger');
    redirect('?module=groups');
}



if(is_Post()){

    $data = getRequest();


    $errors = [];

    if(empty($data['name'])){
        $errors['name'] = 'Vui lòng điền thông tin';
    }

    if(empty($errors)){
        $dataUpdate = [
            'name' => $data['name'],
            'update_at' => date('Y-m-d H:i:s')
        ];
        if(update('groups', $dataUpdate, "id='$id'")){
            setFlashData('msg', 'Sửa thành công !!!');
            setFlashData('type', 'success');
        }else{
            setFlashData('msg', 'Lỗi hệ thống !!!');
            setFlashData('type', 'danger');
        }
    }else{
        setFlashData('msg', 'Vui lòng kiểm tra form !!!');
        setFlashData('type', 'danger');
        setFlashData('old', $data);
        setFlashData('errers', $errors);
    }

    redirect('?module=groups&view=fix&id='.$id);

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errers');
$old = getFlashData('old');
if(empty($old)){
    $old = $detailGroup;
}


?>


<h5>Sửa loại blog</h5>
<hr>
<?php getAlert($msg, $type); ?>
<form action="" method="post">

<div class="form-group">
    <label for="">Name</label>
    <input type="text" name="name" value="<?php echo !empty($old['name'])?$old['name']:''; ?>" class="form-control">   
    <?php !empty($errors['name'])?formError($errors['name']):''; ?>
</div>
<button type="submit" class="btn btn-primary">Sửa</button>
</form>
<hr>
<a href="?module=groups" class="btn btn-success">Thêm</a>

<?php endif; ?>