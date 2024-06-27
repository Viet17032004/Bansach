
<?php 

$group_id = _MY_DATA['id_group'];

if(checkPermission($group_id, 'course_type', 'fix')):

$body = getRequest('get');

if(!empty($body['id'])){
    $id = $body['id'];

    require _WEB_PATH_ROOT.'/admin/course_type/model/fix.php';
    if(!empty($detailCourseType)){

    }else{
        setFlashData('msg', 'url này không tồn tại !!!');
        setFlashData('type', 'danger');
        redirect('?module=course_type');
    }

}else{
    setFlashData('msg', 'url này lỗi !!!');
    setFlashData('type', 'danger');
    redirect('?module=course_type');
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
        if(update('course_type', $dataUpdate, "id='$id'")){
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

    redirect('?module=course_type&view=fix&id='.$id);

}

$msg = getFlashData('msg');
$type = getFlashData('type');
$errors = getFlashData('errers');
$old = getFlashData('old');
if(empty($old)){
    $old = $detailCourseType;
}


?>


<h5>Sửa loại khóa học</h5>
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
<a href="?module=course_type" class="btn btn-success">Thêm</a>

<?php endif; ?>